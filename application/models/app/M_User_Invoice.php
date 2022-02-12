<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_User_Invoice extends CI_Model
{

    public $table_user = 'tb_user';  

    public $table_lms_courses = 'tb_lms_courses';

    public $table_lms_user_courses = 'tb_lms_user_courses';
    public $table_lms_user_payment = 'tb_lms_user_payment';

    public function datatables(){

        return [
        'datatable' => true,
        'datatables_data' => "
        [
        {'data': 'checkbox',className:'c-table__cell u-pl-small'},
        {'data': 'id',className:'c-table__cell'},
        {'data': 'username',className:'c-table__cell',width:'100%'},         
        {'data': 'transaction',className:'c-table__cell'},                    
        {'data': 'amount',className:'c-table__cell'},            
        {'data': 'created',className:'c-table__cell'},
        {'data': 'alat',className:'c-table__cell'}
        ]
        ",
        ];        
    }    

    public function data_table(){

        $this->load->model('_Currency');

        header('Content-Type: application/json');        

        $this->datatables->select('
            tb_user.username as username,

            tb_lms_courses.title as product_name,

            tb_lms_user_payment.id,
            tb_lms_user_payment.amount,
            tb_lms_user_payment.token as transaction,            
            DATE_FORMAT(tb_lms_user_payment.time, "%d %M %Y %H:%i %p") as created
            ');
        $this->datatables->from($this->table_lms_user_payment);
        $this->datatables->join($this->table_user, 'tb_lms_user_payment.id_user = tb_user.id', 'LEFT');
        $this->datatables->join($this->table_lms_courses, 'tb_lms_user_payment.id_courses = tb_lms_courses.id', 'LEFT');  
        if ($this->session->userdata('app_grade') == 'Instructor') {
            $this->datatables->where('tb_lms_user_payment.id_courses_user', $this->session->userdata('id'));
        }    
        $this->datatables->where('tb_lms_user_payment.status', 'Checking');

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
                <div class="o-media__body">
                    $1
                    <small class="u-block u-text-mute">
                        Buy : $2
                    </small>
                </div>
            </div>
            ', 'username,product_name');

        $this->datatables->edit_column('amount', '$1', 'set_currency(amount)');  

        $this->datatables->add_column('alat', '
            <button class="c-btn--custom c-btn--small c-btn c-btn--info action-confirmation" data-id="$1" data-action="'. base_url('app/user_invoice/read') .'" type="button" data-toggle="modal" data-target="#modal"><i class="fa fa-check"></i></button>
            ', 'id');   

        return $this->datatables->generate();
    } 

    public function read(){

        $id = $this->input->post('id');

        $read = $this->db
        ->select('
            tb_user.username as username,
            tb_lms_courses.title as product_name,
            tb_lms_user_payment.*
            ')
        ->from($this->table_lms_user_payment)
        ->join($this->table_user, 'tb_lms_user_payment.id_user = tb_user.id', 'LEFT')
        ->join($this->table_lms_courses, 'tb_lms_user_payment.id_courses = tb_lms_courses.id', 'LEFT')
        ->where('tb_lms_user_payment.id',$id)
        ->get()
        ->row_array();

        $read['proof'] = json_decode($read['proof'],true);
        $read['proof'] = [
        'sender' => $read['proof']['sender'],
        'file' => base_Url('storage/uploads/user/confirmation/'.$read['proof']['file']),
        ];

        $this->load->model('_Currency');
        $read['amount'] = $this->_Currency->set_currency($read['amount']);

        return $read;
    }

    public function process(){

        $post = $this->input->post();


        if ($post['action'] == 'approve') {
            if ($this->_Process_MYSQL->update_data($this->table_lms_user_payment,['updated' => date('Y-m-d H:i:s') ,'status' => 'Purchased'],['id' => $post['id']])) {

                $this->load->model('user/M_Payment');

                if ($this->M_Payment->insert_purchased_courses($post['id'])) {
                    return 'approve';
                }

            }
        }else {
            
            /**
             * Delete Confirmation File
             */
            $read = $this->_Process_MYSQL->get_data($this->table_lms_user_payment,['id' => $post['id']])->row_array();
            $read['proof'] = json_decode($read['proof'],true);
            $file = $read['proof']['file'];
            @unlink('storage/uploads/user/confirmation/'.$file);
            
            if ($this->_Process_MYSQL->update_data($this->table_lms_user_payment,['updated' => date('Y-m-d H:i:s') ,'status' => 'Failed'],['id' => $post['id']])) {
                return 'disapproved';
            }
        }

    }

}
