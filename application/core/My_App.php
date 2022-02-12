<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_App extends MY_Controller
{

    public $site;
    
    public function __construct()
    {
        parent::__construct();

        /**
         * Check Auth
         */
        $this->load->model('user/M_Auth');
        $this->M_Auth->check('not_exist', 'status', 'auth');

        /**
         * Set Rules Instructor
         */
        if ($this->session->userdata('app_grade') == 'Instructor') {
            if ($this->uri->segment(2) === 'lms_courses' OR $this->uri->segment(2) === 'user_invoice' OR $this->uri->segment(2) === 'user_invoice_history' OR $this->uri->segment(2) === 'setting_payment' OR $this->uri->segment(2) === 'user_setting') {
            }else{
                redirect(base_url('app/lms_courses'));
            }
        }

        /**
         * Read Site Setting > Comment Type
         */
        $this->load->model('app/M_Setting_General');     
        $this->site = $this->M_Setting_General->read_data();
    }

}
