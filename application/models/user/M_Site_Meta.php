<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('site/M_Site_Meta_Data_Default');
	}

	public function init(){	

		$site = $this->site;
		$page_type = strtolower($this->router->class);
		$site['page_type'] = $page_type;
		$site['modules'] = 'user'; /* for visitor record */	

		if ($page_type == 'payment') {
			if ($this->router->method != 'order') {
				$page_type = strtolower($this->router->method);
				$site['page_type'] = $page_type;
			}
		}

		$build = $this->build($site,$page_type);

		return array_merge($site,$build);
	}	

	public function build($site,$page_type){

		$meta = false;


		if ($page_type == 'profile') {
			
			$title = $this->lang->line('my_profile');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);		

		}
		elseif ($page_type == 'courses') {
			
			$title = $this->lang->line('my_courses');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);	
		}
		elseif ($page_type == 'wishlist') {
			
			$title = $this->lang->line('my_wishlist');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);	
		}
		elseif ($page_type == 'order') {
			
			$title = $this->lang->line('my_order');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);	
		}	

		elseif ($page_type == 'payment') {
			
			$title = $this->lang->line('payment');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);	
		}

		elseif ($page_type == 'confirmation') {
			
			$title = $this->lang->line('payment_confirmation');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);	
		}

		elseif ($page_type == 'waiting') {
			
			$title = $this->lang->line('wait_payment');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);	
		}

		elseif ($page_type == 'waiting_confirmation') {
			
			$title = $this->lang->line('wait_confirmation');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);	
		}	
		
		elseif ($page_type == 'success') {
			
			$title = $this->lang->line('success_payment');

			$meta = $this->meta_general([
				'title' => $title,
				'description' => $site['description'],
				'image' => $site['image'],
				'icon' => $site['icon'],
				]);	
		}
		
		return ['meta' => $meta];
	}	

	public function meta_general($data){

		$meta_general = $this->M_Site_Meta_Data_Default->generate($data);

		return $meta_general;
	}

}