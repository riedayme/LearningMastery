<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Sitemap extends CI_Model
{

	public $table_lms_courses = 'tb_lms_courses';
	public $table_blog_post = 'tb_blog_post';
	public $table_site_pages = 'tb_site_pages';	

	public function index_courses($splid){

		$query = $this->db
		->select("id")
		->from($this->table_lms_courses)
		->where("time <= NOW()")
		->where("status = 'Published'")        
		->get();

		$total_post = $query->num_rows();

		if ($total_post < 1) return false;

		for ($i=1; $i <= ceil($total_post / $splid) ; $i++) {

			$data = $this->sitemap_courses($i,$splid);

			$dates = false;
			foreach ($data as $read) {
				if (empty($read['updated'])) {
					$dates[] = $read['time'];
				}else {
					$dates[] = $read['updated'];
				}
			}

			$extract[] = [
			'url' => 'sitemap-courses-'.$i.'.xml',
			'lastmod' => date("c",max(array_map('strtotime',$dates)))
			];
		}

		return $extract;
	}

	public function index_blog_post($splid){
		$query = $this->db
		->select("id")
		->from($this->table_blog_post)
		->where("time <= NOW()")
		->where("status = 'Published'")        
		->get();

		$total_post = $query->num_rows();

		if ($total_post < 1) return false;

		for ($i=1; $i <= ceil($total_post / $splid) ; $i++) {

			$data = $this->sitemap_blog_post($i,$splid);

			$dates = false;
			foreach ($data as $read) {
				if (empty($read['updated'])) {
					$dates[] = $read['time'];
				}else {
					$dates[] = $read['updated'];
				}
			}

			$extract[] = [
			'url' => 'sitemap-blog-post-'.$i.'.xml',
			'lastmod' => date("c",max(array_map('strtotime',$dates)))
			];
		}

		return $extract;
	}

	public function index_pages($splid){
		$query = $this->db
		->select("id")
		->from($this->table_site_pages)
		->where("time <= NOW()")
		->where("status = 'Published'")        
		->get();

		$total_post = $query->num_rows();

		if ($total_post < 1) return false;

		for ($i=1; $i <= ceil($total_post / $splid) ; $i++) {

			$data = $this->sitemap_pages($i,$splid);

			$dates = false;
			foreach ($data as $read) {
				if (empty($read['updated'])) {
					$dates[] = $read['time'];
				}else {
					$dates[] = $read['updated'];
				}
			}

			$extract[] = [
			'url' => 'sitemap-pages-'.$i.'.xml',
			'lastmod' => date("c",max(array_map('strtotime',$dates)))
			];
		}

		return $extract;
	}	

	public function sitemap_courses($page,$splid){

		$limit = $splid;

		if ($page == 1) {
			$index = 0;
		}else {
			$index = $limit * ($page - 1);
		}

		$data = $this->db
		->select("permalink,time,updated")
		->from($this->table_lms_courses)
		->where("time <= NOW()")
		->where("status = 'Published'")
		->limit($limit,$index)
		->order_by('id','ASC')
		->get();

		if ($data->num_rows() < 1) return false;

		return $data->result_array();
	}	

	public function sitemap_blog_post($page,$splid){

		$limit = $splid;

		if ($page == 1) {
			$index = 0;
		}else {
			$index = $limit * ($page - 1);
		}

		$data = $this->db
		->select("permalink,time,updated")
		->from($this->table_blog_post)
		->where("time <= NOW()")
		->where("status = 'Published'")
		->limit($limit,$index)
		->order_by('id','ASC')
		->get();

		if ($data->num_rows() < 1) return false;

		return $data->result_array();
	}

	public function sitemap_pages($page,$splid){

		$limit = $splid;

		if ($page == 1) {
			$index = 0;
		}else {
			$index = $limit * ($page - 1);
		}

		$data = $this->db
		->select("permalink,time,updated")
		->from($this->table_site_pages)
		->where("time <= NOW()")
		->where("status = 'Published'")
		->limit($limit,$index)
		->order_by('id','ASC')
		->get();

		if ($data->num_rows() < 1) return false;

		return $data->result_array();
	}	

}