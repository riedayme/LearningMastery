<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Courses extends CI_Model
{

	public $table_user = 'tb_user';  

	public $table_lms_category = 'tb_lms_category';   

	public $table_lms_user_courses = 'tb_lms_user_courses';
	public $table_lms_user_wishlist = 'tb_lms_user_wishlist';
	public $table_lms_user_review = 'tb_lms_user_review';

	public function __construct()
	{
		parent::__construct();

		$this->load->model('_Currency');
	}


	public function check_courses($courses){

		if ($this->session->userdata('id_user')) {
			$read = $this->_Process_MYSQL->get_data($this->table_lms_user_courses,[
				'id_user' => $this->session->userdata('id_user'),
				'id_courses' => $courses['id']
				]);

			if ($read->num_rows() > 0) {
				return [
				'user_courses' => true
				];
			}else {
				return [
				'user_courses' => false
				];
			}
		}else {
			return [
			'user_courses' => false
			];
		}
	}

	public function check_wishlist($courses){

		if ($this->session->userdata('id_user')) {
			$read = $this->_Process_MYSQL->get_data($this->table_lms_user_wishlist,[
				'id_user' => $this->session->userdata('id_user'),
				'id_courses' => $courses['id']
				]);

			if ($read->num_rows() > 0) {
				return [
				'user_wishlist' => true
				];
			}else {
				return [
				'user_wishlist' => false
				];
			}
		}else {
			return [
			'user_wishlist' => false
			];
		}
	}	

	public function read_rating($id_courses)
	{
		$this->db
		->select("CEIL(AVG(rating)) as rate_rating")
		->from($this->table_lms_user_review)
		->where("id_courses",$id_courses);
		$query = $this->db->get();

		$read = $query->row_array();

		return $read['rate_rating'];
	}	

	/**
	 * read long for : index, category
	 */
	public function read_long($site,$courses_data){

		/**
		 * Load Extract Image
		 */
		$this->load->model('_Image');

		foreach ($courses_data as $courses) {

			/**
			 * Read First Image
			 */
			$image = (!empty($courses['image'])) ? true : false;

			if ($image) {
				$courses['image'] = $this->_Image->extract_image($courses['image'],300,$site);
			}else {
				$courses['image'] = $this->_Image->first_image($courses['description']);
				$courses['image'] = $this->_Image->extract_image($courses['image'],300,$site);
			}

			/**
			 * Edit Permalink
			 */
			$courses['url_lesson'] = base_url('courses-lesson/' . $courses['permalink']);
			$courses['permalink'] = base_url('courses-detail/' . $courses['permalink']);

			/**
			 * Edit Time & Updated
			 */
			$courses['time_original'] = $courses['time'];
			$courses['time'] = $this->_Date->set($courses['time'],'d F Y H:i A');
			$courses['updated_original'] = $courses['updated'];
			$courses['updated'] = $this->_Date->set($courses['updated'],'d F Y H:i A');

			/**
			 * decode desciption, faq
			 */
			$courses['description'] = html_entity_decode($courses['description']);
			$courses['faq'] = html_entity_decode($courses['faq']);

			/**
			 * slug category
			 */
			$courses['category'] = $this->read_category($courses['id_category']);	
			$courses['sub_category'] = $this->read_category($courses['id_sub_category']);	

			/**
			 * price
			 */
			$courses['price_original'] = $courses['price'];
			$courses['price'] = $this->_Currency->set_currency($courses['price']);

			/**
			 * discount
			 */
			$courses['discount_original'] = $courses['discount'];
			$courses['discount'] = $this->_Currency->set_currency($courses['discount']);

			/**
			 * total priceif have discount
			 */
			$courses['price_total_original'] = $courses['price_original']-$courses['discount_original'];
			$courses['price_total'] = $this->_Currency->set_currency($courses['price_total_original']);

			/**
			 * User
			 */
			$courses['author'] = $this->read_user($courses['id_user']);	

			/**
			 * Rating
			 */
			$courses['rating'] = $this->read_rating($courses['id']);
			
			$extract[] = array(
				'id' =>$courses['id'],
				'title' =>$courses['title'],
				'url' =>$courses['permalink'],
				'url_lesson' =>$courses['url_lesson'],
				'image' =>$courses['image'],
				'time' =>$courses['time'],
				'time_original' =>$courses['time_original'],
				'updated' =>$courses['updated'],
				'updated_original' =>$courses['updated_original'],			
				'description' =>$courses['description'],
				'faq' =>$courses['faq'],
				'category' => $courses['category'],
				'sub_category' => $courses['sub_category'],				
				'views' =>$courses['views'],
				'price' =>  $courses['price'],
				'price_original' =>  $courses['price_original'],
				'discount' =>  $courses['discount'],
				'discount_original' =>  $courses['discount_original'],							
				'price_total' =>  $courses['price_total'],
				'price_total_original' =>  $courses['price_total_original'],	
				'author' =>$courses['author'],
				'rating' =>$courses['rating'],				
				'status' =>$courses['status']					
				);         

		}

		return $extract;
	}

	/**
	 * read long single for : detail
	 */
	public function read_long_single($site,$courses){

		/**
		 * Load Extract Image
		 */
		$this->load->model('_Image');

		/**
		 * Read First Image
		 */
		$image = (!empty($courses['image'])) ? true : false;


		if ($image) {
			$courses['image'] = $this->_Image->extract_image($courses['image'],300,$site);
		}else {
			$courses['image'] = $this->_Image->first_image($courses['description']);
			$courses['image'] = $this->_Image->extract_image($courses['image'],300,$site);
		}

		/**
		 * Edit Permalink
		 */
		$courses['url_lesson'] = base_url('courses-lesson/' . $courses['permalink']);
		$courses['slug'] = $courses['permalink'];
		$courses['permalink'] = base_url('courses-detail/' . $courses['permalink']);

		/**
		 * Edit Time & Updated
		 */
		$courses['time_original'] = $courses['time'];
		$courses['time'] = $this->_Date->set($courses['time'],'d F Y H:i A');

		$courses['updated_original'] = $courses['updated'];
		$courses['updated'] = $this->_Date->set($courses['updated'],'d F Y H:i A');		

		/**
		 * decode desciption, faq
		 */
		$courses['description'] = html_entity_decode($courses['description']);
		$courses['faq'] = html_entity_decode($courses['faq']);

		/**
		 * slug category
		 */
		$courses['category'] = $this->read_category($courses['id_category']);	
		$courses['sub_category'] = $this->read_category($courses['id_sub_category']);					

		/**
		 * price
		 */
		$courses['price_original'] = $courses['price'];
		$courses['price'] = $this->_Currency->set_currency($courses['price']);

		/**
		 * discount
		 */
		$courses['discount_original'] = $courses['discount'];
		$courses['discount'] = $this->_Currency->set_currency($courses['discount']);

		/**
		 * total priceif have discount
		 */
		$courses['price_total_original'] = $courses['price_original']-$courses['discount_original'];
		$courses['price_total'] = $this->_Currency->set_currency($courses['price_total_original']);
		
		/**
		 * User
		 */
		$courses['author'] = $this->read_user($courses['id_user']);	

		/**
		 * Rating
		 */
		$courses['rating'] = $this->read_rating($courses['id']);		
		
		$extract = array(
			'id' =>$courses['id'],
			'id_user' =>$courses['id_user'],			
			'title' =>$courses['title'],
			'slug' =>$courses['slug'],			
			'url' =>$courses['permalink'],
			'url_lesson' =>$courses['url_lesson'],
			'image' =>$courses['image'],
			'time' =>$courses['time'],
			'time_original' =>$courses['time_original'],
			'updated' =>$courses['updated'],
			'updated_original' =>$courses['updated_original'],			
			'description' =>$courses['description'],
			'faq' =>$courses['faq'],
			'id_category' => $courses['id_category'],			
			'category' => $courses['category'],
			'sub_category' => $courses['sub_category'],
			'views' =>$courses['views'],
			'price' =>  $courses['price'],
			'price_original' =>  $courses['price_original'],
			'discount' =>  $courses['discount'],
			'discount_original' =>  $courses['discount_original'],							
			'price_total' =>  $courses['price_total'],
			'price_total_original' =>  $courses['price_total_original'],
			'author' =>$courses['author'],
			'rating' =>$courses['rating'],																	
			'status' =>$courses['status']					
			);

		return $extract;
	}	

	public function read_user($id)
	{
		$this->db
		->select("
			photo, 
			username, 	
			headline, 			
			")
		->from($this->table_user)
		->where("id",$id);
		$query = $this->db->get();

		$read = $query->row_array();

		$data = [
		'name' => $read['username'],
		'photo' => (!empty($read['photo']) ?  base_url('storage/uploads/user/photo/'.$read['photo']) : base_url('storage/uploads/user/photo/default.png')),
		'headline' => $read['headline']
		];

		return $data;
	}		

	public function read_category($id)
	{
		$this->db
		->select("
			name,
			icon, 
			slug,
			")
		->from($this->table_lms_category)
		->where("tb_lms_category.id",$id);
		$query = $this->db->get();

		$count = $query->num_rows();

		if ($count < 1) return false;

		$read = $query->row_array();

		$category = [
		'name' => $read['name'],
		'icon' => $read['icon'],			
		'url' => base_url('courses-filter?category='.$read['slug']),
		];

		return $category;
	}		

}