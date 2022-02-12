<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Setting_Meta extends CI_Model
{

	public $table_site = 'tb_site';

	public function read_data(){
		$read = $this->_Process_MYSQL->get_data_multiple($this->table_site, ['meta_open_graph','meta_schema','meta_twitter_card'], 'type')->result_array();      

		foreach ($read as $data) {
			$data['type'] = ($data['type'] == 'meta_schema') ? 'schema' : $data['type'];
			$data['type'] = ($data['type'] == 'meta_open_graph') ? 'open_graph' : $data['type'];
			$data['type'] = ($data['type'] == 'meta_twitter_card') ? 'twitter_card' : $data['type'];						

			$meta[$data['type']] = json_decode($data['data'],TRUE);
		}

		return $meta;
	}

	public function process_schema($post){
		$schema_post = array(
			'person_name' => strip_tags($post['person_name']),
			'person_alternateName' => strip_tags($post['person_alternateName']),
			'person_gender' => strip_tags($post['person_gender']),
			'person_height' => strip_tags($post['person_height']),
			'person_birthDate' => strip_tags($post['person_birthDate']),
			'person_birthPlace' => strip_tags($post['person_birthPlace']),
			'person_nationality' => strip_tags($post['person_nationality']),
			'person_alumniOf' => strip_tags($post['person_alumniOf']),
			'person_memberOf' => strip_tags($post['person_memberOf']),
			'person_streetAddress' => strip_tags($post['person_streetAddress']),
			'person_addressLocality' => strip_tags($post['person_addressLocality']),
			'person_addressRegion' => strip_tags($post['person_addressRegion']),
			'person_postalCode' => strip_tags($post['person_postalCode']),
			'person_email' => strip_tags($post['person_email']),
			'person_telephone' => strip_tags($post['person_telephone']),
			'person_url' => strip_tags($post['person_url']),
			'person_sameAs' => strip_tags($post['person_sameAs']),
			'person_jobTitle' => strip_tags($post['person_jobTitle']),
			'person_worksFor_name' => strip_tags($post['person_worksFor_name']),
			'person_worksFor_sameAs' => strip_tags($post['person_worksFor_sameAs']),

			'organization_name' => strip_tags($post['organization_name']),
			'organization_url' => strip_tags($post['organization_url']),
			'organization_contactPoint_telephone' => strip_tags($post['organization_contactPoint_telephone']),
			'organization_contactPoint_contactType' => strip_tags($post['organization_contactPoint_contactType']),
			'organization_sameAs' => strip_tags($post['organization_sameAs']),
		);

		/**
		 * if new logo organization
		 */
		$logo_old = $post['organization_logo_url_old'];
		if (!empty($_FILES['organization_logo_url']['name'])) {


			$upload_logo = $this->_Process_Upload->Upload_File(
				'image', // config upload
				'storage/uploads/site/', // dir upload
				'organization_logo_url', // file post data
				$logo_old, // delete file
				false, // file name
				'thumbnail' //is image and set thumbnail
			);

			if (!$upload_logo) return false;

			$schema_post['organization_logo_url'] = $upload_logo['organization_logo_url'];
		}else {
			$schema_post['organization_logo_url'] = $logo_old;
		}

		/**
		 * if new person image
		 */
		$person_old = $post['person_image_old'];
		if (!empty($_FILES['person_image']['name'])) {


			$upload_person = $this->_Process_Upload->Upload_File(
				'image', // config upload
				'storage/uploads/site/', // dir upload
				'person_image', // file post data
				$person_old, // delete file
				false, // file name
				'thumbnail' //is image and set thumbnail
			);

			if (!$upload_person) return false;

			$schema_post['person_image'] = $upload_person['person_image'];
		}else {
			$schema_post['person_image'] = $person_old;
		}		

		$all_data = [
			'type' => strip_tags($post['schema']),
			'content' => $schema_post,
		];

		$data[] = [
			'type' => 'meta_schema',
			'data' => json_encode($all_data),
		];

		return $data;		
	}

	public function process_open_graph($post){

		$open_graph_post = array(
			'app_id' => strip_tags($post['open_graph_app_id']),
			'publisher' => strip_tags($post['open_graph_publisher']),
			'author' => strip_tags($post['open_graph_author']),
		);     		

		/**
		 * if new open graph default image
		 */
		$image_old = $post['open_graph_default_image_old'];
		if (!empty($_FILES['open_graph_default_image']['name'])) {

			$upload_logo = $this->_Process_Upload->Upload_File(
				'image', // config upload
				'storage/uploads/site/', // dir upload
				'open_graph_default_image', // file post data
				$image_old, // delete file
				false, // file name
				'thumbnail' //is image and set thumbnail
			);

			if (!$upload_logo) return false;

			$open_graph_post['default_image'] = $upload_logo['open_graph_default_image'];
		}else {
			$open_graph_post['default_image'] = $image_old;
		}		

		$data[] = [
			'type' => 'meta_open_graph',
			'data' => json_encode($open_graph_post,TRUE),
		];

		return $data;
	}

	public function process_twitter_card($post){

		$twitter_card_post = array(
			'publisher' => strip_tags($post['twitter_card_publisher']),
		);     		

		/**
		 * if new open graph default image
		 */
		$image_old = $post['twitter_card_default_image_old'];
		if (!empty($_FILES['twitter_card_default_image']['name'])) {

			$upload_logo = $this->_Process_Upload->Upload_File(
				'image', // config upload
				'storage/uploads/site/', // dir upload
				'twitter_card_default_image', // file post data
				$image_old, // delete file
				false, // file name
				'thumbnail' //is image and set thumbnail
			);

			if (!$upload_logo) return false;

			$twitter_card_post['default_image'] = $upload_logo['twitter_card_default_image'];
		}else {
			$twitter_card_post['default_image'] = $image_old;
		}		

		$data[] = [
			'type' => 'meta_twitter_card',
			'data' => json_encode($twitter_card_post,TRUE),
		];

		return $data;
	}

	public function process_update(){

		$post = $this->input->post();

		/**
		 * schema data
		 */
		$schema = $this->process_schema($post);
		if (!$schema) return false;

		/**
		 * open graph data
		 */
		$open_graph = $this->process_open_graph($post);
		if (!$open_graph) return false;

		/**
		 * twitter card data
		 */
		$twitter_card = $this->process_twitter_card($post);	
		if (!$twitter_card) return false;			

		$data = array_merge($schema,$open_graph,$twitter_card);

		return $this->_Process_MYSQL->update_data_multiple($this->table_site,$data,'type');
	}
}