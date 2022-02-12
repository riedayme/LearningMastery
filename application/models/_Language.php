<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Language extends CI_Model
{

	public $table_site = 'tb_site';

	public function load(){

		$language = $this->get_lang();

		$lang[] = "date";
		$lang[] = "general";
		$lang[] = "blog";
		$lang[] = "app";
		$lang[] = "lms";		

		$set_language = (!empty($this->session->userdata('language')) ? $this->session->userdata('language') : $language);
		$this->lang->load($lang,$set_language);

	}  

	public function get_lang(){
		return $this->_Process_MYSQL->get_data($this->table_site, array('type' => 'language'))->row()->data;  
	}

}