<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends My_User
{

    public $index = 'user/order/index';
    public $redirect = 'user/order';

    public function __construct(){
        parent::__construct();

        $this->load->model('user/M_Order');       
    }   
    
    public function index()
    {

        $site = $this->site;
        $widget= $this->widget; 
        $order = $this->M_Order->read($site);

        $data = array(
            'site' => $site,
            'widget' => $widget,    
            'order' =>  $order,
            'midtrans' => ($site['payment_method'] == 'Midtrans' ? true : false),
        );
        
        $this->load->view($this->index, $data);
    }

}
