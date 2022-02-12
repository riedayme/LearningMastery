<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Public controllers
 */
class MY_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('_Process_MYSQL');
		$this->load->model('_Process_Upload');   
		$this->load->model('_Pagination');        		
		$this->load->model('_Language');
		$this->load->model('_Date');


		/**
        * Set Language
        */
		$this->_Language->load();
	}

}


/**
 * Include Controller 
 */
require_once 'My_App.php';
require_once 'My_Site.php';
