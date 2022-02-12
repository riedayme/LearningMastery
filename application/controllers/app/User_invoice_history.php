<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_invoice_history extends My_App
{

    public $index = 'app/user_invoice_history/index';
    public $form = 'app/user_invoice_history/form';
    public $redirect = 'app/user_invoice_history';

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_User_Invoice_History');         

        if ($this->site['payment_method'] != 'Manual') {
            redirect(base_url('app'));
        }        
    }    

    public function index()
    {

        $data = [
        'title' => 'Invoice History',
        'statistic' => $this->M_User_Invoice_History->statistic()
        ];

        $this->load->view($this->index, array_merge($data,$this->M_User_Invoice_History->datatables()));
    }    


    public function datatables()
    {

        $data = $this->M_User_Invoice_History->data_table();

        echo $data;
    }  
}
