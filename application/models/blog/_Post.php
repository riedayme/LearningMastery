<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Post extends CI_Model
{

	public $table_user = 'tb_user';  

	public $table_blog_post_category = 'tb_blog_post_category';
	public $table_blog_post_tags = 'tb_blog_post_tags';
	public $table_blog_post_comment = 'tb_blog_post_comment';		


	public function __construct()
	{
		parent::__construct();

		$this->load->model('_Image');	
		$this->load->model('_Ads');	
	}

	/**
	 * read short for widget : popular post,related post, featured post
	 */
	public function read_short($site,$post_data){	

		foreach ($post_data as $post) {

			/**
			 * Read First Image
			 */
			$image = (!empty($post['image'])) ? true : false;

			if ($image) {
				$post['image'] = $this->_Image->extract_image($post['image'],300,$site);
			}else {
				$post['image'] = $this->_Image->first_image($post['content']);
				$post['image'] = $this->_Image->extract_image($post['image'],300,$site);
			}

			/**
			 * Edit Permalink
			 */
			$post['permalink'] = base_url('blog-post/' . $post['permalink']);

			/**
			 * Edit Time & Updated
			 */
			$post['time'] = $this->_Date->set($post['time'],'d F Y H:i A');

			/**
			 * Cut Content
			 */
			$post['content'] = ctsubstr($post['content'],150);
			
			$extract[] = array(
				'title' => $post['title'],
				'url' => $post['permalink'],
				'image' => $post['image'],
				'time' => $post['time'],
				'content' => $post['content'],
				'views' => $post['views'],
				);         

		}

		return $extract;
	}

	/**
	 * read short single for : meta,next prev post
	 */
	public function read_short_single($site,$post){

		/**
		 * Read First Image
		 */
		$image = (!empty($post['image'])) ? true : false;

		if ($image) {
			$post['image'] = $this->_Image->extract_image($post['image'],300,$site);
		}else {
			$post['image'] = $this->_Image->first_image($post['content']);
			$post['image'] = $this->_Image->extract_image($post['image'],300,$site);
		}

		/**
		 * Edit Permalink
		 */
		$post['permalink'] = base_url('blog-post/' . $post['permalink']);

		/**
		 * Edit Time & Updated
		 */
		$post['time'] = $this->_Date->set($post['time'],'d F Y H:i A');
		$post['updated'] = $this->_Date->set($post['updated'],'d F Y H:i A');

		/**
		 * Cut Content
		 */
		$post['content'] = ctsubstr($post['content'],150);

		/**
		 * Description
		 */
		$post['description'] = !empty($post['description']) ? $post['description'] : $post['content'];
		
		$extract = array(
			'title' => $post['title'],
			'url' => $post['permalink'],
			'image' => $post['image'],
			'time' => $post['time'],
			'updated' => $post['updated'],
			'content' => $post['content'],
			'description' => $post['description'],						
			);         

		return $extract;		
	}

	/**
	 * read long for : index,search,category,tag
	 */
	public function read_long($site,$post_data){

		foreach ($post_data as $post) {

			/**
			 * Read First Image
			 */
			$image = (!empty($post['image'])) ? true : false;

			if ($image) {
				$post['image'] = $this->_Image->extract_image($post['image'],300,$site);
			}else {
				$post['image'] = $this->_Image->first_image($post['content']);
				$post['image'] = $this->_Image->extract_image($post['image'],300,$site);
			}


			/**
			 * Edit Permalink
			 */
			$post['permalink'] = base_url('blog-post/' . $post['permalink']);

			/**
			 * Edit Time & Updated
			 */
			$post['time_original'] = $post['time'];
			$post['time'] = $this->_Date->set($post['time'],'d F Y H:i A');
			$post['updated_original'] = $post['updated'];
			$post['updated'] = $this->_Date->set($post['updated'],'d F Y H:i A');

			/**
			 * Cut Content
			 */
			$post['content'] = ctsubstr($post['content'],150);

			/**
			 * slug category and tags
			 */
			$post['category'] = $this->read_category($post['id_category']);
			$post['tags'] = $this->read_tags($post['id_tags']);

			/**
			 * User
			 */
			$post['author'] = $this->read_user($post['id_user']);
			
			$extract[] = array(
				'id' =>$post['id'],
				'title' =>$post['title'],
				'url' =>$post['permalink'],
				'image' =>$post['image'],
				'time' =>$post['time'],
				'time_original' =>$post['time_original'],
				'updated' =>$post['updated'],
				'updated_original' =>$post['updated_original'],	
				'category' =>$post['category'],					
				'tags' =>$post['tags'],		
				'author' =>$post['author'],						
				'content' =>$post['content'],
				'description' =>$post['description'],
				'views' =>$post['views'],
				'status' =>$post['status']
				);         

		}

		return $extract;
	}

	/**
	 * read long single for : post
	 */
	public function read_long_single($site,$widget,$post){

		/**
		 * Read First Image
		 */
		$image = (!empty($post['image'])) ? true : false;

		if ($image) {
			$post['image'] = $this->_Image->extract_image($post['image'],300,$site);
		}else {
			$post['image'] = $this->_Image->first_image($post['content']);
			$post['image'] = $this->_Image->extract_image($post['image'],300,$site);
		}

		/**
		 * Edit Permalink
		 */
		$post['permalink'] = base_url('blog-post/' . $post['permalink']);

		/**
		 * Edit Time & Updated
		 */
		$post['time_original'] = $post['time'];
		$post['time'] = $this->_Date->set($post['time'],'d F Y H:i A');

		$post['updated_original'] = $post['updated'];
		$post['updated'] = $this->_Date->set($post['updated'],'d F Y H:i A');		

		/**
		 * decode Content & set ads if exist on widget
		 */
		$post['content'] = html_entity_decode($post['content']);

		if ($widget) {
			foreach ($widget as $key => $val) {
				if (!empty($widget[$key]['type'])) {
					if ($widget[$key]['type'] == 'ads-content') {
						$post['content'] = $this->_Ads->inject_ads($widget[$key],$post['content']);
					}
				}
			}
		}

		/**
		 * slug category and tags
		 */
		$post['category'] = $this->read_category($post['id_category']);
		$post['tags'] = $this->read_tags($post['id_tags']);

		/**
		 * User
		 */
		$post['author'] = $this->read_user($post['id_user']);		
		
		$extract = array(
			'id' =>$post['id'],
			'title' =>$post['title'],
			'url' =>$post['permalink'],
			'image' =>$post['image'],
			'time' =>$post['time'],
			'time_original' =>$post['time_original'],
			'updated' =>$post['updated'],
			'updated_original' =>$post['updated_original'],			
			'id_category' =>$post['id_category'],						
			'category' =>$post['category'],			
			'tags' =>$post['tags'],			
			'author' =>$post['author'],
			'content' =>$post['content'],
			'description' =>$post['description'],
			'views' =>$post['views'],
			'status' =>$post['status']					
			);

		return $extract;
	}	

	public function read_user($id)
	{
		$this->db
		->select("
			photo, 
			username, 			
			")
		->from($this->table_user)
		->where("id",$id);
		$query = $this->db->get();

		$read = $query->row_array();

		$data = [
		'name' => $read['username'],
		'photo' => (!empty($read['photo']) ?  base_url('storage/uploads/user/photo/'.$read['photo']) : base_url('storage/uploads/user/photo/default.png')),
		];

		return $data;
	}		

	public function read_category($id)
	{
		$this->db
		->select("
			name, 
			slug, 			
			")
		->from($this->table_blog_post_category)
		->where("id",$id);
		$query = $this->db->get();

		$count = $query->num_rows();

		if ($count < 1) return false;

		$read = $query->row_array();

		$category = [
		'name' => $read['name'],
		'url' => base_url('blog-category/'.$read['slug']),
		];

		return $category;
	}	

	public function read_tags($id)
	{
		$this->db
		->select("
			name, 
			slug, 			
			")
		->from($this->table_blog_post_tags)
		->where_in("id",explode(',', $id));
		$query = $this->db->get();

		$count = $query->num_rows();

		if ($count < 1) return false;

		$read = $query->result_array();

		foreach ($read as $data_tag) {
			$tags [] = [
			'name' => $data_tag['name'],
			'url' => base_url('blog-tags/'.$data_tag['slug']),
			];
		}

		return $tags;
	}		

}