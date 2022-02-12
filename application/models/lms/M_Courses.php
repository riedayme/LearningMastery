<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Courses extends CI_Model
{

	public $table_lms_courses = 'tb_lms_courses';
	public $table_lms_courses_section = 'tb_lms_courses_section';
	public $table_lms_courses_lesson = 'tb_lms_courses_lesson';         

	public $table_user = 'tb_user';
	public $table_lms_user_review = 'tb_lms_user_review';	

	public function data_course($site,$slug){

		$courses =  $this->query_post($site,$slug);

		/**
		 * check user courses, wishlist
		 */
		$user_courses = $this->_Courses->check_courses($courses);
		$user_wishlist = $this->_Courses->check_wishlist($courses);

		$build_lesson = $this->_Lesson->build_lesson($courses);


		$related_post = $this->related_post($site,$courses['id'],$courses['id_category']);


		$review_limit = 2;
		$review_count_data = $this->review($site,$courses['id'],true);
		$review_index = ($this->input->get('review-page')) ? $review_limit*($this->input->get('review-page')-1) : 0;
		$review_pagination['review_pagination'] = $this->_Pagination->pagination($review_count_data,$review_limit,base_url('courses-detail/'.$slug),FALSE,TRUE,'review-page');
		$review = $this->review($site,$courses['id'],false,$review_limit,$review_index);

		$review_stats = $this->review_stats($courses['id']);

		return array_merge($courses,$user_courses,$user_wishlist,$build_lesson,$related_post,$review,$review_pagination,$review_stats);
	}

	public function query_post($site,$slug){
		$this->db->select('*');
		$this->db->from($this->table_lms_courses);		
		$this->db->where('permalink',urldecode($slug));
		$this->db->order_by('time','DESC');
		$query = $this->db->get();

		$read = $query->row_array();

		/**
	    * Build Courses
	    */		
		$post = $this->_Courses->read_long_single($site,$read);

		return $post;
	}

	public function review($site,$id_courses,$count = false,$limit = false,$index = false){

		$this->db->select('
			tb_user.username,
			tb_user.photo,
			tb_lms_user_review.time,			
			tb_lms_user_review.rating,
			tb_lms_user_review.review			
			');
		$this->db->from($this->table_lms_user_review);
		$this->db->join($this->table_user, 'tb_lms_user_review.id_user = tb_user.id', 'LEFT JOIN');
		$this->db->where("tb_lms_user_review.id_courses",$id_courses); 
		$this->db->order_by('tb_lms_user_review.id','DESC');
		if (!$count) {
			$this->db->limit($limit,$index);
		}
		$query = $this->db->get();

		$total_data = $query->num_rows();

		if ($count) {
			return $total_data;
		}

		if ($total_data < 1) return [
			'review' => false
		];

		$read = $query->result_array();

		foreach ($read as $data) {
			$extract_data[] = [
			'name' => $data['username'],
			'photo' => (!empty($data['photo']) ?  base_url('storage/uploads/user/photo/'.$data['photo']) : base_url('storage/uploads/user/photo/default.png')),
			'time' => $data['time'],
			'rating' => $data['rating'],
			'message' => $data['review']			
			];
		}

		// echo json_encode($extract_data);
		// exit;

		return [
		'review' => $extract_data
		];		
	}

	public function review_stats($id_courses){

		$this->db->select('rating');
		$this->db->from($this->table_lms_user_review);
		$this->db->where("id_courses",$id_courses); 
		$query = $this->db->get();

		$total_data = $query->num_rows();

		if ($total_data < 1) return [
			'review_stats' => false
		];

		$read = $query->result_array();

		$rating_1 = 0;
		$rating_2 = 0;
		$rating_3 = 0;
		$rating_4 = 0;
		$rating_5 = 0;
		foreach ($read as $data) {
			if ($data['rating'] == 1) {
				$rating_1++;
			}elseif ($data['rating'] == 2) {
				$rating_2++;
			}elseif ($data['rating'] == 3) {
				$rating_3++;
			}elseif ($data['rating'] == 4) {
				$rating_4++;
			}elseif ($data['rating'] == 5) {
				$rating_5++;
			}
		}

		$extract_data = [
		'rating_1' => [
		'star' => 1,
		'percent' => $rating_1 / $total_data * 100 . "%",
		'count' => $rating_1
		],
		'rating_2' => [
		'star' => 2,
		'percent' => $rating_2 / $total_data * 100 . "%",
		'count' => $rating_2
		],
		'rating_3' => [
		'star' => 3,
		'percent' => $rating_3 / $total_data * 100 . "%",
		'count' => $rating_3
		],
		'rating_4' => [
		'star' => 4,
		'percent' => $rating_4 / $total_data * 100 . "%",
		'count' => $rating_4
		],
		'rating_5' => [
		'star' => 5,
		'percent' => $rating_5 / $total_data * 100 . "%",
		'count' => $rating_5
		]
		];

		// echo json_encode($extract_data);
		// exit;

		return [
		'review_stats' => $extract_data
		];			
	}	

	public function related_post($site,$id_courses,$id_category) {

		$this->db->select('*');
		$this->db->from($this->table_lms_courses);		
		$this->db->limit(3);
		$this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'"); 
		$this->db->where('id !=',$id_courses);  
		$this->db->where('id_category',$id_category);  
		$this->db->order_by('time','DESC');
		$query = $this->db->get();

		$count = $query->num_rows();


		if ($count < 1) return [
			'related_courses' => false
		];

		$read = $query->result_array();

		/**
	    * Build Courses
	    */		
		$courses = $this->_Courses->read_long($site,$read);

		return [
		'related_courses' => $courses
		];
	}	

}