<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends My_Lms{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('lms/_Lesson');
		$this->load->model('lms/_Courses');
		$this->load->model('lms/M_Courses');	
	}  

	public function index($slug)
	{

		$site = $this->site;
		$template = $this->template;
		$widget= $this->widget;
		$courses = $this->M_Courses->data_course($site,$slug);

		$data = [		
		'site' => $site,
		'template' => $template,
		'widget' => $widget,			
		'courses' => $courses
		];

		if ($this->session->userdata('order-status-'.$courses['id'])) {
			$this->session->unset_userdata('order-status-'.$courses['id']);
		}

		/* if have param review-page and access with out ajax > redirect */
		if ($this->input->get('review-page')) {
			if (!$this->input->is_ajax_request()) {
				redirect(base_url());
			}
		}

		$this->load->view('lms/'.$template['name'].'/courses/index', $data);
	}

}
