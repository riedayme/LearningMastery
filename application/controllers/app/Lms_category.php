<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lms_category extends My_App{


    public $index = 'app/lms_category/index';
    public $form = 'app/lms_category/form';
    public $redirect = 'app/lms_category';

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_LMS_Category');         
    }    

    public function index()
    {

        $data = [
            'title' => 'LMS Category',
            'category' => $this->M_LMS_Category->data()
        ];

        $this->load->view($this->index, array_merge($data));
    }

    public function create()
    {

        $data = array(
            'title' => 'LMS Category',
            'sub_title' => 'Create Category',
            'fontawesomepicker' => true,
        );

        $this->load->view($this->form, array_merge($data,$this->M_LMS_Category->required()));
    }   

    public function update($id)
    {

        $data = array(
            'title' => 'LMS Category',
            'sub_title' => 'Update Category',
            'fontawesomepicker' => true,
            'data' => $this->M_LMS_Category->data_update($id),
            'parent' => $this->M_LMS_Category->check_parent($id),            
        );

        $this->load->view($this->form, array_merge($data,$this->M_LMS_Category->required()));
    }           

    public function delete($id)
    {
        if ($this->M_LMS_Category->process_delete($id) == TRUE) {
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

            if ($this->M_LMS_Category->process_update() == 'success') {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_update'),
                ]);
            }elseif ($this->M_LMS_Category->process_update() == 'invalid') {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'warning',
                    'message_text' => $this->lang->line('duplicate_category'),
                ]); 
            }else{

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'warning',
                    'message_text' => $this->lang->line('failed_update'),
                ]);              
            }            

        }else {    

            if ($this->M_LMS_Category->process_create() == 'success') {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_create'),
                ]);
            }elseif ($this->M_LMS_Category->process_create() == 'invalid') {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'warning',
                    'message_text' => $this->lang->line('duplicate_category'),
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

}