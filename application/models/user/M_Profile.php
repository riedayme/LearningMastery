<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Profile extends CI_Model
{

	public $table_user = 'tb_user';

	public function read(){
		return $this->_Process_MYSQL->get_data($this->table_user, ['id' => $this->session->userdata('id_user')])->row_array();
	}

	public function process(){

		$post = $this->input->post();

		$post_data = [
		'username' => strip_tags($post['full_name']),
		'no_handphone' => strip_tags($post['no_handphone']),
		];

		/**
		 * if new image
		 */
		if (!empty($_FILES['photo']['name'])) {

			$image_old = $post['photo_old'];

			$upload_photo = $this->_Process_Upload->Upload_File(
				'image', // config upload
				'storage/uploads/user/photo/', // dir upload
				'photo', // file post data
				$image_old, // delete file
				'user_photo', // file name
				'resize' //is image for resizing image or create thumb
				);

			if ($upload_photo['photo']) {
				$post_data['photo'] =  $upload_photo['photo'];
				$this->session->set_userdata(array('photo' => $post_data['photo']));
			}
		}

		$post_data['password'] = sha1($post['new_password']);

		if ($this->_Process_MYSQL->update_data($this->table_user,$post_data,['id' => $this->session->userdata('id_user')])) {

			return 'success';
		}
	}	

	public function set_validation_register(){

		$this->form_validation->set_rules([
			[
			'field' => 'full_name',
			'label' => 'lang:full_name',
			'rules' => 'trim|required|min_length[5]|max_length[100]|alpha',
			'errors' => [
			'required' => '{field} '.$this->lang->line('must_filled'),
			]
			],
			[
			'field' => 'no_handphone',
			'label' => 'lang:no_handphone',
			'rules' => 'trim|required|numeric|min_length[10]|max_length[20]',
			'errors' => [
			'required' => '{field} '.$this->lang->line('must_filled')
			]
			]
			]);

		/**
		 * if new password
		 */
		if (!empty($this->input->post('new_password')) OR !empty($this->input->post('password_confirm')) OR !empty($this->input->post('old_password'))) 
		{
			$this->form_validation->set_rules([
				[
				'field' => 'old_password',
				'label' => 'lang:old_password',
				'rules' => [
				'trim',
				'required',
				'min_length[5]',
				[
				'password_checker',
				function($old_password){

					$read = $this->_Process_MYSQL->get_data($this->table_user,['password' => md5($old_password)]);

					if ($read->num_rows() > 0) {

						return true;

					}else {

						$this->form_validation->set_message('password_checker', '{field} '.$this->lang->line('not_valid'));

						return false;
					}
				}
				]
				],
				'errors' => [
				'required' => '{field} '.$this->lang->line('must_filled')
				]
				],
				[
				'field' => 'new_password',
				'label' => 'lang:new_password',
				'rules' => 'trim|required|min_length[5]',
				'errors' => [
				'required' => '{field} '.$this->lang->line('must_filled')
				]
				],
				[
				'field' => 'password_confirm',
				'label' => 'lang:password_confirm',
				'rules' => 'trim|required|min_length[5]|matches[new_password]',
				'errors' => [
				'required' => '{field} '.$this->lang->line('must_filled'),
				'matches' => '{field} '.$this->lang->line('not_same')
				]
				]
				]);	
		}	

		$this->form_validation->set_message('min_length', '{field} '.$this->lang->line('min_length_start').' {param} '.$this->lang->line('min_length_end'));
		$this->form_validation->set_message('max_length', '{field} '.$this->lang->line('max_length_start').' {param} '.$this->lang->line('max_length_end'));
		$this->form_validation->set_message('numeric', '{field} '.$this->lang->line('must_number'));
		$this->form_validation->set_message('alpha', '{field} '.$this->lang->line('must_alphabet'));		
	}  	

}