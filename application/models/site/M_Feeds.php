<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Feeds extends CI_Model
{

	public $table_lms_courses = 'tb_lms_courses';
	public $table_blog_post = 'tb_blog_post';
	public $table_blog_pages = 'tb_blog_pages';

	public function courses($site){

		$this->load->model('lms/_Courses');
		$this->load->model('lms/M_Homepage');

		$limit = 10;
		$count_data = $this->M_Homepage->query(true);

		if (empty($count_data)) return false;
		
		$page = ($this->input->get('page')) ? $limit*($this->input->get('page')-1) : 0;

		$read_data = $this->M_Homepage->query(false,$limit,$page);

		if (empty($read_data)) redirect(base_url());

		$read_post = $this->courses_query($site,$read_data);
		
		return $read_post;
	}

	public function courses_query($site,$id){
		$this->db->select('*');
		$this->db->from($this->table_lms_courses);		
		$this->db->where_in('id',$id);
		$this->db->order_by('time','DESC');		
		$read = $this->db->get()->result_array();

		/**
	    * Build Course
	    */
		$post = $this->_Courses->read_long($site,$read);

		return $post;
	}

	public function blog_post($site){

		$this->load->model('blog/_Post');
		$this->load->model('blog/M_Homepage');

		$limit = 10;
		$count_data = $this->M_Homepage->query(true);

		if (empty($count_data)) return false;
		
		$page = ($this->input->get('page')) ? $limit*($this->input->get('page')-1) : 0;

		$read_data = $this->M_Homepage->query(false,$limit,$page);

		if (empty($read_data)) redirect(base_url());

		$read_post = $this->blog_post_query($site,$read_data);
		
		return $read_post;
	}

	public function blog_post_query($site,$id){
		$this->db->select('*');
		$this->db->from($this->table_blog_post);		
		$this->db->where_in('id',$id);
		$this->db->order_by('time','DESC');		
		$read = $this->db->get()->result_array();

		/**
	    * Build post
	    */
		$post = $this->_Post->read_long($site,$read);

		return $post;
	}	
}