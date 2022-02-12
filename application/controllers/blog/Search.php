<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends My_Blog{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('blog/M_Search');
	}  

	public function index()
	{

		$keyword = strip_tags($this->input->get('q'));

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;	
		$blog_post = $this->M_Search->data_post($site,$keyword);

		$data = [		
			'site' => $site,
			'template' => $template,
			'widget' => $widget,			
			'blog_post' => $blog_post
		];
		
		$this->load->view('blog/templates/'.$template['name'].'/homepage/index', $data);
	}

}
