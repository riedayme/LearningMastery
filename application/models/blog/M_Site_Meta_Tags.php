<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Tags extends CI_Model
{

	public $table_blog_post_tags = 'tb_blog_post_tags';

	public function read($slug){
		$this->db->select('name');
		$this->db->from($this->table_blog_post_tags);		
		$this->db->where('slug',$slug);
		$query = $this->db->get();

		if ($query->num_rows() < 1) redirect(base_url('blog'));

		$tags = $query->row_array();

		return $tags;
	}

}