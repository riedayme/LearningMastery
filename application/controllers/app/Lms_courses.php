<?php defined('BASEPATH') or exit('No direct script access allowed');

class Lms_courses extends My_App
{

    public $index = 'app/lms_courses/index';
    public $form = 'app/lms_courses/form';
    public $form_lesson = 'app/lms_courses/form-lesson';    
    public $redirect = 'app/lms_courses';

    public function __construct(){
        parent::__construct();

        $this->load->model('app/M_LMS_Courses');         
    }    

    public function index()
    {

        $data = [
            'title' => 'Courses',
        ];

        $this->load->view($this->index, array_merge($data,$this->M_LMS_Courses->datatables()));
    }

    public function datatables()
    {

        $data = $this->M_LMS_Courses->data_table();

        echo $data;
    }

    public function create()
    {

        $data = array(
            'title' => 'Create Courses',
            'ckeditor' => true,
            'onbeforeunload' => false,
            'dragula' => true,
        );

        $this->load->view($this->form, array_merge($data,$this->M_LMS_Courses->required()));
    }    

    public function update($id){
        $data = array(
            'title' => 'Update Courses',
            'ckeditor' => true,
            'onbeforeunload' => false,
            'dragula' => true,
            'data' => $this->M_LMS_Courses->data_update($id),
            'section' => $this->M_LMS_Courses->data_section($id),           
        );

        $this->load->view($this->form, array_merge($data,$this->M_LMS_Courses->required()));
    }    

    public function delete($id)
    {
        if ($this->M_LMS_Courses->process_delete($id) == TRUE) {
            echo true;
        }else {
            echo false;
        }
    }

    public function process(){

        if (!empty($this->input->post('id'))) {

            if ($this->M_LMS_Courses->process_update() == TRUE) {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_update'),
                ]);
            }   

            if (!empty($this->input->post('save'))) {
                redirect($this->input->post('save'),'refresh');
            }else {
                redirect(base_url($this->redirect));
            }
        }else {

            $create = $this->M_LMS_Courses->process_create();

            if ($create) {
                redirect(base_url('app/lms_courses/update/'.$create.'?tab=material'));
            }   
        }

    } 

    public function process_multiple()
    {

        $id = explode(',', $this->input->post('id'));
        $action = $this->input->post('action');

        /**
         * Update Post to Published
         */
        if ($action == 'post') {

            foreach ($id as $key => $item) 
            {
                $data[] = array(
                    'id' => $id[$key],
                    'status' => 'Published',
                );
            }

            if ($this->M_LMS_Courses->process_multiple_update($data) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }        

        /**
         * Update Post to Draft
         */
        if ($action == 'draft') {

            foreach ($id as $key => $item) 
            {
                $data[] = array(
                    'id' => $id[$key],
                    'status' => 'Draft',
                );
            }

            if ($this->M_LMS_Courses->process_multiple_update($data) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

        /**
         * Delete Post
         */
        if ($action == 'delete') {

            if ($this->M_LMS_Courses->process_multiple_delete($id) == TRUE) {
                echo true;
            }else {
                echo false;
            }
        }

    }         


    /**
     * process section
     */
    public function process_section() {

        if (!empty($this->input->post('id'))) {

            if ($this->M_LMS_Courses->process_section_update() == TRUE) {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_update'),
                ]);
            }   

        }else {

            if ($this->M_LMS_Courses->process_section_create() == TRUE) {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_create'),
                ]);
            }               
        }

        redirect($this->input->post('redirect'));
    }

    public function process_section_delete($id) {

        if ($this->M_LMS_Courses->process_section_delete($id) == TRUE) {
            $this->session->set_flashdata([
                'message' => true,
                'message_type' => 'danger',
                'message_text' => $this->lang->line('success_delete'),
            ]);
        }else {
            $this->session->set_flashdata([
                'message' => true,
                'message_type' => 'danger',
                'message_text' => $this->lang->line('failed_delete'),
            ]);
        }

        redirect($this->agent->referrer());
    }

    public function process_section_sort(){

        if ($this->M_LMS_Courses->process_section_sort() == TRUE) {

            $this->session->set_flashdata([
                'message' => true,
                'message_type' => 'info',
                'message_text' => $this->lang->line('success_update'),
            ]);
        }   

        redirect($this->input->post('redirect'));
    }


    /**
     * process lesson
     */
    public function create_lesson($id_section){

        $data = array(
            'title' => 'Create Lesson',
            'ckeditor' => true,
            'data' => $this->M_LMS_Courses->required_lesson($id_section),
        );

        $this->load->view($this->form_lesson, $data);
    }

    public function update_lesson($id_section,$id_lesson){

        $data = array(
            'title' => 'Update Lesson',
            'ckeditor' => true,
            'data' => $this->M_LMS_Courses->required_lesson($id_section),
            'lesson' => $this->M_LMS_Courses->data_lesson_update($id_section,$id_lesson),           
        );

        $this->load->view($this->form_lesson, $data);
    }    

    public function process_lesson(){

        if (!empty($this->input->post('id'))) {

            if ($this->M_LMS_Courses->process_lesson_update() == TRUE) {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_update'),
                ]);
            }   

        }else {

            if ($this->M_LMS_Courses->process_lesson_create() == TRUE) {

                $this->session->set_flashdata([
                    'message' => true,
                    'message_type' => 'info',
                    'message_text' => $this->lang->line('success_create'),
                ]);
            }               
        }

        redirect(base_url('app/lms_courses/update/'.$this->input->post('id_courses')."?tab=material"));
    }

    public function process_lesson_delete($id) {

        if ($this->M_LMS_Courses->process_lesson_delete($id) == TRUE) {
            $this->session->set_flashdata([
                'message' => true,
                'message_type' => 'danger',
                'message_text' => $this->lang->line('success_delete'),
            ]);
        }else {
            $this->session->set_flashdata([
                'message' => true,
                'message_type' => 'danger',
                'message_text' => $this->lang->line('failed_delete'),
            ]);
        }

        redirect($this->agent->referrer());
    }  

    public function process_lesson_sort(){

        if ($this->M_LMS_Courses->process_lesson_sort() == TRUE) {

            $this->session->set_flashdata([
                'message' => true,
                'message_type' => 'info',
                'message_text' => $this->lang->line('success_update'),
            ]);
        }   

        redirect($this->input->post('redirect'));
    }     

}