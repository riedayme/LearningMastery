<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_Post extends CI_Model {

	public $table_blog_post = 'tb_blog_post';
	public $table_blog_post_category = 'tb_blog_post_category';
	public $table_blog_post_tags = 'tb_blog_post_tags';

	public function data_post($site,$widget,$slug){

		$post =  $this->query_post($site,$widget,$slug);

		$prev_post = $this->prev_post($site,$post['time_original']);
		$next_post = $this->next_post($site,$post['time_original']);

		$related_post = $this->related_post($site,$post['id'],$post['id_category']);

		$comment_post = $this->comment_post($site,$post['id']);

		return array_merge($post,$prev_post,$next_post,$related_post,$comment_post);
	}

	public function query_post($site,$widget,$slug){
		$this->db->select('*');
		$this->db->from($this->table_blog_post);		
		$this->db->where('permalink',urldecode($slug));
		$this->db->order_by('time','DESC');
		$query = $this->db->get();

		$read = $query->row_array();

		/**
	    * Build Post
	    */		
		$post = $this->_Post->read_long_single($site,$widget,$read);

		return $post;
	}	

	public function prev_post($site,$date) {
		$this->db->select('id,title,image,description,content,permalink,time,updated');
		$this->db->from($this->table_blog_post);		
		$this->db->limit(1);
		$this->db->where('time <',$date);
		// $this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'"); 			
		$this->db->order_by('time','DESC');
		$query = $this->db->get();

		$count = $query->num_rows();

		if ($count < 1) return [
			'prev_post' => false
		];

		$read = $query->row_array();  

		/**
	    * Build Post
	    */		
		$post = $this->_Post->read_short_single($site,$read);	

		return [
			'prev_post' => $post
		];
	}

	public function next_post($site,$date) {
		$this->db->select('id,title,image,description,content,permalink,time,updated');
		$this->db->from($this->table_blog_post);		
		$this->db->limit(1);
		$this->db->where('time >',$date);
		// $this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'"); 			
		$this->db->order_by('time','ASC');
		$query = $this->db->get();

		$count = $query->num_rows();

		if ($count < 1) return [
			'next_post' => false
		];

		$read = $query->row_array();  

		/**
	    * Build Post
	    */		
		$post = $this->_Post->read_short_single($site,$read);	

		return [
			'next_post' => $post
		];
	}

	public function related_post($site,$id_post,$id_category) {

		$this->db->select('id,title,image,content,permalink,time,updated,views');
		$this->db->from($this->table_blog_post);		
		$this->db->limit(3);
		$this->db->where('id !=',$id_post);  
		$this->db->where('id_category',$id_category); 
		$this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'");		 
		$this->db->order_by('time','DESC');
		$query = $this->db->get();

		$count = $query->num_rows();


		if ($count < 1) return [
			'related_post' => false
		];

		$read = $query->result_array();

		/**
	    * Build Post
	    */		
		$post = $this->_Post->read_short($site,$read);

		return [
			'related_post' => $post
		];
	}


	public function comment_post($site,$id_post) {

		if ($site['blog_comment']['type'] == 'disqus') {

			return $this->M_Post_Comment->disqus($site);
		}elseif ($site['blog_comment']['type'] == 'system') {

			return $this->M_Post_Comment->system($site,$id_post);
		}else{
			return [
				'comment_post' => false
			];
		}

	}

}