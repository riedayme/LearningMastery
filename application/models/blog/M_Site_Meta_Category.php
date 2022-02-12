<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Category extends CI_Model
{

	public $table_blog_post_category = 'tb_blog_post_category';	

	public function read($slug){
		$this->db->select('name');
		$this->db->from($this->table_blog_post_category);		
		$this->db->where('slug',$slug);
		$query = $this->db->get();

		if ($query->num_rows() < 1) redirect(base_url('blog'));

		$category = $query->row_array();

		return $category;
	}

}