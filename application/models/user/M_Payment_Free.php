<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Payment_Free extends CI_Model
{

    public $table_lms_coupon = 'tb_lms_coupon';
    public $table_lms_user_payment = 'tb_lms_user_payment';	

    public function check_free_code($coupon_id,$courses_id){

        $check_coupon = $this->_Process_MYSQL->get_data($this->table_lms_coupon,[
            'id' => $coupon_id
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

            if ($price_total < 1) {
                return true;
            }else{
                return false;
            }
        }
    }

    public function process_free(){

        $post = $this->input->post();
        $code = base64_decode(strip_tags($post['free_code']));
        $extract = explode('__', $code);
        $coupon_id = $extract[0];
        $courses_id = $extract[1];

        if ($this->check_free_code($coupon_id,$courses_id)) {

            $read_coupon = $this->_Process_MYSQL->get_data($this->table_lms_coupon,[
                'id' => $coupon_id
                ])->row_array();

            $id_user = $this->session->userdata('id_user');
            $order_id = $id_user.'C'.$courses_id.'T'.date('ymdHis');

            $post_data = [
            'id' => $order_id,
            'id_user' => $id_user,
            'id_courses' => $courses_id,	
            'id_courses_user' => strip_tags($post['id_courses_user']),
            'type' => strip_tags($post['payment_method']),
            'amount' => '',
            'token' => 'free',
            'coupon' => strip_tags($post['code']),            
            'time' => date('Y-m-d H:i:s'),
            'updated' => date('Y-m-d H:i:s'),
            'status' => 'Purchased',
            ];

            if ($this->_Process_MYSQL->insert_data($this->table_lms_user_payment, $post_data)) {

                if ($this->M_Payment->insert_purchased_courses($order_id)) {
                    return true;
                }
            }
        }

    }
}