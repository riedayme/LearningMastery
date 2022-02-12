<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Wishlist extends CI_Model
{

	public $table_lms_courses = 'tb_lms_courses';
	public $table_lms_user_wishlist = 'tb_lms_user_wishlist';

	public function read($site){

		$limit = $site['user_limit_data'];
		$count_data = $this->query(true);

		if (empty($count_data)) return false;

		if ($this->input->get('showall')) {
			$limit = $count_data;
		}
		
		$index = ($this->input->get('page')) ? $limit*($this->input->get('page')-1) : 0;

		$pagination = $this->_Pagination->pagination($count_data,$limit,base_url('user/wishlist'),FALSE,TRUE,'page');	

		$read_data = $this->query(false,$limit,$index);
		if (empty($read_data)) redirect(base_url('user/wishlist'));

		$read_post = $this->query_post($site,$read_data);

		return [
			'data' => $read_post,
			'pagination' => $pagination,
			'count_data' => $count_data			
		];
	}

	public function query($count = false,$limit = false,$index = false){

		$this->db->select('
			tb_lms_courses.id
			');
		$this->db->from($this->table_lms_user_wishlist);
		if (!$count) {
			$this->db->limit($limit,$index);
		}		
		$this->db->join($this->table_lms_courses, 'tb_lms_courses.id = tb_lms_user_wishlist.id_courses', 'LEFT JOIN');
		$this->db->where("tb_lms_user_wishlist.id_user",$this->session->userdata('id_user')); 
		$this->db->order_by('tb_lms_user_wishlist.id','DESC');
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

		$this->db->select('*');
		$this->db->from($this->table_lms_courses);		
		$this->db->where_in('id',$id);
		$this->db->order_by('time','DESC');		
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

	public function process(){

		$id = base64_decode($this->input->post('id'));

		$post_data = [
			'id_user' => $this->session->userdata('id_user'),
			'id_courses' => $id,
		];

		/** check if user have wishlist */
		$user_wishlist = $this->_Process_MYSQL->get_data($this->table_lms_user_wishlist,$post_data);

		if ($user_wishlist->num_rows() < 1) {
			if ($this->add_wishlist($post_data)) {
				echo 'success_add';
			}
		}else{
			if ($this->remove_wishlist($post_data)) {
				echo 'success_remove';
			}
		}

	}

	public function add_wishlist($post_data){

		/** check if courses exist */
		$courses = $this->_Process_MYSQL->get_data($this->table_lms_courses,['id' => $post_data['id_courses']]);

		if ($courses->num_rows() > 0) { 

			$post_data['time'] = date('Y:m:d H:i:s');
			return $this->_Process_MYSQL->insert_data($this->table_lms_user_wishlist, $post_data);
		}else {
			redirect(base_url());
		}

	}

	public function remove_wishlist($post_data){

		/** check if courses exist */
		$courses = $this->_Process_MYSQL->get_data($this->table_lms_courses,['id' => $post_data['id_courses']]);

		if ($courses->num_rows() > 0) { 
			return $this->_Process_MYSQL->delete_data($this->table_lms_user_wishlist, $post_data);
		}else {
			redirect(base_url());
		}

	}	

}