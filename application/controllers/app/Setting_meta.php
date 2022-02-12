<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_meta extends My_App{

	public $index = 'app/setting_meta/index';
	public $redirect = 'app/setting_meta';

	public function __construct(){
		parent::__construct();

		$this->load->model('app/M_Setting_Meta');         
	}   

	public function index()
	{

		$data = array(
			'title' => 'Setting Meta', 
			'meta' => $this->M_Setting_Meta->read_data(),         
		);        

		$this->load->view($this->index, $data);
	}

	public function process(){

		$process = $this->M_Setting_Meta->process_update();

		if ($process) {
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'info',
				'message_text' => $this->lang->line('success_update'),
			]);
		}else{
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'warning',
				'message_text' => $this->lang->line('failed_update'),
			]);
		}

		redirect(base_url($this->redirect));

	}


}
