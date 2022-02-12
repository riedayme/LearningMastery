<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Post extends CI_Model
{

	public $table_blog_post = 'tb_blog_post';

	public function read($slug){

		$this->db->select('
			title,
			permalink,
			image,
			time,	
			updated,	
			content,
			description,
			id_tags,		
			id_category,					
			');
		$this->db->from($this->table_blog_post);		
		$this->db->where('permalink',urldecode($slug));
		$this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'");
		$query = $this->db->get();

		if ($query->num_rows() < 1) redirect(base_url('blog'));

		$post = $query->row_array();

		return $post;
	}

}