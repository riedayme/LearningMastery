<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_widget extends My_App{

	public $index = 'app/blog_widget/index';
	public $form = 'app/blog_widget/form';	
	public $redirect = 'app/blog_widget';
	public $redirect_create = 'app/blog_widget/create';	

	public function __construct(){
		parent::__construct();

		$this->load->model('app/M_Blog_Widget');  
		$this->load->model('app/M_Blog_Post');

		$this->load->model('app/M_Site_Pages');
	}   

	public function index()
	{

		$data = array(
			'title' => 'Blog Widget', 
			'widget' => $this->M_Blog_Widget->read_widget(),
		);        

		$data = array_merge($data,$this->M_Blog_Post->required('withpost'),$this->M_Site_Pages->required());

		$this->load->view($this->index, $data);
	}

	public function create()
	{

		$id_template = $this->M_Blog_Widget->read_template();
		$ads_content = $this->M_Blog_Widget->check_ads_content($id_template);

		$data = array(
			'title' => 'Create New',
			'ads_content' => $ads_content,
			'id_template' => $id_template,
		);

		$this->load->view($this->form, $data);
	}    

	public function update($id){

		$id_template = $this->M_Blog_Widget->read_template();
		$ads_content = $this->M_Blog_Widget->check_ads_content($id_template);		

		$data = array(
			'title' => 'Update',
			'ads_content' => $ads_content,
			'id_template' => $id_template,			
			'widget' => $this->M_Blog_Widget->data_update($id),
		);

		$this->load->view($this->form, $data);
	}    

	public function delete($id)
	{
		if ($this->M_Blog_Widget->process_delete($id) == TRUE) {
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'danger',
				'message_text' => $this->lang->line('success_delete'),
			]);
		}else {
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'danger',
				'message_text' => $this->lang->line('failed_delete'),
			]);
		}

		redirect(base_url($this->redirect));		
	}	

	public function process(){

		if (!empty($this->input->post('id'))) {

			if ($this->M_Blog_Widget->process_update() == TRUE) {

				$this->session->set_flashdata([
					'message' => true,
					'message_type' => 'info',
					'message_text' => $this->lang->line('success_update'),
				]);
			}   

		}else {

			if ($this->M_Blog_Widget->process_create() == TRUE) {

				$this->session->set_flashdata([
					'message' => true,
					'message_type' => 'info',
					'message_text' => $this->lang->line('success_create'),
				]);
			}   
		}		

		redirect(base_url($this->redirect));
	}

	public function process_update_widget(){

		$process = $this->M_Blog_Widget->process_update_widget();

		if ($process) {
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'info',
				'message_text' => $this->lang->line('success_update'),
			]);
		}else {
			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'warning',
				'message_text' => $this->lang->line('failed_update'),
			]);
		}

		redirect(base_url($this->redirect));
	}	

}
