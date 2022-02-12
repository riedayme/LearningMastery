<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Homepage extends My_Lms{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('lms/_Courses');
		$this->load->model('lms/M_Homepage');
	}  

	public function index()
	{

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;
		$courses = $this->M_Homepage->data_courses($site);

		$data = [		
			'site' => $site,
			'template' => $template,
			'widget' => $widget,			
			'courses' => $courses
		];

		$this->load->view('lms/'.$template['name'].'/homepage/index', $data);
	}

}
