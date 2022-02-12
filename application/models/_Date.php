<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Date extends CI_Model
{

	public $table_site = 'tb_site';

	public function __construct()
	{
		parent::__construct();

		$timezone = $this->get_timezone();
		date_default_timezone_set($timezone);
	}

	public function get_timezone(){
		return $this->_Process_MYSQL->get_data($this->table_site, array('type' => 'time_zone'))->row()->data;  
	}

	function set($date, $new_format)
	{

		// D	=	Mon through Sun
		// l	=	Sunday through Saturday
		// N	=	1 (for Monday) through 7 (for Sunday)
		// w	=	0 (for Sunday) through 6 (for Saturday)
		// F	=	January through December
		// M	=	Jan through Dec

		$timestamp = strtotime($date);

		$prety_date = date($new_format, $timestamp);

		if ( strpos($new_format, 'F') !== FALSE )
		{
			$month_name     = $this->lang->line('month_name');
			$month_global   = date('F', $timestamp);
			$month_global_n = date('n', $timestamp);
			$month_id       = $month_name[$month_global_n];
			$prety_date     = str_replace($month_global, $month_id, $prety_date);
		}

		if (strpos($new_format, 'M') !== FALSE) {
			$month_name = $this->lang->line('month_name');
			$month_global2 = date('M', $timestamp);
			$month_global_n2 = date('n', $timestamp);
			$month_id2 = $month_name[$month_global_n2];
			$prety_date = str_replace($month_global2, substr($month_id2, 0, 3), $prety_date);
		}
		if (strpos($new_format, 'l') !== FALSE) {
			$day_name = $this->lang->line('day_name');
			$day_global = date('l', $timestamp);
			$day_global_n = date('w', $timestamp);
			$day_id = $day_name[$day_global_n];
			$prety_date = str_replace($day_global, $day_id, $prety_date);
		}
		if (strpos($new_format, 'D') !== FALSE) {
			$day_name = $this->lang->line('day_name');
			$day_global2 = date('D', $timestamp);
			$day_global_n2 = date('w', $timestamp);
			$day_id2 = $day_name[$day_global_n2];
			$prety_date = str_replace($day_global2, substr($day_id2, 0, 3), $prety_date);
		}

		return $prety_date;
	}

}