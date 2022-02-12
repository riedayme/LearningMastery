<?php defined('BASEPATH') or exit('No direct script access allowed');

ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Blog_post extends My_App
{

    public $index = 'app/blog_post/index';
    public $form = 'app/blog_post/form';
    public $redirect = 'app/blog_post';

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_Blog_Post');         
    }    

    public function index()
    {

        $data = [
            'title' => 'Blog Post',
        ];

        $this->load->view($this->index, array_merge($data,$this->M_Blog_Post->datatables()));
    }

    public function datatables()
    {

        $data = $this->M_Blog_Post->data_table();

        echo $data;
    }

    public function create()
    {

        $data = array(
            'title' => 'Create',
            'ckeditor' => true,
            'onbeforeunload' => false,
            'datetimepicker' => true,
        );

        $this->load->view($this->form, array_merge($data,$this->M_Blog_Post->required()));
    }    

    public function update($id){
        $data = array(
            'title' => 'Update',
            'ckeditor' => true,
            'onbeforeunload' => false,
            'datetimepicker' => true,
            'blog_post' => $this->M_Blog_Post->data_update($id),
        );

        $this->load->view($this->form, array_merge($data,$this->M_Blog_Post->required()));
    }    

    public function delete($id)
    {
        if ($this->M_Blog_Post->process_delete($id) == TRUE) {
            echo true;
        }else {
            echo false;
        }
    }

    public function process(){

        if (!empty($this->input->post('id'))) {

            if ($this->M_Blog_Post->process_update() == TRUE) {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_update'),
                ]);
            }   

        }else {

            if ($this->M_Blog_Post->process_create() == TRUE) {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_create'),
                ]);
            }   
        }

        if (!empty($this->input->post('save'))) {
            redirect($this->input->post('save'),'refresh');
        }else {                
            redirect(base_url($this->redirect));
        }
    }

    public function process_multiple()
    {

        $id = explode(',', $this->input->post('id'));
        $action = $this->input->post('action');

        /**
         * Update Post to Published
         */
        if ($action == 'post') {

            foreach ($id as $key => $item) 
            {
                $data[] = array(
                    'id' => $id[$key],
                    'status' => 'Published',
                );
            }

            if ($this->M_Blog_Post->process_multiple_update($data) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }        

        /**
         * Update Post to Draft
         */
        if ($action == 'draft') {

            foreach ($id as $key => $item) 
            {
                $data[] = array(
                    'id' => $id[$key],
                    'status' => 'Draft',
                );
            }

            if ($this->M_Blog_Post->process_multiple_update($data) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

        /**
         * Delete Post
         */
        if ($action == 'delete') {

            if ($this->M_Blog_Post->process_multiple_delete($id) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

    }

}
