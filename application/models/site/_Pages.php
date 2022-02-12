<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class _Pages extends CI_Model
{

	public function read($site,$post){

		/**
		 * Edit Permalink
		 */
		$post['permalink'] = base_url('p/' . $post['permalink']);

		/**
		 * Edit Time & Updated
		 */
		$post['time_original'] = $post['time'];
		$post['time'] = $this->_Date->set($post['time'],'d F Y H:i A');

		$post['updated_original'] = $post['updated'];
		$post['updated'] = $this->_Date->set($post['updated'],'d F Y H:i A');		

		/**
		 * Cut Content
		 */
		$post['content'] = html_entity_decode($post['content']);

		$extract = array(
			'id' =>$post['id'],
			'title' =>$post['title'],
			'url' =>$post['permalink'],
			'time' =>$post['time'],
			'time_original' =>$post['time_original'],
			'updated' =>$post['updated'],
			'updated_original' =>$post['updated_original'],
			'content' =>$post['content'],
			'status' =>$post['status']					
		);

		return $extract;				
	}

}