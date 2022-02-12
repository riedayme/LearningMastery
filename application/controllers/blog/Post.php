<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends My_Blog{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('blog/_Post');
		$this->load->model('blog/M_Post');
		$this->load->model('blog/M_Post_Comment');		
	}  

	public function index($slug)
	{

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;
		$post = $this->M_Post->data_post($site,$widget,$slug);

		$data = [		
			'site' => $site,
			'template' => $template,
			'widget' => $widget,				
			'post' => $post,
		];

		if(count($this->input->post()) > 0 ) {

			$this->M_Post_Comment->post_comment($this->site);
		}else {

			$this->session->set_userdata('csrf_code', substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 32));
		}
		
		$this->load->view('blog/templates/'.$template['name'].'/post/index', $data);
	}

}
