<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_User extends CI_Model
{

    public $table_user = 'tb_user';  

    public $table_lms_user_courses = 'tb_lms_user_courses';
    public $table_lms_user_lesson = 'tb_lms_user_lesson';
    public $table_lms_user_payment = 'tb_lms_user_payment';
    public $table_lms_user_review = 'tb_lms_user_review';      
    public $table_lms_user_wishlist = 'tb_lms_user_wishlist';  

    public function datatables(){

        return [
        'datatable' => true,
        'datatables_data' => "
        [{'data': 'checkbox',className:'c-table__cell u-pl-small'},
        {'data': 'id',className:'c-table__cell'},
        {'data': 'username',className:'c-table__cell',width:'100%'},         
        {'data': 'no_handphone',className:'c-table__cell'},            
        {'data': 'status',className:'c-table__cell'},
        {'data': 'created',className:'c-table__cell'},            
        {'data': 'last_login',className:'c-table__cell'},
        {'data': 'view',className:'c-table__cell'},            
        {'data': 'alat',className:'c-table__cell'}
        ]
        ",
        ];        
    }    

    public function data_table(){

        header('Content-Type: application/json');        

        $this->datatables->select('
            id,
            photo,
            username,
            email,
            no_handphone,
            grade,
            DATE_FORMAT(created, "%d %M %Y %H:%i %p") as created,
            DATE_FORMAT(last_login, "%d %M %Y %H:%i %p") as last_login,
            status
            ');
        $this->datatables->from($this->table_user);
        $this->datatables->add_column('checkbox', '
            <td>
                <div class="c-choice c-choice--checkbox">
                    <input type="checkbox" id="checkbox-$1" class="c-choice__input" name="id[]" value="$1">
                    <label for="checkbox-$1" class="c-choice__label">&nbsp;</label>
                </div>
            </td>
            ', 'id');

        $this->datatables->edit_column('username', '
            <div class="o-media">
                <div class="o-media__img u-mr-xsmall">
                    <div class="c-avatar c-avatar--xsmall">
                        $1
                    </div>
                </div>
                <div class="o-media__body">
                    $2
                    $4
                    <small class="u-block u-text-mute">
                        $3
                    </small>
                </div>
            </div>
            ', 'photo_user(photo),username,email,grade_user(grade)');

        $this->datatables->add_column('alat', '
            <a class="c-btn--custom c-btn--small c-btn c-btn--info" href="'.base_url('app/user/').'update/$1"><i class="fa fa-edit"></i></a>
            <button data-title="are you sure ?" data-text="want to delete $2" class="c-btn--custom c-btn--small c-btn c-btn--danger action-delete" data-id="$1" data-href="'. base_url('app/user/delete/$1') .'" type="button"><i class="fa fa-trash"></i></button>
            ', 'id,username');   

        $this->datatables->add_column('view', '
            <button type="button" class="c-btn--custom c-btn--small c-btn c-btn--primary" name="action-view"><i class="fa fa-eye"></i></button>
            ', 'id'); 

        return $this->datatables->generate();
    } 

    public function data_post(){

        $post_data = array(
            'username' => strip_tags($this->input->post('username')),
            'email' => strip_tags($this->input->post('email')),
            'no_handphone' => strip_tags($this->input->post('no_handphone')),
            'headline' => strip_tags($this->input->post('headline')),     
            'grade' => strip_tags($this->input->post('grade')),                 
            'status' => strip_tags($this->input->post('status')),     
            );

        if (!empty($this->input->post('new_password'))) {
            $post_data['password'] = sha1($this->input->post('new_password'));
        }

        if (empty($this->input->post('id'))) {
            $post_data['created'] = date('Y-m-d H:i:s');
        }

        if (!empty($this->input->post('id'))) {
            $read = $this->data_update($this->input->post('id'));

            if ($read['grade'] == 'App') {
                unset($post_data['grade']);                 
                unset($post_data['status']); 
            }
        }

        /**
         * if new image
         */
        if (!empty($_FILES['photo']['name'])) {

            $image_old = $this->input->post('photo_old');

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
                if ($read['grade'] == 'App') {
                    $this->session->set_userdata(array('app_photo' => $post_data['photo']));
                }
            }
        }    

        /**
         * Unset if user_setting
         */
        if ($this->session->userdata('app_grade') == 'Instructor') {
            unset($post_data['email']);
            unset($post_data['grade']);             
            unset($post_data['status']);            
        }

        return $post_data;
    }  

    public function data_update($id){
        return $this->_Process_MYSQL->get_data($this->table_user,['id' => $id])->row_array();
    }

    public function process_create(){
        return $this->_Process_MYSQL->insert_data($this->table_user,$this->data_post());
    }

    public function process_update(){

        // echo json_encode($this->data_post());
        // exit;
        return $this->_Process_MYSQL->update_data($this->table_user,$this->data_post(),['id' => $this->input->post('id')]);
    }   

    public function process_delete($id){

        $read = $this->data_update($id);

        if ($read['grade'] == 'App') return false;

        if ($this->_Process_MYSQL->delete_data($this->table_user, array('id' => $id))) {

            $this->_Process_MYSQL->delete_data($this->table_lms_user_courses, array('id_user' => $id));
            $this->_Process_MYSQL->delete_data($this->table_lms_user_lesson, array('id_user' => $id));
            $this->_Process_MYSQL->delete_data($this->table_lms_user_payment, array('id_user' => $id));
            $this->_Process_MYSQL->delete_data($this->table_lms_user_review, array('id_user' => $id));
            $this->_Process_MYSQL->delete_data($this->table_lms_user_wishlist, array('id_user' => $id));

            unlink('storage/uploads/user/photo/'.$read['photo']);

            return true;
        }
    }

    public function process_multiple_update($id,$action){

        $read = $this->_Process_MYSQL->get_data_multiple($this->table_user,$id,'id')->result_array();

        foreach ($read as $data) {
            if ($data['grade'] != 'App') {
                $data_filter[] = [
                'id' => $data['id'],
                'status' => $action,
                ]; 
            }
        }

        if (empty($data_filter)) return false;

        return $this->_Process_MYSQL->update_data_multiple($this->table_user, $data_filter, 'id');
    }

    public function process_multiple_delete($id){

        $read = $this->_Process_MYSQL->get_data_multiple($this->table_user,$id,'id')->result_array();

        foreach ($read as $data) {
            if ($data['grade'] != 'App') {
                $id_filter[] = $data['id']; 
                $photos[] = $data['photo'];
            }
        }

        if (empty($id_filter)) return false;

        if ($this->_Process_MYSQL->delete_data_multiple($this->table_user, $id_filter, 'id')) {

            $this->_Process_MYSQL->delete_data_multiple($this->table_lms_user_courses, $id, 'id_user');
            $this->_Process_MYSQL->delete_data_multiple($this->table_lms_user_lesson, $id, 'id_user');
            $this->_Process_MYSQL->delete_data_multiple($this->table_lms_user_payment, $id, 'id_user');
            $this->_Process_MYSQL->delete_data_multiple($this->table_lms_user_review, $id, 'id_user');
            $this->_Process_MYSQL->delete_data_multiple($this->table_lms_user_wishlist, $id, 'id_user');

            foreach ($photos as $photo) {
                unlink('storage/uploads/user/photo/'.$photo);
            }

            return true;
        }
    }      

    public function set_validation(){
        $this->form_validation->set_rules([
            [
            'field' => 'username',
            'label' => 'lang:username',
            'rules' => 'trim|required|min_length[5]|max_length[100]|alpha',
            'errors' => [
            'required' => '{field} '.$this->lang->line('must_filled'),
            ]
            ],
            [
            'field' => 'email',
            'label' => 'lang:email',
            'rules' => [
            'trim',
            'required',
            'valid_email',
            [
            'email_checker',
            function($email){

                $read = $this->_Process_MYSQL->get_data($this->table_user,['email' => $email, 'id !=' => $this->input->post('id')]);

                if ($read->num_rows() > 0) {

                    $this->form_validation->set_message('email_checker', $this->lang->line('email_exist'));

                    return false;

                }else {

                    return true;
                }
            }
            ]
            ],
            'errors' => [
            'required' => '{field} '.$this->lang->line('must_filled')
            ]
            ],
            [
            'field' => 'no_handphone',
            'label' => 'lang:no_handphone',
            'rules' => 'trim|required|numeric|min_length[10]|max_length[20]',
            'errors' => [
            'required' => '{field} '.$this->lang->line('must_filled')
            ]
            ],
            [
            'field' => 'new_password',
            'label' => 'lang:password',
            'rules' => 'trim|min_length[5]'.(empty($this->input->post('id')) ? '|required' : ''),
            'errors' => [
            'required' => '{field} '.$this->lang->line('must_filled')
            ]
            ]
            ]);

        $this->form_validation->set_message('min_length', '{field} '.$this->lang->line('min_length_start').' {param} '.$this->lang->line('min_length_end'));
        $this->form_validation->set_message('max_length', '{field} '.$this->lang->line('max_length_start').' {param} '.$this->lang->line('max_length_end'));
        $this->form_validation->set_message('numeric', '{field} '.$this->lang->line('must_number'));        
        $this->form_validation->set_message('alpha', '{field} '.$this->lang->line('must_alphabet'));        
    }  

}
