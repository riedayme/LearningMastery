<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Category extends CI_Model
{

	public $table_blog_post = 'tb_blog_post';
	public $table_blog_post_category = 'tb_blog_post_category';

	public function data_post($site,$category){

		$id_category = $this->_Process_MYSQL->get_data($this->table_blog_post_category,['slug'=>$category]);
		if ($id_category->num_rows() < 1) redirect(base_url());
		$id_category = $id_category->row()->id;

		$limit = $site['blog_limit_post'];
		$count_data = $this->query($id_category,true);

		if (empty($count_data)) return false;

		$index = ($this->input->get('page')) ? $limit*($this->input->get('page')-1) : 0;

		$pagination = $this->_Pagination->pagination($count_data,$limit,base_url('blog-category/'.$category),FALSE,TRUE,'page');			

		$read_data = $this->query($id_category,false,$limit,$index);
		if (empty($read_data)) redirect(base_url('blog-category/'.$category));

		$read_post = $this->query_post($site,$read_data);

		return [
			'data' => $read_post,
			'pagination' => $pagination,
			'count_data' => $count_data				
		];
	}

	public function query($id_category,$count = false,$limit = false,$index = false){

		$this->db->select('id');
		$this->db->from($this->table_blog_post);		
		if (!$count) {
			$this->db->limit($limit,$index);
		}
		$this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'"); 
		$this->db->where("id_category",$id_category); 		
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