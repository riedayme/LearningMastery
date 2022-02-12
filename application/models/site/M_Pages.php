<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Pages extends CI_Model {

	public $table_site_pages = 'tb_site_pages';

	public function data_post($site,$slug){

		$post =  $this->query_post($site,$slug);

		return $post;
	}

	public function query_post($site,$slug){
		$this->db->select('*');
		$this->db->from($this->table_site_pages);		
		$this->db->where('permalink',urldecode($slug));
		$this->db->order_by('time','DESC');
		$query = $this->db->get();

		$read = $query->row_array();

		/**
	    * Build Post
	    */
		$pages = $this->_Pages->read($site,$read);

		return $pages;
	}	

}