<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_LMS_Coupon extends CI_Model
{    

    public $table_lms_coupon = 'tb_lms_coupon';

    public function datatables(){

        return [
        'datatable' => true,
        'datatables_data' => "
        [{'data': 'checkbox',className:'c-table__cell u-pl-small u-pr-small', width:'50'},
        {'data': 'id',className:'c-table__cell'},
        {'data': 'code',className:'c-table__cell u-pl-zero',width:'100%'},
        {'data': 'type',className:'c-table__cell u-pl-zero',width:'100%'},
        {'data': 'data',className:'c-table__cell u-pl-zero',width:'100%'},
        {'data': 'for',className:'c-table__cell u-pl-zero',width:'100%'},            
        {'data': 'expired',className:'c-table__cell u-pl-zero',width:'100%'},                    
        {'data': 'view',className:'c-table__cell', width:'100'},
        {'data': 'alat',className:'c-table__cell', width:'100'} 
        ]
        ",
        ];
    }

    public function data_table(){

        header('Content-Type: application/json');  

        $this->datatables->select('id, code,type,data,for,expired');
        $this->datatables->from($this->table_lms_coupon);
        $this->datatables->add_column('checkbox', '
            <td>
                <div class="c-choice c-choice--checkbox">
                    <input type="checkbox" id="checkbox-$1" class="c-choice__input" name="id[]" value="$1">
                    <label for="checkbox-$1" class="c-choice__label">&nbsp;</label>
                </div>
            </td>
            ', 'id');
        $this->datatables->add_column('alat', '
            <button class="c-btn--custom c-btn--small c-btn c-btn--info action-edit-coupon" type="button" data-id="$1" data-code="$2" data-type="$3" data-data="$4" data-for="$5" data-expired="$6" data-title="Update" data-toggle="modal" data-target="#modal"><i class="fa fa-edit"></i></button>
            <button type="button" data-title="are you sure ?" data-text="want to delete $2" class="c-btn c-btn--danger c-btn--custom action-delete" data-href="'. base_url('app/lms_coupon/delete/$1') .'">
                <i class="fa fa-trash"></i>
            </button>
            ', 'id,code,type,data,for,expired');

        $this->datatables->add_column('view', '
          <button type="button" class="c-btn--custom c-btn--small c-btn c-btn--primary" name="action-view"><i class="fa fa-eye"></i></button>
          ', 'id');         
        return $this->datatables->generate();
    }    

    public function data_post()
    {

        return [          
        'code' => strip_tags($this->input->post('code')),
        'expired' => strip_tags($this->input->post('expired')),
        'type' => strip_tags($this->input->post('type')),
        'for' => strip_tags($this->input->post('for')),
        'data' =>str_replace('.', '', strip_tags($this->input->post('data'))),
        ];
    }    

    public function check_data(){

        $data = ['code' => strtolower($this->input->post('code'))];

        if (!empty($this->input->post('id'))) {
            $data = array_merge($data,['id !=' => $this->input->post('id')]);
        }
        
        return $this->_Process_MYSQL->get_data($this->table_lms_coupon,$data)->num_rows();
    }    

    public function process_create(){

        if ($this->check_data() < 1) {

            if ($this->_Process_MYSQL->insert_data($this->table_lms_coupon,$this->data_post())) {
                return 'success';
            }else{
                return false;
            }
        }else {
            return 'invalid';
        }
    }

    public function process_update(){

        if ($this->check_data() < 1) {

            if ($this->_Process_MYSQL->update_data($this->table_lms_coupon,$this->data_post(),['id' => $this->input->post('id')])) {
                return 'success';
            }else{
                return false;
            }
        }else {
            return 'invalid';
        } 

    }  

    public function process_delete($id){
        return $this->_Process_MYSQL->delete_data($this->table_lms_coupon, array('id' => $id));
    }

    public function process_multiple_delete($id){
        return $this->_Process_MYSQL->delete_data_multiple($this->table_lms_coupon, $id, 'id');
    }    

    
}
