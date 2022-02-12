<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Data_OG extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('site/M_Site_Meta_Data_OG_Init');
	}	

	public function index($data){

		$app_id = false;
		if ($data['open_graph']['app_id']) {
			$app_id = '<meta property="fb:app_id" content="'.$data['open_graph']['app_id'].'" />';
		}

		$data['image'] = $this->M_Site_Meta_Data_OG_Init->get_image($data['open_graph']);

		return '    
		<!-- Open Graph data --> 
		<meta property="og:title" content="'.$data['title'].'">
		<meta property="og:type" content="website">
		<meta property="og:url" content="'.base_url(uri_string()).'">
		<meta property="og:image" content="'.$data['image']['url'].'">
		<meta property="og:image:width" content="'.$data['image']['width'].'" />
		<meta property="og:image:height" content="'.$data['image']['height'].'" />
		<meta property="og:description" content="'.trim($data['description']).'">
		<meta property="og:site_name" content="'.$data['title'].'" />
		'.$app_id.'';
	}
	
	public function detail($data){

		$app_id = false;
		if ($data['open_graph']['app_id']) {
			$app_id = '<meta property="fb:app_id" content="'.$data['open_graph']['app_id'].'" />';
		}

		$data['image'] = $this->M_Site_Meta_Data_OG_Init->get_image($data['open_graph'],$data['image']);

		$modified_time = false;
		if ($data['updated'] != '0000-00-00 00:00:00') {
			$modified_time = '<meta property="article:modified_time" content="'.$data['updated'].'">';
		}

		$data_tags = false;
		if ($data['tags']) {
			foreach ($data['tags'] as $tag) {
				$data_tags[] = '<meta property="article:tag" content="'.$tag['name'].'">'.PHP_EOL;
			}
			$data_tags = implode('', $data_tags);
		}

		return '
		<!-- Open Graph data --> 
		<meta property="og:title" content="'.$data['title'].'">
		<meta property="og:type" content="article">
		<meta property="og:url" content="'.base_url(uri_string()).'">
		<meta property="og:image" content="'.$data['image']['url'].'">
		<meta property="og:image:width" content="'.$data['image']['width'].'" />
		<meta property="og:image:height" content="'.$data['image']['height'].'" />
		<meta property="og:description" content="'.trim($data['description']).'">
		<meta property="og:site_name" content="'.$data['site_name'].'" />
		<meta property="article:published_time" content="'.$data['published'].'">
		'.$modified_time.'
		<meta property="article:publisher" content="'.$data['open_graph']['publisher'].'" />
		<meta property="article:author" content="'.$data['open_graph']['author'].'" />
		'.$data_tags.'
		'.$app_id.'';
	}

}