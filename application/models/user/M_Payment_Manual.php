<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Payment_Manual extends CI_Model
{

    public $table_lms_coupon = 'tb_lms_coupon';
    public $table_lms_user_payment = 'tb_lms_user_payment';

    public function check_coupon($coupon_code,$courses_id){

        $check_coupon = $this->_Process_MYSQL->get_data($this->table_lms_coupon,[
            'code' => $coupon_code
        ]);

        if ($check_coupon->num_rows() > 0) {

            $read_coupon = $check_coupon->row_array();

            $courses_detail =$this->M_Payment_Coupon->read_courses($courses_id);
            $courses_price_total = $courses_detail['price']-$courses_detail['discount'];

            if ($read_coupon['type'] == 'Percent') {
                $discount_coupon = $read_coupon['data'] / 100 * $courses_price_total;
                $price_total = $courses_price_total - $discount_coupon;
            }elseif ($read_coupon['type'] == 'Price') {
                $discount_coupon = $read_coupon['data'];
                $price_total = $courses_price_total - $discount_coupon;
            }

            return $price_total;
        }
    }


    public function process_manual(){

        $post = $this->input->post();
        $courses_id = strip_tags($post['id_courses']);
        $id_user = $this->session->userdata('id_user');
        $order_id = $id_user.'C'.$courses_id.'T'.date('ymdHis');

        /**
         * process using coupon
         */
        if (strip_tags($post['code']) AND $courses_price_total = $this->check_coupon(strip_tags($post['code']),$courses_id)) {
            
            if ($this->process([
                'id' => $order_id,
                'id_user' => $id_user,
                'id_courses' => $courses_id,
                'id_courses_user' => strip_tags($post['id_courses_user']),                
                'type' => strip_tags($post['payment_method']),
                'amount' => $courses_price_total,
                'token' => strip_tags($post['transaction']),
                'coupon' => strip_tags($post['code']),
                'time' => date('Y-m-d H:i:s'),
                'status' => 'Pending',
            ])) {
                return $order_id;
            }

        }else {

            $courses = $this->M_Payment_Coupon->read_courses($courses_id);
            $courses_price_total = $courses['price']-$courses['discount'];

            /* process without coupon code */
            if ($this->process([
                'id' => $order_id,
                'id_user' => $id_user,
                'id_courses' => $courses_id,
                'id_courses_user' => strip_tags($post['id_courses_user']),                              
                'type' => strip_tags($post['payment_method']),
                'amount' => $courses_price_total,
                'token' => strip_tags($post['transaction']),
                'time' => date('Y-m-d H:i:s'),
                'status' => 'Pending',
            ])) {
                return $order_id;
            }

        }
    }

    public function process($data){
        if ($this->_Process_MYSQL->insert_data($this->table_lms_user_payment, $data)) {
            return true;
        }
    }
}