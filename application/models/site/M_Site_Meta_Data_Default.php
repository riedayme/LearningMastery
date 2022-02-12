<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Site_Meta_Data_Default extends CI_Model
{
	public function generate($site){
		return "
		<meta charset='UTF-8' />
		<meta content='width=device-width, initial-scale=1' name='viewport' />
		<title>".$site['title']."</title>

		<!-- Browser data -->
		<link rel='canonical' href='".base_url(uri_string())."'>
		<meta name='description' content='".trim($site['description'])."'>
		<meta name='keywords' content='".$site['title']."'>

		<!-- Schema.org markup for Google -->
		<meta itemprop='name' content='".$site['title']."'>
		<meta itemprop='description' content='".trim($site['description'])."'>
		<meta itemprop='image' content='".$site['image']."'>

		<!-- Image locations -->
		<link rel='apple-touch-icon' sizes='120x120'
		href='".base_url('storage/uploads/site/'.$site['icon'])."' />
		<link rel='apple-touch-icon' sizes='152x152'
		href='".base_url('storage/uploads/site/'.$site['icon'])."' />
		<link rel='icon' href='".base_url('storage/uploads/site/'.$site['icon'])."'
		type='image/x-icon' />
		<link rel='shortcut icon' href='".base_url('storage/uploads/site/'.$site['icon'])."'
		type='image/x-icon' />

		<!-- feed -->
		<link rel='alternate' type='application/rss+xml' title='RSS Feed Courses' href='".base_url('feeds/courses')."' />
		<link rel='alternate' type='application/rss+xml' title='RSS Feed Blog' href='".base_url('feeds/blog_post')."' />		
		";
	}

}