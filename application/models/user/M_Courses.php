<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Courses extends CI_Model
{

	public $table_lms_courses = 'tb_lms_courses';
	public $table_lms_user_courses = 'tb_lms_user_courses';
	public $table_lms_user_lesson = 'tb_lms_user_lesson';	

	public function read($site){

		$limit = $site['user_limit_data'];
		$count_data = $this->query(true);

		if (empty($count_data)) return false;

		if ($this->input->get('showall')) {
			$limit = $count_data;
		}
		
		$index = ($this->input->get('page')) ? $limit*($this->input->get('page')-1) : 0;

		$pagination = $this->_Pagination->pagination($count_data,$limit,base_url('user/courses'),FALSE,TRUE,'page');	

		$read_data = $this->query(false,$limit,$index);
		if (empty($read_data)) redirect(base_url('user/courses'));

		$read_post = $this->query_post($site,$read_data);

		return [
		'data' => $read_post,
		'pagination' => $pagination,
		'count_data' => $count_data			
		];
	}

	public function query($count = false,$limit = false,$index = false){

		$this->db->select('tb_lms_user_courses.id');
		$this->db->from($this->table_lms_user_courses);
		if (!$count) {
			$this->db->limit($limit,$index);
		}		
		$this->db->where("tb_lms_user_courses.id_user",$this->session->userdata('id_user')); 
		$this->db->order_by('tb_lms_user_courses.id','DESC');
		$query =$this->db->get();

		if ($query->num_rows() < 1) return false;

		if (!$count) {
			foreach ($query->result_array() as $ids) {
				$id[] = $ids['id'];
			}
			return $id;  
		}else {
			return $query->num_rows();
		}

	}	

	public function query_post($site,$id){


		$this->db->select('tb_lms_courses.*');
		$this->db->from($this->table_lms_user_courses);		
		$this->db->join($this->table_lms_courses, 'tb_lms_courses.id = tb_lms_user_courses.id_courses', 'LEFT JOIN');
		$this->db->where_in('tb_lms_user_courses.id',$id);
		$this->db->order_by('tb_lms_user_courses.id','DESC');		
		$read = $this->db->get()->result_array();

		/**
	    * Build Course
	    */
		$all_courses = $this->_Courses->read_long($site,$read);

		foreach ($all_courses as $courses) {
			$lesson = $this->_Lesson->build_lesson($courses);

			$all_data[] = array_merge($courses,$lesson);
		}	

		return $all_data;
	}	

	public function add_courses(){

		$id = base64_decode($this->input->post('id'));

		$post_data = [
		'id_user' => $this->session->userdata('id_user'),
		'id_courses' => $id,
		];

		/** check if courses exist */
		$courses = $this->_Process_MYSQL->get_data($this->table_lms_courses,['id' => $id]);

		$read_courses = $courses->row_array();

		/** check if courses is free */
		if (empty($read_courses['price'])) {
			if ($courses->num_rows() > 0) { 

				/** check if user have courses */
				$user_courses = $this->_Process_MYSQL->get_data($this->table_lms_user_courses,$post_data);

				if ($user_courses->num_rows() < 1) {

					$post_data['time'] = date('Y:m:d H:i:s');
					return $this->_Process_MYSQL->insert_data($this->table_lms_user_courses, $post_data);
				}else{
					redirect(base_url());
				}
			}else {
				redirect(base_url());
			}
		}else {
			redirect(base_url());
		}

	}

	public function process_lesson(){

		$id_courses = $this->input->post('id_courses');
		$id_lesson = $this->input->post('id_lesson');

		$post_data = [
		'id_user' => $this->session->userdata('id_user'),
		'id_courses' => $id_courses,
		];

		/** check if user have lesson data */
		$user_lesson = $this->_Process_MYSQL->get_data($this->table_lms_user_lesson,$post_data);


		/**
		 * if not exist create first
		 */
		if ($user_lesson->num_rows() < 1) {

			$data[] = [
			'id_lesson' => $id_lesson,
			'status' => true,
			];

			$post_data['data'] = json_encode($data);

			if ($this->_Process_MYSQL->insert_data($this->table_lms_user_lesson, $post_data)) {
				echo 'set_true';
			}
		}else{

			$user_lesson = json_decode($user_lesson->row()->data,TRUE);		

			$previous_data = false;
			$status = false;
			$lesson_data_temp = [];
			foreach ($user_lesson as $lesson_data) {

				$lesson_data_temp[] = $lesson_data['id_lesson'];

				if ($lesson_data['id_lesson'] == $id_lesson) {				

					if ($lesson_data['status'] == false) {
						$status = true;
					}
				}else {					
					$previous_data[] = [
					'id_lesson' => $lesson_data['id_lesson'],
					'status' => $lesson_data['status'],
					];
				}
			}

			/** if id_lesson not in user_lesson set status true **/
			if (!in_array($id_lesson, $lesson_data_temp)) {
				$status = true;
			}

			$data[] = [
			'id_lesson' => $id_lesson,
			'status' => $status,
			];

			if (empty($previous_data)) {
				$post_data['data'] = json_encode($data);
			}else {				
				$post_data['data'] = json_encode(array_merge($previous_data,$data));
			}


			if ($this->_Process_MYSQL->update_data($this->table_lms_user_lesson,$post_data,[
				'id_user' => $this->session->userdata('id_user'),
				'id_courses' => $id_courses,
				])) {
				if ($status) {
					echo 'set_true';
				}else{
					echo 'set_false';
				}
			}
		}

	}

}