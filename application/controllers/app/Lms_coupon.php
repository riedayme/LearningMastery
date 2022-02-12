<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Lms_coupon extends My_App{


    public $index = 'app/lms_coupon/index';

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_LMS_Coupon');         
    }    

    public function index()
    {

        $data = [
        'title' => 'LMS Coupon',
        'datetimepicker' => true,
        ];

        $this->load->view($this->index, array_merge($data,$this->M_LMS_Coupon->datatables()));
    }    

    public function datatables()
    {

        $data = $this->M_LMS_Coupon->data_table();

        echo $data;
    }  

    public function delete($id)
    {
        if ($this->M_LMS_Coupon->process_delete($id) == TRUE) {
            echo true;
        }else {
            echo false;
        }
    }

    public function process(){

        if (!empty($this->input->post('id'))) {

            if ($this->M_LMS_Coupon->process_update() == 'success') {

                echo json_encode([
                    'status' => true,
                    'title' => $this->lang->line('success_update')
                    ]);
            }elseif ($this->M_LMS_Coupon->process_update() == 'invalid') {

                echo json_encode([
                    'status' => 'invalid',
                    'title' => $this->lang->line('duplicate_code')
                    ]);
            }else{

                echo json_encode([
                    'status' => 'invalid',
                    'title' => $this->lang->line('failed_create')
                    ]);                
            }            

        }else {

            if ($this->M_LMS_Coupon->process_create() == 'success') {

                echo json_encode([
                    'status' => true,
                    'title' => $this->lang->line('success_create')
                    ]);
            }elseif ($this->M_LMS_Coupon->process_create() == 'invalid') {

                echo json_encode([
                    'status' => 'invalid',
                    'title' => $this->lang->line('duplicate_code')
                    ]);
            }else{

                echo json_encode([
                    'status' => 'invalid',
                    'title' => $this->lang->line('failed_create')
                    ]);                
            }

        }

    }    

    public function process_multiple()
    {

        $id = explode(',', $this->input->post('id'));
        $action = $this->input->post('action');

        if ($action == 'delete') {

            if ($this->M_LMS_Coupon->process_multiple_delete($id) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

    }    

}