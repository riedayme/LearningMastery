<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_api_key extends My_App{

	public $index = 'app/setting_api_key/index';
	public $redirect = 'app/setting_api_key';

	public function __construct(){
		parent::__construct();

		$this->load->model('app/M_Setting_General'); 
		$this->load->model('app/M_Setting_Api_Key');         
	}   

	public function index()
	{

		$data = array(
			'title' => 'Setting Api Key', 
			'site' => $this->M_Setting_General->read_data(),
		);        

		$this->load->view($this->index, $data);
	}

	public function process(){
		$process = $this->M_Setting_Api_Key->process();

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
