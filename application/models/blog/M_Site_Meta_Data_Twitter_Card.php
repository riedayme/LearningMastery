<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Data_Twitter_Card extends CI_Model
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('site/M_Site_Meta_Data_Twitter_Card_Init');
	}

	public function index($data){

		$data['image'] = $this->M_Site_Meta_Data_Twitter_Card_Init->get_image($data['twitter_card']);

		return '
		<meta name="twitter:site" content="'.$data['twitter_card']['publisher'].'">
		<meta name="twitter:title" content="'.$data['title'].'">
		<meta name="twitter:description" content="'.trim($data['description']).'">
		<meta name="twitter:url" content="'.base_url(uri_string()).'">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:image:src" content="'.$data['image'].'">';
	}

	public function detail($data){

		$data['image'] = $this->M_Site_Meta_Data_Twitter_Card_Init->get_image($data['twitter_card'],$data['image']);

		return '
		<meta name="twitter:site" content="'.$data['twitter_card']['publisher'].'">
		<meta name="twitter:title" content="'.$data['title'].'">
		<meta name="twitter:description" content="'.trim($data['description']).'">
		<meta name="twitter:url" content="'.base_url(uri_string()).'">
		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:image:src" content="'.$data['image'].'">';
	}

}