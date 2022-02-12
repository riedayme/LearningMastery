<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class My_Site extends MY_Controller {

	public $site;
	public $template;
	public $widget;

	public function __construct()
	{
		parent::__construct();

		/**
		* Load Site data
		*/
		$this->load->model('site/M_Site');
		$this->site = $this->M_Site->init();
	}

	public function _output($output)
	{

		$output = $this->minifier->run($output);

		if ($this->output->cache_expiration > 0)
		{
			$this->output->_write_cache($output);
		}

		echo $output;
	}    

}

require_once 'My_User.php';
require_once 'My_Lms.php';
require_once 'My_Blog.php';