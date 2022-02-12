<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_smtp extends My_App{

	public $index = 'app/setting_smtp/index';
	public $redirect = 'app/setting_smtp';

	public function __construct(){
		parent::__construct();

		$this->load->model('app/M_Setting_General'); 
		$this->load->model('app/M_Setting_Smtp');         
	}   

	public function index()
	{

		$data = array(
			'title' => 'Setting SMTP', 
			'site' => $this->M_Setting_General->read_data(),
		);        

		$this->load->view($this->index, $data);
	}

	public function process(){
		$process = $this->M_Setting_Smtp->process();

		if ($process) {
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'info',
				'message_text' => $this->lang->line('success_update'),
			]);
		}

		redirect(base_url($this->redirect));
	}

}
