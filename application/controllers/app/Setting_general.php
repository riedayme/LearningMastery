<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_general extends My_App{

	public $index = 'app/setting_general/index';
	public $redirect = 'app/setting_general';

	public function __construct(){
		parent::__construct();

		$this->load->model('app/M_Setting_General');         
	}   

	public function index()
	{

		$data = array(
			'title' => 'Setting General', 
			'site' => $this->M_Setting_General->read_data(),         
		);        

		$this->load->view($this->index, $data);
	}

	public function process(){

		$process = $this->M_Setting_General->process_update();

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
