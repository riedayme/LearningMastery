<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Lesson extends CI_Model
{

	public $table_lms_courses = 'tb_lms_courses';  

	public function data_course($site,$slug,$section,$lesson){

		$courses =  $this->query_post($site,$slug);

		/**
		 * check user courses 
		 */
		$user_courses = $this->_Courses->check_courses($courses);

		if ($site['lms_free_courses_readable'] == 'No') {
			if (empty($user_courses['user_courses'])) redirect(base_url('auth'));
		}

		if (empty($user_courses['user_courses']) AND !empty($courses['price'])) redirect(base_url('auth'));

		$build_lesson = $this->_Lesson->build_lesson($courses);

		$read_lesson = $this->_Lesson->read_lesson($lesson,$build_lesson,$section);

		return array_merge($courses,$build_lesson,$read_lesson);
	}

	public function query_post($site,$slug){
		$this->db->select('*');
		$this->db->from($this->table_lms_courses);		
		$this->db->where('permalink',urldecode($slug));
		$this->db->order_by('time','DESC');
		$query = $this->db->get();

		$read = $query->row_array();

		/**
	    * Build Course
	    */		
		$post = $this->_Courses->read_long_single($site,$read);

		return $post;
	}

}