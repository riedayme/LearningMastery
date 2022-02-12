<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('lms/_Courses');
		$this->load->model('lms/M_Site_Meta_Courses');
		$this->load->model('lms/M_Site_Meta_Courses_Lesson');			

		$this->load->model('lms/M_Site_Meta_Data_OG');		
		$this->load->model('lms/M_Site_Meta_Data_Twitter_Card');

		$this->load->model('site/M_Site_Meta_Data_Default');
		$this->load->model('site/M_Site_Meta_Data_Schema');
	}

	public function init(){	
		$site = $this->site;
		$page_type = strtolower($this->router->class);
		$site['page_type'] = $page_type;
		$site['modules'] = 'lms'; /* for visitor record */	

		$build = $this->build($site,$page_type);

		/**
		 * Set Cache if active.
		 */
		if ($site['cache'] == 'Yes' AND $page_type != 'filter') {
			if (empty($this->session->userdata('user'))) {
				$this->output->cache(1);
			}
		}

		return array_merge($site,$build);
	}

	public function build($site,$page_type){

		$sub_title = false;
		$meta = false;

		if ($page_type == 'homepage') {

			if (!empty($this->input->get('page'))) {
				$title = $site['title'].' - '.$this->lang->line('courses').' - '.$this->lang->line('page').' '.$this->input->get('page');
				$sub_title = $this->lang->line('material_list').' - '.$this->lang->line('page').' '.$this->input->get('page');
			}else{
				$title = $site['title'];
				$sub_title = $this->lang->line('material_list');
			}

			$meta = $this->meta_index([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				'schema' => $site['meta']['schema'],
				'open_graph' => $site['meta']['open_graph'],
				'twitter_card' => $site['meta']['twitter_card']				
				]);			

		}		
		elseif ($page_type == 'filter') {		

			if (!empty($this->input->get('index'))) {
				$title = $this->lang->line('filter_material').' | '.$this->lang->line('page').' '.$this->input->get('index');
				$sub_title = $this->lang->line('filter_material').' | '.$this->lang->line('page').' '.$this->input->get('index');
			}else{
				$title = $this->lang->line('filter_material');
				$sub_title = $this->lang->line('filter_material');
			}

			$meta = $this->meta_index([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				'schema' => $site['meta']['schema'],
				'open_graph' => $site['meta']['open_graph'],
				'twitter_card' => $site['meta']['twitter_card']				
				]);										
		}
		elseif ($page_type == 'courses') {

			$read = $this->M_Site_Meta_Courses->read(urldecode($this->uri->segment(2)));
			$courses = $this->_Courses->read_long_single($site,$read);

			$title = $courses['title'].' - '.$site['title'];
			$description = ctsubstr($courses['description'],150);
			$image = $courses['image']['original'];
			$published = $read['time'];
			$updated = $read['updated'];
			$tags = [$courses['category']];		

			$meta = $this->meta_detail([
				'title' => $title,
				'description' => $description,
				'image' => $image,
				'icon' => $site['icon'],

				'published' => $published,
				'updated' => $updated,
				'tags' => $tags,

				'courses' => [
				'title' => $courses['title'],
				'description' => $description
				],

				'breadcrumb' => [
				'title' => $courses['title'],
				'category' => $courses['sub_category']
				],			

				'site_name' => $site['title'],

				'schema' => $site['meta']['schema'],
				'open_graph' => $site['meta']['open_graph'],
				'twitter_card' => $site['meta']['twitter_card']				
				]);				

		}
		elseif ($page_type == 'lesson') {

			$read = $this->M_Site_Meta_Courses_Lesson->read(urldecode($this->uri->segment(2)));
			$courses = $this->_Courses->read_long_single($site,$read);

			$title = $courses['title'];
			$description = ctsubstr($courses['description'],150);
			$image = $courses['image']['original'];
			$published = $read['time'];
			$updated = $read['updated'];
			$tags = [$courses['category']];				

			$meta = $this->meta_detail([
				'title' => $title,
				'title_original' => $courses['title'],					
				'description' => $description,
				'image' => $image,
				'icon' => $site['icon'],

				'published' => $published,
				'updated' => $updated,
				'tags' => $tags,

				'courses' => false,
				'breadcrumb' => false,

				'site_name' => $site['title'],

				'schema' => $site['meta']['schema'],
				'open_graph' => $site['meta']['open_graph'],
				'twitter_card' => $site['meta']['twitter_card']				
				]);				
		}
		
		return [
		'sub_title' => $sub_title,
		'meta' => $meta,
		];
	}	

	public function meta_index($data){

		$meta_general = $this->M_Site_Meta_Data_Default->generate($data);
		$schema = $this->M_Site_Meta_Data_Schema->generate($data['schema']);
		$open_graph = $this->M_Site_Meta_Data_OG->index($data);
		$twitter_card = $this->M_Site_Meta_Data_Twitter_Card->index($data);

		return $meta_general.$schema.$open_graph.$twitter_card;
	}

	public function meta_detail($data){

		$meta_general = $this->M_Site_Meta_Data_Default->generate($data);
		$schema = $this->M_Site_Meta_Data_Schema->generate($data['schema'],$data['breadcrumb'],$data['courses']);
		$open_graph = $this->M_Site_Meta_Data_OG->detail($data);
		$twitter_card = $this->M_Site_Meta_Data_Twitter_Card->detail($data);

		return $meta_general.$schema.$open_graph.$twitter_card;
	}	
}