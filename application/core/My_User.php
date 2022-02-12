<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class My_User extends MY_Site {

	public function __construct(){
		parent::__construct();

		/**
        * Check Auth
        */
		if (strtolower($this->router->method) == 'notification_midtrans'){

		}else{
			$this->load->model('user/M_Auth'); 
			$this->M_Auth->check('not_exist', 'user', 'auth');
			$this->M_Auth->check_user();
		}

		/**
        * Load Meta Data
        */
		$this->load->model('user/M_Site_Meta');
		$this->site = $this->M_Site_Meta->init(); 

        /**
         * Load Template Widget
         */
        $this->load->model('lms/M_Template_Widget');
        $template_widget = $this->M_Template_Widget->init($this->site,$this->template);
        if ($template_widget) $this->widget = $template_widget;  

		// if ($this->uri->segment(2) != 'review'){ 
			 // skip for process review user on page lms > lesson 
	    // }

    }    

}