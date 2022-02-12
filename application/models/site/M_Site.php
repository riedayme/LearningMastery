<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site extends CI_Model
{

	public $table_site = 'tb_site';

	public function init(){
		$site = $this->read_site();
		$meta = $this->read_site_meta();
		$site['meta'] = $meta;

		return $site;
	}

	public function read_site(){
		$read_site = $this->_Process_MYSQL->read_data($this->table_site, 'type', 'ASC')->result_array();      

		foreach ($read_site as $data_site) {
			$site[$data_site['type']] = $data_site['data'];
		}


		$site['image'] = base_url('storage/images/'.$site['image']);

		$site['blog_comment'] = json_decode($site['blog_comment'],true);
		$site['payment_midtrans'] = json_decode($site['payment_midtrans'],true);		
		$site['cookie_notification'] = json_decode($site['cookie_notification'],true);

		$site['google_recaptcha'] = json_decode($site['google_recaptcha'],true);
		$site['fb_app'] = json_decode($site['fb_app'],true);
		$site['google_api'] = json_decode($site['google_api'],true);	
		$site['smtp'] = json_decode($site['smtp'],true);			
				
		return $site;
	}

	public function read_site_meta(){

		$read = $this->_Process_MYSQL->get_data_multiple($this->table_site, ['meta_open_graph','meta_schema','meta_twitter_card'], 'type')->result_array();      

		foreach ($read as $data) {
			$data['type'] = ($data['type'] == 'meta_schema') ? 'schema' : $data['type'];
			$data['type'] = ($data['type'] == 'meta_open_graph') ? 'open_graph' : $data['type'];
			$data['type'] = ($data['type'] == 'meta_twitter_card') ? 'twitter_card' : $data['type'];						

			$meta[$data['type']] = json_decode($data['data'],TRUE);
		}

		return $meta;
	}

}