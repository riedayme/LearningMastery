<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Blog_Widget extends CI_Model
{

	public $table_blog_template = 'tb_blog_template';
	public $table_blog_template_widget = 'tb_blog_template_widget';

	public function check_ads_content($id){
		return $this->_Process_MYSQL->get_data($this->table_blog_template_widget, array(
			'id_template' => $id, 
			'type' => 'ads-content',
		))->num_rows();
	}

	public function read_template(){
		return $this->_Process_MYSQL->get_data($this->table_blog_template, array('status' => 'Active'))->row()->id;
	}

	public function read_widget(){

		$id_template = $this->read_template();

		$read = $this->_Process_MYSQL->get_data_multiple($this->table_blog_template_widget, $id_template, 'id_template',false,['type','ASC'])->result_array();

		if ($read) {
			foreach ($read as $data_widget) {
				$widget[] = [
					'id' => $data_widget['id'],
					'name' => $data_widget['name'],
					'var' => $data_widget['var'],
					'type' => $data_widget['type'],
					'data' => json_decode($data_widget['data_json'],TRUE)
				];
			}
		}else {
			$widget = false;
		}

		return $widget;
	}

	public function data_post(){

		$post = $this->input->post();

		$data_post = [
			'id_template' => $post['id_template'],
			'name' => $post['name'],
			'var' => $post['var'],
			'type' => $post['type'],
		];

		return $data_post;
	}

	public function check_var($post){

		$data = array(
			'id_template' => $post['id_template'], 
			'var' => $post['var'],
		);

		if (!empty($this->input->post('id'))) {
			$data = array_merge($data,['id !=' => $this->input->post('id')]);
		}

		/**
		 * checking variable if exist return false
		 */
		$check_var = $this->_Process_MYSQL->get_data($this->table_blog_template_widget, $data)->num_rows();

		if ($check_var > 0) return 'duplicate';
	}

	public function process_create(){

		if ($this->check_var($this->data_post()) != 'duplicate') {
			return $this->_Process_MYSQL->insert_data($this->table_blog_template_widget,$this->data_post());
		}else {

			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'warning',
				'message_text' => 'Duplicate Var name, use other var name !',
			]);

			redirect($this->input->post('redirect'));	
		}		

	}

	public function data_update($id){
		return $this->_Process_MYSQL->get_data($this->table_blog_template_widget,['id' => $id])->row_array();
	}	

	public function process_update(){

		if ($this->check_var($this->data_post()) != 'duplicate') {
			return $this->_Process_MYSQL->update_data($this->table_blog_template_widget,$this->data_post(),['id' => $this->input->post('id')]);
		}else {

			$this->session->set_flashdata([
				'message' => true,
				'message_type' => 'warning',
				'message_text' => 'Duplicate Var name, use other var name !',
			]);

			redirect($this->input->post('redirect'));			
		}		
	}   	

	public function process_delete($id){
		return $this->_Process_MYSQL->delete_data($this->table_blog_template_widget, array('id' => $id));
	}

	public function process_update_widget(){
		$post = $this->input->post();

		foreach ($post as $key => $data) {

			/**
			 * type link
			 */
			if ($post[$key]['type'] == 'link') {

				unset($content);
				if (!empty($post[$key]['link']['text'])) {
					foreach ($post[$key]['link']['text'] as $key_link => $nouse) {
						$content[] = array(
							'text' => $post[$key]['link']['text'][$key_link],
							'url' => $post[$key]['link']['url'][$key_link],
						);
					}
				}else{
					$content = false;
				}

				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'title' => $post[$key]['title'],
						'content' => $content,
					]),				
				];
			}


			/**
			 * type ads
			 */
			if ($post[$key]['type'] == 'ads') {
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'content' => $post[$key]['script'],
					]),				
				];
			}

			/**
			 * type ads-content
			 */
			if ($post[$key]['type'] == 'ads-content') {
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'content' => $post[$key]['script'],
						'loop_ads' => $post[$key]['loop_ads'],
					]),				
				];
			}			

			/**
			 * type image
			 */
			if ($post[$key]['type'] == 'image') {
				$image = $this->process_image($post[$key]['id'],$post[$key]['image_old']);
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'content' => $image,
					]),				
				];
			}

			/**
			 * type text
			 */
			if ($post[$key]['type'] == 'text') {
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'title' => $post[$key]['title'],
						'content' => $post[$key]['content'],
					]),				
				];
			}

			/**
			 * type popular-post
			 */
			if ($post[$key]['type'] == 'popular-post') {
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'title' => $post[$key]['title'],						
						'max_result' => $post[$key]['max_result'],
					]),				
				];
			}	

			/**
			 * type category
			 */
			if ($post[$key]['type'] == 'category') {
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'title' => $post[$key]['title'],
						'id' => $post[$key]['id_category'],
					]),				
				];
			}	

			/**
			 * type tags
			 */
			if ($post[$key]['type'] == 'tags') {
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'title' => $post[$key]['title'],						
						'id' => $post[$key]['id_tags'],
					]),				
				];
			}

			/**
			 * type pages
			 */
			if ($post[$key]['type'] == 'pages') {
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'title' => $post[$key]['title'],						
						'id' => $post[$key]['id_pages'],
					]),				
				];
			}

			/**
			 * type featured-post
			 */
			if ($post[$key]['type'] == 'featured-post') {
				$post_data[] = [
					'id' => $post[$key]['id'],
					'data_json' => json_encode([
						'status' => $post[$key]['status'],
						'title' => $post[$key]['title'],						
						'id' => $post[$key]['id_post'],
					]),				
				];
			}													

		}

		return $this->_Process_MYSQL->update_data_multiple($this->table_blog_template_widget,$post_data,'id');
	}

	public function process_image($key,$image_old){

		if (!empty($_FILES[$key]['name']['image'])) {

			$_FILES['image'.$key]['name']= $_FILES[$key]['name']['image'];
			$_FILES['image'.$key]['type']= $_FILES[$key]['type']['image'];
			$_FILES['image'.$key]['tmp_name']= $_FILES[$key]['tmp_name']['image'];
			$_FILES['image'.$key]['error']= $_FILES[$key]['error']['image'];
			$_FILES['image'.$key]['size']= $_FILES[$key]['size']['image'];

			$upload_image = $this->_Process_Upload->Upload_File(
				'image', // config upload
				'storage/uploads/blog/', // dir upload
				'image'.$key, // file post data
				$image_old, // delete file
				false, // file name
				'thumbnail' //is image
			);

			if (!$upload_image) return false;

			$data_image = $upload_image['image'.$key];
		}else {
			$data_image = $image_old;
		}		

		return $data_image;
	}

}