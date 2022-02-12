<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Setting_Smtp extends CI_Model
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
		$smtp_data = [
		"protocol" => $post['protocol'],
		"smtp_host" => $post['smtp_host'],
		"smtp_port" => $post['smtp_port'],
		"smtp_user" => $post['smtp_user'],
		"smtp_pass" => $post['smtp_pass'],
		];

		$data[] = [
		'type' => 'smtp',
		'data' => json_encode($smtp_data,true),
		];		

		return $this->_Process_MYSQL->update_data_multiple($this->table_site,$data,'type');
	}
}