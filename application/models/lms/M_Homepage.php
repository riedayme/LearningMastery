<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Homepage extends CI_Model
{

	public $table_lms_courses = 'tb_lms_courses';      

	public function data_courses($site){

		$limit = $site['lms_limit_post'];
		$count_data = $this->query(true);

		if (empty($count_data)) return false;

		$index = ($this->input->get('page')) ? $limit*($this->input->get('page')-1) : 0;

		$pagination = $this->_Pagination->pagination($count_data,$limit,base_url(),FALSE,TRUE,'page');			

		$read_data = $this->query(false,$limit,$index);
		if (empty($read_data)) redirect(base_url());

		$read_post = $this->query_post($site,$read_data);

		return [
			'data' => $read_post,
			'pagination' => $pagination,
			'count_data' => $count_data			
		];
	}

	public function query($count = false,$limit = false,$index = false){

		$this->db->select('id');
		$this->db->from($this->table_lms_courses);		
		if (!$count) {
			$this->db->limit($limit,$index);
		}
		$this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'"); 
		$this->db->order_by('time','DESC');
		$query = $this->db->get();
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
		$post = $this->_Courses->read_long($site,$read);

		return $post;
	}

}