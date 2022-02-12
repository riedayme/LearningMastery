<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_LMS_Category extends CI_Model
{    

    public $table_lms_category = 'tb_lms_category';

    public function data(){

        $parent_category =  $this->_Process_MYSQL->get_data($this->table_lms_category,['parent =' => ''])->result_array();

        $all_data = false;
        foreach ($parent_category as $category) {

            $category_data = [
                'id' => $category['id'],
                'name' => $category['name'],
                'icon' => $category['icon'],
                'image' => $category['image'],                
            ];

            $id_parent = $category['id'];
            $child_category = $this->_Process_MYSQL->get_data($this->table_lms_category,['parent =' => $id_parent])->result_array();

            $sub_category_data = false;
            foreach ($child_category as $category_child) {

                $sub_category_data[] = [
                    'id' => $category_child['id'],
                    'name' => $category_child['name'],
                    'icon' => $category_child['icon'],
                    'url' => base_url('courses/category/'.$category_child['slug']),
                ]; 

            }

            $all_data[] = array_merge($category_data,['sub_category' => $sub_category_data]);
            unset($sub_category_data);
        }

        return $all_data;
    }  

    public function required($withpost = false){

        $data = [
            'categorys' => $this->_Process_MYSQL->get_data($this->table_lms_category,['parent =' => ''])->result_array()
        ];

        return $data;
    }

    public function data_post()
    {

        $post_data = [          
            'name' => strip_tags($this->input->post('name')),
            'slug' => slug(strip_tags($this->input->post('name'))),
            'parent' => strip_tags($this->input->post('parent')),
            'icon' => strip_tags($this->input->post('icon')),
            'image' => strip_tags($this->input->post('image')),
        ];

        /**
         * Check if process create > merge time data
         */
        if (empty($this->input->post('id'))) {

            $post_merge = array(
                'time' => date('Y-m-d H:i:s'),
            );

            $post_data = array_merge($post_data, $post_merge);   
        }         

        /**
         * Check if process update > merge updated data
         */
        if (!empty($this->input->post('id'))) {

            $post_merge = array(
                'updated' => date('Y-m-d H:i:s'),
            );

            $post_data = array_merge($post_data, $post_merge);   
        }   

        /**
         * remove data image if sub category
         */
        if (!empty($post_data['parent']) AND $post_data['parent'] != 'None') {
            $post_data['image'] = '';
        }

        /**
         * fix if parent none to exist
         */
        if (!empty($this->input->post('id'))) {
            $check_parent = $this->check_parent($this->input->post('id'));
            if ($check_parent > 0) {
                $post_data['parent'] = 'None';
            }
        }
        
        return $post_data;        
    }    

    public function check_parent($id){

        $data = [
            'parent' => $id,
        ];

        return $this->_Process_MYSQL->get_data($this->table_lms_category,$data)->num_rows();
    }      

    public function check_data(){

        $data = [
            'name' => strtolower($this->input->post('name'))
        ];

        if (!empty($this->input->post('id'))) {
            $data = array_merge($data,['id !=' => $this->input->post('id')]);
        }

        return $this->_Process_MYSQL->get_data($this->table_lms_category,$data)->num_rows();
    }    

    public function process_create(){

        if ($this->check_data() < 1) {

            if ($this->_Process_MYSQL->insert_data($this->table_lms_category,$this->data_post())) {
                return 'success';
            }else{
                return false;
            }
        }else {
            return 'invalid';
        }
    }

    public function data_update($id){
        return $this->_Process_MYSQL->get_data($this->table_lms_category,['id' => $id])->row_array();
    }   

    public function process_update(){

        if ($this->check_data() < 1) {

            if ($this->_Process_MYSQL->update_data($this->table_lms_category,$this->data_post(),['id' => $this->input->post('id')])) {
                return 'success';
            }else{
                return false;
            }
        }else {
            return 'invalid';
        } 

    }  

    public function process_delete($id){
        return $this->_Process_MYSQL->delete_data($this->table_lms_category, array('id' => $id));
    }

}
