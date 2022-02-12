<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Template extends CI_Model
{

    public $table_lms_template = 'tb_lms_template';
    public $table_lms_template_widget = 'tb_lms_template_widget';

    public function init(){
        return $this->read_template();
    }

    public function read_template(){

        $read = $this->_Process_MYSQL->get_data($this->table_lms_template, array('status' => 'Active'))->row_array();

        return [
            'name' => $read['path'],
            'widget' => $this->read_template_widget($read['id']),
        ];
    }  

    public function read_template_widget($id_template){

        $read = $this->_Process_MYSQL->get_data_multiple($this->table_lms_template_widget, $id_template, 'id_template');

        if ($read->num_rows() > 0) {

            $widget = false;
            foreach ($read->result_array() as $data_widget) {
                $data_json = json_decode($data_widget['data_json'],TRUE);
                if ($data_json) {

                    if ($data_widget['type'] == 'image') {
                        $data_json['content'] = base_url('storage/uploads/lms/'.$data_json['content']);
                    }

                    $data_json = array_merge($data_json,['type' => $data_widget['type']]);
                    $widget[$data_widget['var']] = $data_json;
                }
            }

            return $widget;
            
        }else {
            return array();
        }

    }

}
