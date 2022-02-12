<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends My_Blog{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('site/_Pages');
		$this->load->model('site/M_Pages');
	}  

	public function index($slug)
	{

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;
		$post = $this->M_Pages->data_post($site,$slug);

		$data = [		
			'site' => $site,
			'template' => $template,
			'widget' => $widget,			
			'post' => $post,
		];
		
		$this->load->view('blog/templates/'.$template['name'].'/pages/index', $data);
	}

}
