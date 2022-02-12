<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Pages extends CI_Model
{

	public $table_site_pages = 'tb_site_pages';		

	public function read($slug){
		$this->db->select('
			title,
			permalink,
			time,	
			updated,	
			content,
			');
		$this->db->from($this->table_site_pages);		
		$this->db->where('permalink',urldecode($slug));
		$this->db->where("status = 'Published'"); 		
		$query = $this->db->get();

		if ($query->num_rows() < 1) redirect(base_url());

		$pages = $query->row_array();

		return $pages;
	}

}