<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_post_comment extends My_App{

    public $index = 'app/blog_post_comment/index';

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_Blog_Post_Comment');        

        if ($this->site['blog_comment']['type'] != 'system') {
            redirect(base_url('app'));
        }       
    }  

    public function index()
    {

        $data = [
            'title' => 'Blog Comment',
        ];

        $this->load->view($this->index, array_merge($data,$this->M_Blog_Post_Comment->datatables()));
    }    

    public function datatables()
    {

        $data = $this->M_Blog_Post_Comment->data_table();

        echo $data;
    }  

    public function delete($id)
    {
        if ($this->M_Blog_Post_Comment->process_delete($id) == TRUE) {
            echo true;
        }else {
            echo false;
        }
    }

    public function process(){

        if (!empty($this->input->post('id'))) {

            if ($this->M_Blog_Post_Comment->process_update() == TRUE) {

                echo json_encode([
                    'status' => true,
                    'title' => $this->lang->line('success_update')
                ]);
            }   

        }else {

            if ($this->M_Blog_Post_Comment->process_create() == TRUE) {

                echo json_encode([
                    'status' => true,
                    'title' => $this->lang->line('success_create')
                ]);
            }   

        }

    }    

    public function process_multiple()
    {

        $id = explode(',', $this->input->post('id'));
        $action = $this->input->post('action');

        if ($action == 'approved') {

            foreach ($id as $key => $item) 
            {
                $data[] = array(
                    'id' => $id[$key],
                    'status' => 'Approved',
                );
            }

            if ($this->M_Blog_Post_Comment->process_multiple_update($data) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }    

        if ($action == 'blocked') {

            foreach ($id as $key => $item) 
            {
                $data[] = array(
                    'id' => $id[$key],
                    'status' => 'Blocked',
                );
            }

            if ($this->M_Blog_Post_Comment->process_multiple_update($data) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }          

        if ($action == 'delete') {

            if ($this->M_Blog_Post_Comment->process_multiple_delete($id) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

    }    

}