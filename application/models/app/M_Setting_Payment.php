<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Setting_Payment extends CI_Model
{

	public $table_user = 'tb_user';
	public $table_site = 'tb_site';

	public function read_data(){

		$read = $this->_Process_MYSQL->get_data($this->table_user,['id' => $this->session->userdata('id')])->row_array();
		$read = json_decode($read['payment'],true);	

		return $read;
	}

	public function process_payment_setting(){
		
		$post = $this->input->post();

		foreach ($post as $key => $value) {

			if ($key == 'status_production') continue;
			if ($key == 'client_key') continue;	
			if ($key == 'server_key') continue;

			$data [] = [
				'type' => $key,
				'data' => $value,
			];
		}

		/**
		 * build midtrans data
		 */
		$midtrans_data = [
			"status_production" =>  $post['status_production'],			
			"client_key" =>  $post['client_key'],
			"server_key" =>   $post['server_key']
		];

		$data[] = [
			'type' => 'payment_midtrans',
			'data' => json_encode($midtrans_data,true),
		];

		return $this->_Process_MYSQL->update_data_multiple($this->table_site,$data,'type');
	}

	public function build_data_create($type) {

		$post = $this->input->post();
		$read_data = $this->read_data();		 

		if ($read_data['transaction']) {
			foreach ($read_data['transaction'] as $transaction) {
				$data_transaction[] = [
					"identity" => $transaction['identity'],				
					"type" => $transaction['type'],
					"account_number" => $transaction['account_number'],
					"receiver" => $transaction['receiver']
				];
			}
		}

		if ($read_data['confirmation']) {
			foreach ($read_data['confirmation'] as $confirmation) {
				$data_confirmation[] = [
					"identity" => $confirmation['identity'],				
					"type" => $confirmation['type'],
					"data" => $confirmation['data']
				];
			}
		}

		if ($type == 'form-transaction') {
			$data_transaction[] = [
				"identity" => $post['type'].date('YmdHis'),						
				"type" => $post['type'],
				"account_number" => $post['account_number'],
				"receiver" => $post['receiver']
			];
		}

		if ($type == 'form-confirmation') {
			$data_confirmation[] = [
				"identity" => $post['type'].date('YmdHis'),			
				"type" => $post['type'],
				"data" => $post['data']
			];
		}

		$post_data = [
			'transaction' => $data_transaction,
			'confirmation' => $data_confirmation
		];

		return json_encode($post_data);
	}

	public function process_create($type){

		$post_data = $this->build_data_create($type);

		return $this->_Process_MYSQL->update_data($this->table_user,['payment' => $post_data],[
			'id' => $this->session->userdata('id'),
		]);
	}

	public function build_data_update($type) {

		$post = $this->input->post();
		$read_data = $this->read_data();		 

		if ($read_data['transaction']) {
			foreach ($read_data['transaction'] as $transaction) {

				if ($type == 'form-transaction') {
					if ($post['identity'] == $transaction['identity']) {
						$data_transaction[] = [
							"identity" => $post['identity'],
							"type" => $post['type'],
							"account_number" => $post['account_number'],
							"receiver" => $post['receiver']
						];

						continue;
					}
				}

				$data_transaction[] = [
					"identity" => $transaction['identity'],
					"type" => $transaction['type'],
					"account_number" => $transaction['account_number'],
					"receiver" => $transaction['receiver']
				];

			}
		}

		if ($read_data['confirmation']) {
			foreach ($read_data['confirmation'] as $confirmation) {

				if ($type == 'form-confirmation') {
					if ($post['identity'] == $confirmation['identity']) {
						$data_confirmation[] = [
							"identity" => $post['identity'],
							"type" => $post['type'],
							"data" => $post['data']
						];

						continue;
					}			
				}

				$data_confirmation[] = [
					"identity" => $confirmation['identity'],
					"type" => $confirmation['type'],
					"data" => $confirmation['data']
				];
			}
		}

		$post_data = [
			'transaction' => $data_transaction,
			'confirmation' => $data_confirmation
		];

		return json_encode($post_data);
	}

	public function process_update($type){

		$post_data = $this->build_data_update($type);

		return $this->_Process_MYSQL->update_data($this->table_user,['payment' => $post_data],[
			'id' => $this->session->userdata('id'),
		]);
	}	

	public function build_data_delete($type,$identity){

		$read_data = $this->read_data();

		foreach ($read_data['transaction'] as $transaction) {

			if ($type == 'transaction') {
				if ($identity == $transaction['identity']) continue;
			}

			$data_transaction[] = [
				"identity" => $transaction['identity'],
				"type" => $transaction['type'],
				"account_number" => $transaction['account_number'],
				"receiver" => $transaction['receiver']
			];
		}

		foreach ($read_data['confirmation'] as $confirmation) {

			if ($type == 'confirmation') {
				if ($identity == $confirmation['identity']) continue;
			}

			$data_confirmation[] = [
				"identity" => $confirmation['identity'],
				"type" => $confirmation['type'],
				"data" => $confirmation['data']
			];
		}

		$post_data = [
			'transaction' => $data_transaction,
			'confirmation' => $data_confirmation
		];

		return json_encode($post_data);
	}

	public function process_delete($type,$identity){

		$post_data = $this->build_data_delete($type,$identity);

		return $this->_Process_MYSQL->update_data($this->table_user,['payment' => $post_data],[
			'id' => $this->session->userdata('id'),
		]);
	}
}