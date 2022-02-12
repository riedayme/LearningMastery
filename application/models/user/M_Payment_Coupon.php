<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Payment_Coupon extends CI_Model
{

    public $table_lms_courses = 'tb_lms_courses';
    public $table_lms_coupon = 'tb_lms_coupon';
    public $table_lms_user_payment = 'tb_lms_user_payment';	

    public function read_courses($identity){
        $this->db->select('
            tb_lms_courses.id,				
            tb_lms_courses.title,            								
            tb_lms_courses.price,
            tb_lms_courses.discount
            ');
        $this->db->from($this->table_lms_courses);		
        $this->db->where('tb_lms_courses.id',$identity);
        $this->db->where('tb_lms_courses.price != 0');
        $this->db->where("time <= NOW()");
        $this->db->where("status = 'Published'"); 				
        return $this->db->get()->row_array();
    }

    public function check_coupon(){

        $check_coupon = $this->_Process_MYSQL->get_data($this->table_lms_coupon,[
            'code' => $this->input->post('code')
            ]);

        $check_user_payment = $this->_Process_MYSQL->get_data($this->table_lms_user_payment,[
            'id_user' =>  $this->session->userdata('id_user'), 
            'coupon' => $this->input->post('code')
            ]);

        if ($check_user_payment->num_rows() > 0) {
            return [
            'status' => 'coupon_reuse'
            ];
        }

        if ($check_coupon->num_rows() > 0) {

            $read_coupon = $check_coupon->row_array();

            $coupon_expired = strtotime($read_coupon['expired']);
            $today = strtotime(date('Y-m-d H:i:s'));            

            if ($coupon_expired < $today) {
                return [
                'status' => 'coupon_expired'
                ];
            }

            $courses_detail =$this->read_courses($this->input->post('id_courses'));
            $courses_price_total = $courses_detail['price']-$courses_detail['discount'];

            $this->load->model('_Currency');

            if ($read_coupon['type'] == 'Percent') {
                $discount_coupon = $read_coupon['data'] / 100 * $courses_price_total;
                $price_total = $courses_price_total - $discount_coupon;
            }elseif ($read_coupon['type'] == 'Price') {
                $discount_coupon = $read_coupon['data'];
                $price_total = $courses_price_total - $discount_coupon;
            }

            if ($price_total < 1) {
                return [
                'status' => 'valid_to_free',
                'discount_coupon' => $this->_Currency->set_currency($discount_coupon),
                'price_total' => '0',
                'free_code' => base64_encode($read_coupon['id'].'__'.$courses_detail['id'])
                ];
            }else {			
                if ($this->site['payment_method'] == 'Manual') {
                    return [
                    'status' => 'valid_not_free_manual',
                    'discount_coupon' => $this->_Currency->set_currency($discount_coupon),
                    'price_total' => $this->_Currency->set_currency($price_total),
                    ];
                }elseif ($this->site['payment_method'] == 'Midtrans') {	
                    return [
                    'status' => 'valid_not_free_midtrans',
                    'discount_coupon' => $this->_Currency->set_currency($discount_coupon),
                    'price_total' => $this->_Currency->set_currency($price_total),
                    'midtrans_token' => $this->M_Payment_Midtrans->create_token($courses_detail,$price_total)['token']
                    ];
                }
            }


        }else {
            return [
            'status' => 'invalid'
            ];
        }
    }
}