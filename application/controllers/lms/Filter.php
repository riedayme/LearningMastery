<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Filter extends My_Lms{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('lms/_Courses');
		$this->load->model('lms/M_Filter');
	}  

	public function index()
	{

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;	
		$courses = $this->M_Filter->data_courses($site);		

		$data = [		
		'site' => $site,
		'template' => $template,
		'widget' => $widget,				
		'courses' => $courses
		];
		
		$this->load->view('lms/'.$template['name'].'/filter/index', $data);
	}

}
