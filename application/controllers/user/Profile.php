<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends My_User
{

    public $index = 'user/profile/index';
    public $redirect = 'user/profile';

    public function __construct(){
        parent::__construct();

        $this->load->library('form_validation');

        $this->load->model('user/M_Profile');       
    }   
    
    public function index()
    {


        $this->M_Profile->set_validation_register();

        if($this->form_validation->run() != false){

            $process = $this->M_Profile->process();

            if ($process == 'success') {
                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_update'),
                    ]);
            }

            redirect(base_url($this->redirect));

        }else{

            $site = $this->site;
            $widget= $this->widget; 
            $profile = $this->M_Profile->read();

            $data = array(
                'site' => $site,
                'widget' => $widget,    
                'profile' =>  $profile
                );

            $this->load->view($this->index, $data);
        }
    }
}
