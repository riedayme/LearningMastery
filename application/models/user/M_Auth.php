<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Auth extends CI_Model
{

    public $table_user = 'tb_user';
    public $table_jobs = 'tb_jobs';

    public function data_post(){

        $full_name = strip_tags($this->input->post('full_name'));
        $password = strip_tags($this->input->post('password'));
        $password_confirm = strip_tags($this->input->post('password_confirm'));
        $email = strip_tags($this->input->post('email'));
        $no_handphone = strip_tags($this->input->post('no_handphone'));        
        $csrf_code = $this->input->post('csrf_code');

        return [
        'full_name' => $full_name,
        'password' => $password,
        'password_confirm' => $password_confirm,
        'email' => $email,
        'no_handphone' => $no_handphone,
        'csrf_code' => $csrf_code,
        ];
    }

    public function login(){

        $post_data = $this->data_post();

        if ($post_data['csrf_code'] != '' AND $this->session->userdata('csrf_code') == $post_data['csrf_code']) {

            $data = array(
                'email' => $post_data['email'],
                'password' => sha1($post_data['password']),
                'status' => 'Active'
                );

            $read = $this->_Process_MYSQL->get_data($this->table_user,$data);

            if ($read->num_rows() > 0) {

                $read_data = $read->row_array();
                $id = $read_data['id'];

                $data_update = array(
                    'last_login' => date('Y:m:d H:i:s'),
                    );

                if ($this->_Process_MYSQL->update_data($this->table_user, $data_update, array('id' => $id)) == TRUE) {

                    $this->session->unset_userdata('csrf_code');

                    if ($read_data['grade'] == 'User') {
                        $this->session->set_userdata(array(
                            'id_user' => $read_data['id'],                        
                            'username' => $read_data['username'],
                            'photo' => $read_data['photo'],
                            'grade' => $read_data['grade'],                        
                            'user' => "login"
                            ));

                        return 'success_user';
                    }elseif ($read_data['grade'] == 'App' OR $read_data['grade'] == 'Instructor') {

                        $this->session->set_userdata(array(
                            'id' => $read_data['id'],                        
                            'app_username' => $read_data['username'],
                            'app_photo' => $read_data['photo'],
                            'app_grade' => $read_data['grade'],                        
                            'status' => "login",
                            'key' => sha1($read_data['id'].$read_data['username'].date('YmdHis'))
                            ));

                        if ($read_data['grade'] == 'App') {
                            return 'success_app';
                        }else{                            
                            return 'success_instructor';
                        }
                    }else{
                        return 'not_exist';
                    }

                }

            }else {

                return 'not_exist';
            }

        }else {

            return 'invalid';
        }
    }    

    public function register(){

        $post_data = $this->data_post();        

        if ($post_data['csrf_code'] != '' AND $this->session->userdata('csrf_code') == $post_data['csrf_code']) {

            $email_vertification = $this->site['vertification_email'];

            $data = array(
                'username' => $post_data['full_name'],
                'password' => sha1($post_data['password']),  
                'email' => $post_data['email'],                      
                'no_handphone' => $post_data['no_handphone'],
                'grade' => 'User',
                'created' => date('Y:m:d H:i:s'),
                'status' => ($email_vertification == 'Yes') ? 'UnActive' : 'Active',
                );

            $subject =  $this->lang->line('email_vertification_message_subject'); 
            $verify_url = base_url('auth/confirm/'.md5($post_data['email']));
            $message = $this->lang->line('email_vertification_message_head').'
            <br/><br/>
            '.$this->lang->line('email_vertification_message_body').'
            <br/><br/>
            <a href=\''.$verify_url.'\'>'. $verify_url .'</a>
            <br/><br/>
            ';

            $data_jobs = [
            'name' => 'sendEmail',
            'payload' => json_encode([
                'to' => $post_data['email'],
                'subject' => $subject,
                'message' => $message,
                ]),
            'created' => date('Y:m:d H:i:s')
            ];

            if ($email_vertification == 'Yes') {
                if ($this->_Process_MYSQL->insert_data($this->table_jobs,$data_jobs)) {
                    if ($this->_Process_MYSQL->insert_data($this->table_user,$data)) {
                        return 'success';
                    }
                }
            }else{
                if ($this->_Process_MYSQL->insert_data($this->table_user,$data)) {
                    return 'success';
                }
            }

            return 'invalid';            
        }else {

            return 'invalid';
        }        
    }

    public function LoginSocialMedia($data){

        $read = $this->_Process_MYSQL->get_data($this->table_user,$data);       

        if ($read->num_rows() > 0) {

            $read_data = $read->row_array();

            if ($read_data['status'] == 'Blocked') {    
                return 'user_blocked';
            }

            $this->session->set_userdata(array(
                'id_user' => $read_data['id'],                        
                'username' => $read_data['username'],
                'photo' => $read_data['photo'],
                'grade' => $read_data['grade'],                        
                'user' => "login"
                ));

            return 'success';
        }else{
            return false;
        }
    }    

    public function RegisterSocialMedia($data){
        $process = $this->_Process_MYSQL->insert_data($this->table_user,$data,true);

        if ($process) {
            $this->session->set_userdata(array(
                'id_user' => $process,                        
                'username' => $data['username'],
                'photo' => $data['photo'],
                'grade' => $data['grade'],                        
                'user' => "login"
                ));

            return true;
        }
    }

    public function googlecaptcha($site){

        if (empty($this->input->post())) return false;

        if ($site['google_recaptcha']['status'] == 'Yes') {
            $secret= $site['google_recaptcha']['secret_key'];

            $credential = array(
                'secret' => $secret,
                'response' => $this->input->post('g-recaptcha-response')
                );

            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
            curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($verify);

            $status= json_decode($response, true);

            return $status['success'];
        }else {

            return true;
        }
    } 

    public function verifyEmail($code){

        $data = array(
            'md5(email)' => $code,
            'status' => 'UnActive'
            );

        $read = $this->_Process_MYSQL->get_data($this->table_user,$data);

        if ($read->num_rows() > 0) {
            $data = array('status' => 'Active');
            return $this->_Process_MYSQL->update_data($this->table_user, $data, array('md5(email)' => $code));
        }
        
    }

    function logout(){

        $this->session->unset_userdata(['id','app_username','app_photo','app_grade','status','key']);
        $this->session->unset_userdata(['id_user','username','photo','grade','user']);

        return 'success';
    }

    function check($type,$data,$redirect){
        if ($type == 'exist') {
            if ($this->session->userdata($data)) {
                redirect(base_url($redirect));
            }
        }elseif ($type == 'not_exist') {
            if (empty($this->session->userdata($data))) {
                redirect(base_url($redirect));
            }
        }
    }    

    public function check_user(){
        $data = array(
            'id' => $this->session->userdata('id_user')
            );

        $read = $this->_Process_MYSQL->get_data($this->table_user,$data);

        if ($read->num_rows() < 1 OR $read->row()->status == 'Blocked') {
            redirect(base_url('auth/process_logout'));
        }
    }

    /**
     * Validation register
     */
    
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
            'field' => 'email',
            'label' => 'lang:email',
            'rules' => [
            'trim',
            'required',
            'valid_email',
            [
            'email_checker',
            function($email){

                /**
                 * https://www.daniweb.com/programming/web-development/threads/471144/allow-only-specific-domain-for-email
                 * allow only specific domain for email
                 */
                $blocked = array(
                    '@coalamails.com',
                    '@iopmail.com',
                    '@oriwijn.com'
                    );

                if(preg_match('/@(?!.*@).*+/', $email, $matches) == 1)
                {
                    if (in_array($matches[0], $blocked)) {
                        $this->form_validation->set_message('email_checker', $this->lang->line('email_not_accept'));

                        return false;
                    }
                }

                $read = $this->_Process_MYSQL->get_data($this->table_user,['email' => $email]);

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
            'field' => 'password',
            'label' => 'lang:password',
            'rules' => 'trim|required|min_length[5]',
            'errors' => [
            'required' => '{field} '.$this->lang->line('must_filled')
            ]
            ],
            [
            'field' => 'password_confirm',
            'label' => 'lang:password_confirm',
            'rules' => 'trim|required|min_length[5]|matches[password]',
            'errors' => [
            'required' => '{field} '.$this->lang->line('must_filled'),
            'matches' => '{field} '.$this->lang->line('not_same')
            ]
            ],
            ]);

        $this->form_validation->set_message('min_length', '{field} '.$this->lang->line('min_length_start').' {param} '.$this->lang->line('min_length_end'));
        $this->form_validation->set_message('max_length', '{field} '.$this->lang->line('max_length_start').' {param} '.$this->lang->line('max_length_end'));
        $this->form_validation->set_message('numeric', '{field} '.$this->lang->line('must_number'));
        $this->form_validation->set_message('alpha', '{field} '.$this->lang->line('must_alphabet'));            
    }    

}
