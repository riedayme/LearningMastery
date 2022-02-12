
<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Filter extends CI_Model
{

	public $table_lms_courses = 'tb_lms_courses';  
	public $table_lms_category = 'tb_lms_category'; 	

	public function data_courses($site){

		$filter = $this->input->get();

		if (!empty($filter['page'])) {
			unset($filter['page']);
		}

		$limit = $site['lms_limit_post'];
		$count_data = $this->query($filter,true);

		if (empty($count_data)) return false;

		$index = (!empty($this->input->get('page'))) ? $limit*($this->input->get('page')-1) : 0;

		$pagination = $this->_Pagination->pagination($count_data,$limit,base_url('courses-filter?'.http_build_query($filter)),FALSE,TRUE,'page');			

		$read_data = $this->query($filter,false,$limit,$index);
		if (empty($read_data)) redirect(base_url());

		$read_post = $this->query_post($filter,$site,$read_data);

		return [
		'data' => $read_post,
		'pagination' => $pagination,
		'count_data' => $count_data			
		];
	}

	public function query($filter,$count = false,$limit = false,$index = false){

		if (!empty($filter['category'])) {
			$id_category = $this->_Process_MYSQL->get_data($this->table_lms_category,['slug'=>strip_tags($filter['category'])]);
			if ($id_category->num_rows() < 1) {
				$id_category = false;
			}else {
				$id_category = $id_category->row()->id;
			}
		}		

		$this->db->select('id');
		$this->db->from($this->table_lms_courses);		
		if (!$count) {
			$this->db->limit($limit,$index);
		}
		$this->db->where("time <= NOW()");
		$this->db->where("status = 'Published'"); 

		if (!empty($filter['q'])) {
			$this->db->like("title",strip_tags($filter['q']));			
		}

		if (!empty($id_category)) {
			$this->db->where("id_sub_category",$id_category);
		}

		if (!empty($filter['price'])) {
			if (strip_tags($filter['price']) == 'free') {
				$this->db->where("price = 0");
			}elseif (strip_tags($filter['price']) == 'paid') {
				$this->db->where("price > 0");
			}
		}	

		if (!empty($filter['sort'])) {
			if (strip_tags($filter['sort']) == 'price_high') {
				$this->db->order_by('price','DESC');
			}
			elseif (strip_tags($filter['sort']) == 'price_low') {
				$this->db->order_by('price','ASC');
			}
			elseif (strip_tags($filter['sort']) == 'new') {
				$this->db->order_by('time','DESC');
			}elseif (strip_tags($filter['sort']) == 'old') {
				$this->db->order_by('time','ASC');
			}
		}else {
			$this->db->order_by('time','DESC');
		}			

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

	public function query_post($filter,$site,$id){
		$this->db->select('*');
		$this->db->from($this->table_lms_courses);		
		$this->db->where_in('id',$id);
		if (!empty($filter['sort'])) {
			if (strip_tags($filter['sort']) == 'price_high') {
				$this->db->order_by('price','DESC');
			}
			elseif ($filter['sort'] == 'price_low') {
				$this->db->order_by('price','ASC');
			}
			elseif ($filter['sort'] == 'new') {
				$this->db->order_by('time','DESC');
			}elseif ($filter['sort'] == 'old') {
				$this->db->order_by('time','ASC');
			}
		}else {
			$this->db->order_by('time','DESC');
		}

		$read = $this->db->get()->result_array();

		/**
	    * Build Course
	    */
		$post = $this->_Courses->read_long($site,$read);

		return $post;
	}

}