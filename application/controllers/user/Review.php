<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends My_User
{

    public function __construct(){
        parent::__construct();

        $this->load->model('user/M_Review');       
    }   

    public function read(){

        /** check if ajax request */
        if ($this->input->is_ajax_request()) {

            $process = $this->M_Review->read();

        }else{
            redirect(base_url());
        }    
    }

    public function process(){

        /** check if ajax request */
        if ($this->input->is_ajax_request()) {

            $process = $this->M_Review->process();

        }else{
            redirect(base_url());
        }
    }    

}
