<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends My_App
{

    public $index = 'app/dashboard/index';
    public $redirect = 'app/index';    

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_Dashboard');       
    }   
    
    public function index()
    {

        $read_all_required = $this->M_Dashboard->get_statistic();

        $data = array(
            'title' => 'Dashboard',          
        );

        $this->data = array_merge($data, $read_all_required);        

        $this->load->view($this->index, $this->data);
    }

}
