<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Payment_Midtrans extends CI_Model
{

    public $table_lms_coupon = 'tb_lms_coupon';
    
    public $table_lms_user_payment = 'tb_lms_user_payment';	
    public $table_lms_user_courses = 'tb_lms_user_courses';

    public function midtrans_key($site){
        \Midtrans\Config::$serverKey = $site['payment_midtrans']['server_key'];
        \Midtrans\Config::$isProduction = ($site['payment_midtrans']['status_production'] == 'Yes') ? true : false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }	

    public function create_token($courses,$price_from_coupon = false){

        $user = $this->M_Profile->read();

        $this->midtrans_key($this->site);

        if (!empty($price_from_coupon)) {
            $price_total = $price_from_coupon;
        }else {
            $price_total = $courses['price_total_original'];
        }

        $transaction_details = [
        'order_id' => $user['id'].'C'.$courses['id'].'T'.date('ymdHis'),
        'gross_amount' => $price_total, 
        ];

        $expiry = [
        "start_time" => date('Y-m-d H:i:s O'),
        "unit" => "day",
        "duration" => 1
        ];

        $item_details = [
        [
        'id' => $courses['id'],
        'price' => $price_total,
        'quantity' => 1,
        'name' => $courses['title']
        ]
        ];

        $customer_details = array(
            'first_name'    => $user['username'], 			
            'email'         => $user['email'],
            'phone'         => $user['no_handphone'],
            );

        $credit_card = [
        "secure" => true,
        "save_card" => false
        ];

        $transaction = array(
            'transaction_details' => $transaction_details,
            'expiry' => $expiry,
            'credit_card' => $credit_card,
            'customer_details' => $customer_details,
            'item_details' => $item_details,
            );

        try {

            /*$payment = \Midtrans\Snap::createTransaction($transaction);*/
            $snapToken =  \Midtrans\Snap::getSnapToken($transaction);

            return [
            'token' => $snapToken,
            ];		
        }
        catch (Exception $e) {

            echo $this->lang->line('error_midtrans_config');
            exit;
        }	

    }

    public function process(){

        $request_body = file_get_contents('php://input');
        $post = json_decode($request_body,TRUE);

        $id_order = $post['order_id'];
        $id_courses = explode('C', $id_order)[1];
        $id_courses = explode('T', $id_courses)[0];

        $check_coupon = $this->_Process_MYSQL->get_data($this->table_lms_coupon,[
            'code' => $post['coupon']
            ])->num_rows();

        $post_data = [
        'id' => $post['order_id'],
        'id_user' => $this->session->userdata('id_user'),
        'id_courses' => $id_courses,			
        'id_courses_user' => $post['id_courses_user'],
        'type' => $post['payment_type'],
        'amount' => (int)$post['gross_amount'],
        'token' => $post['token'],
        'coupon' => ($check_coupon > 0 ? $post['coupon'] : ''),        
        'time' => $post['transaction_time'],
        'status' => $post['transaction_status'],
        ];

        if ($this->_Process_MYSQL->insert_data($this->table_lms_user_payment, $post_data)) {
            if ($post_data['status'] == 'pending') {
                return base_url('payment/waiting');
            }
        }else{
            return false;
        }
    }	

    public function handle(){

        $this->midtrans_key($this->site);

        if (!empty($this->input->get('order_id'))) {
            try {

                $notif = \Midtrans\Transaction::status($this->input->get('order_id'));		
            } catch (Exception $e) {

                echo $e->getMessage();
                exit;
            }
        }else {			
            try {
                @$notif = new \Midtrans\Notification();
            } catch (Exception $e) {

                echo $e->getMessage();
                exit;				
            }
        }

        $transaction = $notif->transaction_status;
        /* $type = $notif->payment_type; $fraud = $notif->fraud_status; */
        $order_id = $notif->order_id;

        /*  transaction_status values: capture, settlement, pending, cancel, expire */

        if ($transaction == 'settlement') {
            return $this->update_status($order_id,'Purchased');
        } else if ($transaction == 'pending') {
            return ['status' => false];
        } else if ($transaction == 'deny') {
            return $this->update_status($order_id,'Failed');            
        } else if ($transaction == 'expire') {
            return $this->update_status($order_id,'Failed');
        } else if ($transaction == 'cancel') {
            return $this->update_status($order_id,'Failed');
        }

    }

    public function update_status($order_id,$status){

        $post_data = [
        'status' => $status,
        ];

        if ($this->_Process_MYSQL->update_data($this->table_lms_user_payment,$post_data,['id' => $order_id])) {

            if ($status == 'Purchased') {
                if ($this->insert_purchased_courses($order_id)) {
                    return [
                    'status' => true,
                    'message' => 'Success Update Status id : '.$order_id.' to '.$status,
                    'redirect' => base_url('user/order')
                    ];
                }
            }else {
                if ($this->delete_purchased_courses($order_id)) {
                    return [
                    'status' => true,
                    'message' => 'Success Update Status id : '.$order_id.' to '.$status,
                    'redirect' => base_url('user/order')
                    ];
                }
            }

        }
    }   
}