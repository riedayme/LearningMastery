<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends My_Blog{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('site/_Post');
		$this->load->model('blog/M_Homepage');
	}  

	public function index()
	{

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;
		$blog_post = $this->M_Homepage->data_post($site);

		$data = [		
			'site' => $site,
			'template' => $template,
			'widget' => $widget,			
			'blog_post' => $blog_post
		];

		$this->load->view('blog/templates/'.$template['name'].'/homepage/index', $data);
	}

}
