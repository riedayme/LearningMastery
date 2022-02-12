<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class My_Blog extends MY_Site {
    
    public function __construct()
    {
      parent::__construct();

        /**
         * Load Meta Data
         */
        $this->load->model('blog/M_Site_Meta');
        $this->site = $this->M_Site_Meta->init();

        /**
         * Load Template data
         */
        $this->load->model('blog/M_Template');
        $this->template = $this->M_Template->init();

        /**
         * Load Template Widget
         */
        $this->load->model('blog/M_Template_Widget');
        $template_widget = $this->M_Template_Widget->init($this->site,$this->template);
        if ($template_widget) $this->widget = array_merge($this->template['widget'],$template_widget);  

        /**
        * Record Visitor
        * Place here because if caching active record not running.
        */
        $this->load->model('site/M_Site_Visitor');
        $this->M_Site_Visitor->record($this->site);                
    }    

}