<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tags extends My_Blog{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('blog/M_Tags');
	}  

	public function index($tags)
	{

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;
		$blog_post = $this->M_Tags->data_post($site,$tags);

		$data = [		
			'site' => $site,
			'template' => $template,
			'widget' => $widget,					
			'blog_post' => $blog_post
		];
		
		$this->load->view('blog/templates/'.$template['name'].'/homepage/index', $data);
	}

}
