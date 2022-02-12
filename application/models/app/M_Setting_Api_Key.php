<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Setting_Api_Key extends CI_Model
{

	public $table_user = 'tb_user';
	public $table_site = 'tb_site';

	public function read_data(){

		$read = $this->_Process_MYSQL->get_data($this->table_user,['id' => $this->session->userdata('id')])->row_array();
		$read = json_decode($read['payment'],true);	

		return $read;
	}

	public function process(){
		
		$post = $this->input->post();

		/**
		 * build facebook data
		 */
		$facebook_data = [
			"facebook_app_id" =>  $post['facebook_app_id'],
			"facebook_app_secret" =>   $post['facebook_app_secret']
		];

		$data[] = [
			'type' => 'fb_app',
			'data' => json_encode($facebook_data,true),
		];

		/**
		 * build google api data
		 */
		$google_data = [
			"client_id" =>  $post['client_id'],
			"client_secret" =>   $post['client_secret']
		];

		$data[] = [
			'type' => 'google_api',
			'data' => json_encode($google_data,true),
		];	

		/**
		 * build google reCaptcha data
		 */
		$recaptcha_data = [
			"status" =>  $post['status'],			
			"site_key" =>  $post['site_key'],
			"secret_key" =>   $post['secret_key']
		];

		$data[] = [
			'type' => 'google_recaptcha',
			'data' => json_encode($recaptcha_data,true),
		];			

		return $this->_Process_MYSQL->update_data_multiple($this->table_site,$data,'type');
	}
}