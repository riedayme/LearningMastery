<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Currency extends CI_Model
{

	public $table_site = 'tb_site';

	public function get_currency(){
		return $this->_Process_MYSQL->get_data($this->table_site, array('type' => 'currency_format'))->row()->data;  
	}

	public function set_currency($price){

		if (empty($price)) return false;

		$data_currency = $this->get_currency();

		$currency_format = [
			'IDR' => 'Rp ',
			'USD' => '$ ',
		];

		return $currency_format[$data_currency].number_format($price, 0, ',', '.');
	}

}