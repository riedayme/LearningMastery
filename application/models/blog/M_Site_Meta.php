<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('_Image');

		$this->load->model('blog/_Post');
		$this->load->model('blog/M_Site_Meta_Post');
		$this->load->model('blog/M_Site_Meta_Pages');
		$this->load->model('blog/M_Site_Meta_Category');
		$this->load->model('blog/M_Site_Meta_Tags');	

		$this->load->model('lms/M_Site_Meta_Data_OG');		
		$this->load->model('lms/M_Site_Meta_Data_Twitter_Card');

		$this->load->model('site/M_Site_Meta_Data_Default');
		$this->load->model('site/M_Site_Meta_Data_Schema');
	}

	public function init(){	
		$site = $this->site;
		$page_type = strtolower($this->router->class);
		$site['page_type'] = $page_type;
		$site['modules'] = 'blog'; /* for visitor record */	

		$build = $this->build($site,$page_type);

		/**
		 * Set Cache if active.
		 */
		if ($site['cache'] == 'Yes' AND $page_type != 'search') {
			$this->output->cache(1);
		}
		
		return array_merge($site,$build);
	}

	public function build($site,$page_type){

		$sub_title = false;
		$meta = false;

		if ($page_type == 'homepage') {

			if (!empty($this->input->get('page'))) {
				$title = $site['title'].' - '.$this->lang->line('blog').' - '.$this->lang->line('page').' '.$this->input->get('page');
				$sub_title = $this->lang->line('blog_post').' - '.$this->lang->line('page').' '.$this->input->get('page');
			}else{
				$title = $site['title'].' - '.$this->lang->line('blog');
				$sub_title = $this->lang->line('blog_post');
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
		elseif ($page_type == 'category') {

			$category = $this->M_Site_Meta_Category->read($this->uri->segment(2));	

			if (!empty($this->input->get('page'))) {
				$title =  $this->lang->line('category').' - '.$category['name'].' | '.$this->lang->line('page').' '.$this->input->get('page');
				$sub_title =  $this->lang->line('category').' : '.$category['name'].' | '.$this->lang->line('page').' '.$this->input->get('page');
			}else{
				$title =  $this->lang->line('category').' - '.$category['name'];
				$sub_title =  $this->lang->line('category').' : '.$category['name'];
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
		elseif ($page_type == 'tags') {

			$tags = $this->M_Site_Meta_Tags->read($this->uri->segment(2));	

			if (!empty($this->input->get('page'))) {
				$title = $this->lang->line('tags').' - '.$tags['name'].' | '.$this->lang->line('page').' '.$this->input->get('page');
				$sub_title = $this->lang->line('tags').' : '.$tags['name'].' | '.$this->lang->line('page').' '.$this->input->get('page');
			}else{
				$title = $this->lang->line('tags').' - '.$tags['name'];
				$sub_title = $this->lang->line('tags').' : '.$tags['name'];
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
		elseif ($page_type == 'search') {
			$q = strip_tags($this->input->get('q'));

			if (!$q) redirect(base_url('blog'));

			if (!empty($this->input->get('page'))) {
				$title = $this->lang->line('search').' : '.$q.' | '.$this->lang->line('page').' '.$this->input->get('page');
				$sub_title = $this->lang->line('search').' : '.$q.' | '.$this->lang->line('page').' '.$this->input->get('page');
			}else{
				$title = $this->lang->line('search').' : '.$q;
				$sub_title = $this->lang->line('search').' : '.$q;
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
		elseif ($page_type == 'post') {

			$read = $this->M_Site_Meta_Post->read(urldecode($this->uri->segment(2)));	
			$post = $this->_Post->read_short_single($site,$read);
			$category = $this->_Post->read_category($read['id_category']);			
			$tags = $this->_Post->read_tags($read['id_tags']);

			$title = $post['title'].' - '.$site['title'];
			$description = $post['description'];
			$image = $post['image']['original'];
			$published = $read['time'];
			$updated = $read['updated'];

			$meta = $this->meta_detail([
				'title' => $title,
				'description' => $description,
				'image' => $image,
				'icon' => $site['icon'],

				'published' => $published,
				'updated' => $updated,
				'tags' => $tags,

				'breadcrumb' => [
					'title' => $post['title'],
					'category' => $category
				],

				'site_name' => $site['title'],

				'schema' => $site['meta']['schema'],
				'open_graph' => $site['meta']['open_graph'],
				'twitter_card' => $site['meta']['twitter_card']				
				]);		

		}
		elseif ($page_type == 'pages') {

			$read_pages = $this->M_Site_Meta_Pages->read(urldecode($this->uri->segment(2)));

			$title = $read_pages['title'];
			$description = ctsubstr($read_pages['content'],150);;
			$image = $this->_Image->first_image($read_pages['content']);
			$published = $read_pages['time'];			
			$updated = $read_pages['updated'];

			$meta = $this->meta_detail([
				'title' => $title,
				'description' => $description,
				'image' => $image,
				'icon' => $site['icon'],

				'published' => $published,
				'updated' => $updated,
				'tags' => false,

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
		$schema = $this->M_Site_Meta_Data_Schema->generate($data['schema'],$data['breadcrumb']);
		$open_graph = $this->M_Site_Meta_Data_OG->detail($data);
		$twitter_card = $this->M_Site_Meta_Data_Twitter_Card->detail($data);

		return $meta_general.$schema.$open_graph.$twitter_card;
	}	
}