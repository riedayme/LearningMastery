<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Blog_Template extends CI_Model
{

	public $table_blog_template = 'tb_blog_template';
	public $table_blog_template_style = 'tb_blog_template_style';   

    public function read_template(){

        $read = $this->_Process_MYSQL->read_data($this->table_blog_template, 'name', 'ASC')->result_array();   

        foreach ($read as $template) {
            $data [] = [
                'template' => $template,
                'style' => $this->read_template_style($template['id']),
            ];
        }
        
        return $data;
    }

    public function read_template_update($id){

        $read_template = $this->_Process_MYSQL->get_data($this->table_blog_template, array('id' => $id))->row_array();

        if ($read_template['status'] != 'Active') redirect($this->redirect);

        $path = $read_template['path'];

        $read_file = $this->file_tree('application/views/blog/templates/'.$path.'/');

        return $read_file;
    }

    /**
     * https://stackoverflow.com/questions/19573131/php-create-dynamic-multidimensional-file-tree-array
     */
    public function file_tree($src){
        $files = array_map('basename', glob("$src/*"));
        foreach($files as $file) {
            if(is_dir("$src/$file")) {
                $return[$file] = $this->file_tree("$src/$file");
            } else {
                $return[] = [
                    'path' => str_replace('//', '/', $src).'/'.$file,
                    'name' => $file
                ];
            }
        }
        return $return;
    }

    public function read_template_style($id_template){

        $read = $this->_Process_MYSQL->get_data_multiple($this->table_blog_template_style, $id_template, 'id_template')->result_array();

        return $read;
    }

    public function process_template(){

        $update = $this->db->update($this->table_blog_template, array('status' => 'No'), array('status'=>'Active'));

        if ($update) {
            return $this->db->update($this->table_blog_template, array('status' => 'Active'), array('id'=>$this->input->post('id')));
        }else{
            return false;
        }
    }    

    public function process_style($type){

        $update = $this->db->update($this->table_blog_template_style, array('status' => 'No'), array('status'=>'Active','type' => $type,'id_template' => $this->input->post('id_template')));

        if ($update) {
            return $this->db->update($this->table_blog_template_style, array('status' => 'Active'), array('id'=>$this->input->post('id')));
        }else{
            return false;
        }
    }

}