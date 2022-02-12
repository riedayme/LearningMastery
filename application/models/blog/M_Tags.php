<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Tags extends CI_Model
{

	public $table_blog_post = 'tb_blog_post';
	public $table_blog_post_tags = 'tb_blog_post_tags';

	public function data_post($site,$tags){

		$id_tag = $this->_Process_MYSQL->get_data($this->table_blog_post_tags,['slug'=>$tags]);
		if ($id_tag->num_rows() < 1) redirect(base_url());
		$id_tag = $id_tag->row()->id;

		$limit = $site['blog_limit_post'];
		$count_data = $this->query($id_tag,true);

		if (empty($count_data)) return false;

		$index = ($this->input->get('page')) ? $limit*($this->input->get('page')-1) : 0;

		$pagination = $this->_Pagination->pagination($count_data,$limit,base_url('blog-tags/'.$tags),FALSE,TRUE,'page');

		$read_data = $this->query($id_tag,false,$limit,$index);
		if (empty($read_data)) redirect(base_url('blog-tags/'.$tags));

		$read_post = $this->query_post($site,$read_data);

		return [
			'data' => $read_post,
			'pagination' => $pagination,
			'count_data' => $count_data				
		];
	}

	public function query($id_tag,$count = false,$limit = false,$index = false){

		$this->db->select('id');
		$this->db->from($this->table_blog_post);		
		if (!$count) {
			$this->db->limit($limit,$index);
		}
		$this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'"); 
		$this->db->like("id_tags",$id_tag);	
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
		$this->db->from($this->table_blog_post);		
		$this->db->where_in('id',$id);
		$this->db->order_by('time','DESC');		
		$read = $this->db->get()->result_array();

		/**
	    * Build Post
	    */
		$this->load->model('site/_Post');
		$post = $this->_Post->read_long($site,$read);

		return $post;
	}

}