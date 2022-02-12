<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_User_Invoice_History extends CI_Model
{

    public $table_user = 'tb_user';  

    public $table_lms_courses = 'tb_lms_courses';

    public $table_lms_user_courses = 'tb_lms_user_courses';
    public $table_lms_user_payment = 'tb_lms_user_payment';

    public function datatables(){

        return [
        'datatable' => true,
        'datatables_data' => "
        [{'data': 'checkbox',className:'c-table__cell u-pl-small'},
        {'data': 'id',className:'c-table__cell'},
        {'data': 'username',className:'c-table__cell',width:'100%'},         
        {'data': 'transaction',className:'c-table__cell'},                    
        {'data': 'amount',className:'c-table__cell'},            
        {'data': 'time',className:'c-table__cell'}
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
            DATE_FORMAT(tb_lms_user_payment.time, "%d %M %Y %H:%i %p") as time
            ');
        $this->datatables->from($this->table_lms_user_payment);
        $this->datatables->join($this->table_user, 'tb_lms_user_payment.id_user = tb_user.id', 'LEFT');
        $this->datatables->join($this->table_lms_courses, 'tb_lms_user_payment.id_courses = tb_lms_courses.id', 'LEFT');  
        if ($this->session->userdata('app_grade') == 'Instructor') {
            $this->datatables->where('tb_lms_user_payment.id_courses_user', $this->session->userdata('id'));
        }    
        $this->datatables->where('tb_lms_user_payment.status', 'Purchased');

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

        return $this->datatables->generate();
    } 

    public function statistic(){
        /**
         * total amount 
         */
        $this->db->select("sum(amount) as data");
        $this->db->from($this->table_lms_user_payment);
        if ($this->session->userdata('app_grade') == 'Instructor') {
            $this->db->where('id_courses_user', $this->session->userdata('id'));
        }  
        $total_amount = $this->db->where('status', 'Purchased')->get()->row_array();
        $total_amount = set_currency($total_amount['data']);

        $this->db->select("id");
        $this->db->from($this->table_lms_user_payment);
        if ($this->session->userdata('app_grade') == 'Instructor') {
            $this->db->where('id_courses_user', $this->session->userdata('id'));
        }  
        $total_invoice = $this->db->where('status', 'Purchased')->count_all_results();

        return [
        'total_amount' => $total_amount,
        'total_invoice' => $total_invoice
        ];
    }    

}
