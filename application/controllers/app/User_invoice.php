<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_invoice extends My_App
{

    public $index = 'app/user_invoice/index';
    public $form = 'app/user_invoice/form';
    public $redirect = 'app/user_invoice';

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_User_Invoice');         

        if ($this->site['payment_method'] != 'Manual') {
            redirect(base_url('app'));
        }        
    }    

    public function index()
    {

        $data = [
        'title' => 'Invoice',
        ];

        $this->load->view($this->index, array_merge($data,$this->M_User_Invoice->datatables()));
    }    


    public function datatables()
    {

        $data = $this->M_User_Invoice->data_table();

        echo $data;
    }  

    public function read(){
        echo json_encode($this->M_User_Invoice->read());
    }

    public function process(){       

        $process = $this->M_User_Invoice->process();

        if ($process) {
            echo json_encode([
                'status' => true,
                'message' => 'Success '.$process.' this invoice'
                ]);
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

            if ($this->M_User_Invoice->process_multiple_update($id,'Active') == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }        

        /**
         * Update user to block
         */
        if ($action == 'block') {

            if ($this->M_User_Invoice->process_multiple_update($id,'Blocked') == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

        /**
         * Delete user
         */
        if ($action == 'delete') {

            if ($this->M_User_Invoice->process_multiple_delete($id) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

    }    

}
