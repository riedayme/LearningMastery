<?php defined('BASEPATH') or exit('No direct script access allowed');

class User extends My_App
{

    public $index = 'app/user/index';
    public $form = 'app/user/form';
    public $redirect = 'app/user';

    public function __construct(){
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->model('app/M_User');         
    }    

    public function index()
    {

        $data = [
        'title' => 'User',
        ];

        $this->load->view($this->index, array_merge($data,$this->M_User->datatables()));
    }    


    public function datatables()
    {

        $data = $this->M_User->data_table();

        echo $data;
    }

    public function create()
    {

        $this->M_User->set_validation();

        if($this->form_validation->run() != false){

            $this->process();

        }else{            

            $data = array(
                'title' => 'Create',
                );

            $this->load->view($this->form, $data);
        }

    }    

    public function update($id){

        $this->M_User->set_validation();

        if($this->form_validation->run() != false){

            $this->process();
            
        }else{    
            
            $data = array(
                'title' => 'Update',
                'user' => $this->M_User->data_update($id),
                );

            $this->load->view($this->form, $data);
        }
    }    

    public function delete($id)
    {
        if ($this->M_User->process_delete($id) == TRUE) {
            echo true;
        }else {
            echo false;
        }
    }

    public function process(){       

        if (!empty($this->input->post('id'))) {

            if ($this->M_User->process_update() == TRUE) {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_update'),
                    ]);
            }   

        }else {

            if ($this->M_User->process_create() == TRUE) {

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
         * Update user to active
         */
        if ($action == 'active') {

            if ($this->M_User->process_multiple_update($id,'Active') == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }        

        /**
         * Update user to block
         */
        if ($action == 'block') {

            if ($this->M_User->process_multiple_update($id,'Blocked') == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

        /**
         * Delete user
         */
        if ($action == 'delete') {

            if ($this->M_User->process_multiple_delete($id) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

    }    

}
