<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_setting extends My_App
{

    public $form = 'app/user/form';
    public $redirect = 'app/user_setting';

    public function __construct(){
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->model('app/M_User');         
    }     

    public function index(){

        $this->M_User->set_validation();

        if($this->form_validation->run() != false){

            $this->process();
            
        }else{    

            $data = array(
                'title' => 'Profile Setting',
                'user' => $this->M_User->data_update($this->session->userdata('id')),
                );

            $this->load->view($this->form, $data);
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

        }

        redirect(base_url($this->redirect));
    }

}
