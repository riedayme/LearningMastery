<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Template_Widget extends CI_Model
{

    public $table_lms_category = 'tb_lms_category'; 
    
    public function init($site,$template){

        $all_widget['all_category'] = $this->read_all_category();

        return $all_widget;
    }

    public function read_all_category(){

        $parent_category =  $this->_Process_MYSQL->get_data($this->table_lms_category,['parent =' => ''])->result_array();

        $data = false;
        foreach ($parent_category as $category) {

            $id_parent = $category['id'];
            $child_category = $this->_Process_MYSQL->get_data($this->table_lms_category,['parent =' => $id_parent])->result_array();

            foreach ($child_category as $category_child) {

                $data[$category['name']][] = [
                'icon' => $category_child['icon'],                
                'slug' => $category_child['slug'],
                'name' => $category_child['name'],
                ]; 

            }
        }          

        return $data;
    }    

}