<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lesson extends My_Lms{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('lms/_Lesson');
		$this->load->model('lms/_Courses');
		$this->load->model('lms/M_Lesson');
	}  

	public function index($slug,$section,$lesson)
	{

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;
		$courses = $this->M_Lesson->data_course($site,$slug,$section,$lesson);

		$data = [		
			'site' => $site,
			'template' => $template,
			'widget' => $widget,			
			'courses' => $courses
		];

		$this->load->view('lms/'.$template['name'].'/lesson/index', $data);
	}

}
