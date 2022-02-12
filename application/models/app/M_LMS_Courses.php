<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_LMS_Courses extends CI_Model
{

    public $table_user = 'tb_user';  

    public $table_lms_courses = 'tb_lms_courses';
    public $table_lms_courses_section = 'tb_lms_courses_section';
    public $table_lms_courses_lesson = 'tb_lms_courses_lesson';
    public $table_lms_category = 'tb_lms_category';        

    public function datatables(){
        return [
            'datatable' => true,
            'datatables_data' => "
            [{'data': 'checkbox',className:'c-table__cell u-pl-small'},
            {'data': 'id',className:'c-table__cell'},
            {'data': 'title',className:'c-table__cell u-pl-small',width:'80%'},
            {'data': 'category',className:'c-table__cell u-text-center'},
            {'data': 'user',className:'c-table__cell',width:'20%'},                    
            {'data': 'time',className:'c-table__cell'},            
            {'data': 'updated',className:'c-table__cell'},                                                          
            {'data': 'view',className:'c-table__cell'},            
            {'data': 'alat',className:'c-table__cell'}
            ]
            ",
        ];
    }

    public function data_table(){

        header('Content-Type: application/json');        

        $this->datatables->select('
            tb_lms_courses.id,
            tb_lms_courses.title,
            DATE_FORMAT(tb_lms_courses.time, "%d %M %Y %H:%i %p") as time,
            tb_lms_courses.time as timeorigin,
            DATE_FORMAT(tb_lms_courses.updated, "%d %M %Y %H:%i %p") as updated,            
            tb_lms_courses.permalink,
            tb_lms_courses.views,
            tb_lms_courses.status,
            tb_lms_category.name as category,
            tb_user.photo,
            tb_user.username as user
            ');
        $this->datatables->from($this->table_lms_courses);
        $this->datatables->join($this->table_user, 'tb_lms_courses.id_user = tb_user.id', 'LEFT');
        $this->datatables->join($this->table_lms_category, 'tb_lms_courses.id_sub_category = tb_lms_category.id', 'LEFT');  
        if ($this->session->userdata('app_grade') == 'Instructor') {
            $this->datatables->where('tb_lms_courses.id_user', $this->session->userdata('id'));
        }      
        $this->datatables->group_by('tb_lms_courses.id');
        $this->datatables->add_column('checkbox', '
            <td>
            <div class="c-choice c-choice--checkbox">
            <input type="checkbox" id="checkbox-$1" class="c-choice__input" name="id[]" value="$1">
            <label for="checkbox-$1" class="c-choice__label">&nbsp;</label>
            </div>
            </td>
            ', 'id');

        $this->datatables->edit_column('title', '
            <a title="$1" href="' . base_url('courses-detail/') ."$2" . '" target="_blank">$1</a>
            <span class="u-block u-text-mute">
            $3
            <small class="u-mr-xsmall"><i class="fa fa-eye u-color-warning"></i>&nbsp; $4</small>
            </span>
            ', 'ctsubstr(title,60),permalink,formatstatus(timeorigin,status),views');

        $this->datatables->edit_column('category', '$1', 'ucwords(category)');

        $this->datatables->edit_column('user', '
            <div class="o-media">
            <div class="o-media__img u-mr-xsmall">
            <div class="c-avatar c-avatar--xsmall">
            $1
            </div>
            </div>
            <div class="o-media__body">
            $2
            </div>
            </div>
            ', 'photo_user(photo),user');

        $this->datatables->add_column('alat', '

            <a class="c-btn--custom c-btn--small c-btn c-btn--info" href="'.base_url('app/lms_courses/').'update/$1"><i class="fa fa-edit"></i></a>

            <button type="button" data-title="are you sure ?" data-text="want to delete $2" class="c-btn c-btn--danger c-btn--custom action-delete" data-href="'. base_url('app/lms_courses/delete/$1') .'">
            <i class="fa fa-trash"></i>
            </button>
            ', 'id,title');

        $this->datatables->add_column('view', '
          <button type="button" class="c-btn--custom c-btn--small c-btn c-btn--primary" name="action-view"><i class="fa fa-eye"></i></button>
          ', 'id');                 

        return $this->datatables->generate();
    }  

    public function required(){

        $parent_category =  $this->_Process_MYSQL->get_data($this->table_lms_category,['parent =' => ''])->result_array();

        foreach ($parent_category as $category) {

            $id_parent = $category['id'];
            $child_category = $this->_Process_MYSQL->get_data($this->table_lms_category,['parent =' => $id_parent])->result_array();

            foreach ($child_category as $category_child) {

                $data[$category['name']][] = [
                    'id_category' => $category['id'],
                    'id_sub_category' => $category_child['id'],                    
                    'name' => $category_child['name'],
                ]; 

            }
        }

        $all_data = [
            'categorys' => $data
        ];                

        return $all_data;
    }      

    public function data_post()
    {

        $post_data = [          
            'title' => strip_tags($this->input->post('title')),
            'permalink' => $this->input->post('permalink'),
            'image' => strip_tags($this->input->post('image')),
            'price' => str_replace('.', '', strip_tags($this->input->post('price'))),
            'discount' => str_replace('.', '', strip_tags($this->input->post('discount'))),
            'description' => htmlentities($this->input->post('description')),
            'faq' => htmlentities($this->input->post('faq')),
            'status' => $this->input->post('status'),
        ];

        /**
         * Extract id_category and id_sub_category
         */
        if (!empty($this->input->post('category'))) {

            $category = explode('__', $this->input->post('category'));

            $post_merge = array(
                'id_category' => $category[0],
                'id_sub_category' => $category[1],                
            );

            $post_data = array_merge($post_data, $post_merge);   
        }

        /**
         * Check if process create > merge time data
         */
        if (empty($this->input->post('id'))) {

            $post_merge = array(
                'id_user' => $this->session->userdata('id'),
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
         * check if discount > price
         */
        if ($post_data['discount'] >= $post_data['price']) {
            $post_data['discount'] = false;
        }

        /**
         * Set Permalink News if Update
         */
        if (empty($post_data['permalink'])) {
            $permalink_news = strtolower(slug($post_data['title']));
        }else {        
            $permalink_old = strtolower(slug($this->input->post('permalink'."_old")));
            $set_permalink = strtolower(slug($post_data['permalink']));

            if ($permalink_old == $set_permalink) {
                $permalink_news = $set_permalink;                
            }else {

                $read_post = $this->_Process_MYSQL->get_data($this->table_lms_courses, array('permalink' => $set_permalink))->num_rows();
                if ($read_post > 0) {
                    $uniqe_string = rand();
                    $permalink_news = $set_permalink."-".$uniqe_string;
                }else {
                    $permalink_news = $set_permalink;
                }
            }
        }

        $post_data['permalink'] = $permalink_news;          

        return $post_data;        
    }     

    public function data_update($id){
        $read = $this->_Process_MYSQL->get_data($this->table_lms_courses,['id' => $id])->row_array();

        if ($this->session->userdata('app_grade') == 'Instructor') {
            if ($read['id_user'] == $this->session->userdata('id')) {
                return $read;
            }else{
                redirect(base_url('app/lms_courses'));
            }
        }else{
            return $read;
        }
    }

    public function process_create(){
        return $this->_Process_MYSQL->insert_data($this->table_lms_courses,$this->data_post(),true);
    }

    public function process_update(){
        return $this->_Process_MYSQL->update_data($this->table_lms_courses,$this->data_post(),['id' => $this->input->post('id')]);
    }       

    public function process_delete($id){

        /* check owned courses */
        if ($this->data_update($id)) {
            if ($this->_Process_MYSQL->delete_data($this->table_lms_courses, array('id' => $id)) == true) {
                $this->_Process_MYSQL->delete_data($this->table_lms_courses_section, array('id_courses' => $id));
                $this->_Process_MYSQL->delete_data($this->table_lms_courses_lesson, array('id_courses' => $id));
                return true;
            } else {
                return false;
            }
        }

    }

    public function process_multiple_update($data){
        return $this->_Process_MYSQL->update_data_multiple($this->table_lms_courses, $data, 'id');
    }

    public function process_multiple_delete($id){

        if ($this->_Process_MYSQL->delete_data_multiple($this->table_lms_courses, $id, 'id') == true) {
            echo true;
        } else {
            echo false;
        }
    }  


    /**
     * Process Section
     */

    public function data_section($id){
        return $this->_Process_MYSQL->get_data_multiple($this->table_lms_courses_section, $id,'id_courses',false,['order','ASC'])->result_array();
    }

    public function data_section_post(){
        return [
            'id_courses' => $this->input->post('id_courses'),
            'title' => $this->input->post('title'),
        ];
    }

    public function process_section_create(){
        return $this->_Process_MYSQL->insert_data($this->table_lms_courses_section,$this->data_section_post(),true);
    }

    public function process_section_update(){
        return $this->_Process_MYSQL->update_data($this->table_lms_courses_section,$this->data_section_post(),['id' => $this->input->post('id')]);
    }   

    public function process_section_delete($id) {
        $read = $this->_Process_MYSQL->get_data($this->table_lms_courses_section,['id' => $id])->row_array();

        if ($this->data_update($read['id_courses'])) { /* check if user have this courses */
            if ($this->_Process_MYSQL->delete_data($this->table_lms_courses_section, array('id' => $id))) {
                return $this->_Process_MYSQL->delete_data($this->table_lms_courses_lesson, array('id_section' => $id));
            }
        }

    }

    public function process_section_sort(){

        $sections = explode(',', $this->input->post('order'));
        
        foreach ($sections as $key => $value) {
            $data[] = array(
                'order' => $key + 1,
                'id' => $value,
            );
        }   

        return $this->_Process_MYSQL->update_data_multiple($this->table_lms_courses_section, $data, 'id');
    }

    /**
     * Process Lesson
     */    

    public function required_lesson($id_section){

        $this->db
        ->select("
            tb_lms_courses_section.id as section_id,
            tb_lms_courses.id as courses_id,
            tb_lms_courses_section.title as section_title,
            tb_lms_courses.title as course_title            
            ")
        ->from($this->table_lms_courses_section)
        ->join($this->table_lms_courses,'tb_lms_courses_section.id_courses = tb_lms_courses.id','LEFT OUTER')
        ->where('tb_lms_courses_section.id',$id_section);
        if ($this->session->userdata('app_grade') == 'Instructor') {
            $this->db->where('tb_lms_courses.id_user',$this->session->userdata('id'));     
        }
        $data = $this->db->get()->row_array();

        if (empty($data)) redirect(base_url('app/lms_courses'));

        return $data;            
    }

    public function data_lesson($id){
        return $this->_Process_MYSQL->get_data_multiple($this->table_lms_courses_lesson, $id,'id_section',false,['order','ASC'])->result_array();
    }    

    public function data_lesson_post(){
        return [
            'id_courses' => $this->input->post('id_courses'),
            'id_section' => $this->input->post('id_section'),
            'title' => $this->input->post('title'),
            'type' => $this->input->post('type'),
            'content' => $this->input->post('content'),
        ];
    }

    public function process_lesson_create(){
        return $this->_Process_MYSQL->insert_data($this->table_lms_courses_lesson,$this->data_lesson_post(),true);
    }

    public function data_lesson_update($id_section,$id){
        $read = $this->_Process_MYSQL->get_data($this->table_lms_courses_lesson, ['id' => $id])->row_array();

        if (empty($read)) redirect(base_url('app/lms_courses'));
        if ($read['id_section'] != $id_section) redirect(base_url('app/lms_courses'));

        return $read;            
    }

    public function process_lesson_update(){
        return $this->_Process_MYSQL->update_data($this->table_lms_courses_lesson,$this->data_lesson_post(),['id' => $this->input->post('id')]);
    }   

    public function process_lesson_delete($id) {

        $read = $this->_Process_MYSQL->get_data($this->table_lms_courses_lesson,['id' => $id])->row_array();

        if ($this->data_update($read['id_courses'])) { /* check if user have this courses */
            return $this->_Process_MYSQL->delete_data($this->table_lms_courses_lesson, array('id' => $id));
        }
    }    

    public function process_lesson_sort(){

        $sections = explode(',', $this->input->post('order'));
        
        foreach ($sections as $key => $value) {
            $data[] = array(
                'order' => $key + 1,
                'id' => $value,
            );
        }   

        return $this->_Process_MYSQL->update_data_multiple($this->table_lms_courses_lesson, $data, 'id');
    }    

}