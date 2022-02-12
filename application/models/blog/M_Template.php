<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Template extends CI_Model
{

    public $table_blog_template = 'tb_blog_template';
    public $table_blog_template_style = 'tb_blog_template_style';    
    public $table_blog_template_widget = 'tb_blog_template_widget';

    public function init(){
        return $this->read_template();
    }

    public function read_template(){

        $read = $this->_Process_MYSQL->get_data($this->table_blog_template, array('status' => 'Active'))->row_array();

        return [
            'name' => $read['path'],
            'style' => $this->read_template_style($read['id']),
            'widget' => $this->read_template_widget($read['id']),
        ];
    }

    public function read_template_style($id_template){

        $read = $this->_Process_MYSQL->get_data($this->table_blog_template_style, array('id_template' => $id_template,'status' => 'Active'))->result_array();

        if ($read) {

            foreach ($read as $data_style) {
                $style[$data_style['type']] = $data_style['file'];
            }

            return $style;
        }else {
            return false;
        }

    }    

    public function read_template_widget($id_template){

        $read = $this->_Process_MYSQL->get_data_multiple($this->table_blog_template_widget, $id_template, 'id_template');

        if ($read->num_rows() > 0) {

            $widget = false;
            foreach ($read->result_array() as $data_widget) {
                $data_json = json_decode($data_widget['data_json'],TRUE);
                if ($data_json) {

                    if ($data_widget['type'] == 'image') {
                        $data_json['content'] = base_url('storage/uploads/blog/'.$data_json['content']);
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
