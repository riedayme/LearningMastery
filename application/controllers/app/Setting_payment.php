<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_payment extends My_App{

	public $index = 'app/setting_payment/index';
	public $redirect = 'app/setting_payment';

	public function __construct(){
		parent::__construct();

		$this->load->model('app/M_Setting_General'); 
		$this->load->model('app/M_Setting_Payment');         
	}   

	public function index()
	{

		$data = array(
			'title' => 'Setting Payment', 
			'site' => $this->M_Setting_General->read_data(),			
			'payment' => $this->M_Setting_Payment->read_data(),         
		);        

		$this->load->view($this->index, $data);
	}

	public function process_setting(){
		$process = $this->M_Setting_Payment->process_payment_setting();

		if ($process) {
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'info',
				'message_text' => $this->lang->line('success_update'),
			]);
		}

		redirect(base_url($this->redirect));
	}

	public function process($type){

		if (!empty($this->input->post('identity'))) {

			if ($this->M_Setting_Payment->process_update($type)) {

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

		}else {    

			if ($this->M_Setting_Payment->process_create($type)) {

				$this->session->set_flashdata([
					'message' => true,
					'message_type' => 'info',
					'message_text' => $this->lang->line('success_create'),
				]);
			}else{

				$this->session->set_flashdata([
					'message' => true,
					'message_type' => 'warning',
					'message_text' => $this->lang->line('failed_create'),
				]); 
			}

		}		

		redirect(base_url($this->redirect));

	}

	public function delete($type,$identity) {

		$process = $this->M_Setting_Payment->process_delete($type,$identity);

		if ($process) {
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'danger',
				'message_text' => $this->lang->line('success_delete'),
			]);
		}else{
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'warning',
				'message_text' => $this->lang->line('failed_delete'),
			]);
		}

		redirect(base_url($this->redirect));
	}

}
