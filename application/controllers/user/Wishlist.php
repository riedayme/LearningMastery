<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends My_User
{

    public $index = 'user/wishlist/index';
    public $redirect = 'user/wishlist';

    public function __construct(){
        parent::__construct();

        $this->load->model('lms/_Lesson');
        $this->load->model('lms/_Courses');
        $this->load->model('user/M_Wishlist');       
    }   
    
    public function index()
    {

        $site = $this->site;
        $widget= $this->widget; 
        $wishlist = $this->M_Wishlist->read($site);

        $data = array(
            'site' => $site,
            'widget' => $widget,    
            'wishlist' =>  $wishlist
        );

        $this->load->view($this->index, $data);
    }

    public function process(){

        /** check if ajax request */
        if ($this->input->is_ajax_request()) {

            $process = $this->M_Wishlist->process();

        }else{
            redirect(base_url());
        }
    }    

    public function process_delete($id){
        
        $process = $this->M_Wishlist->remove_wishlist([
            'id_user' => $this->session->userdata('id_user'),
            'id_courses' => $id,
        ]);

        redirect($this->redirect);
    }

}
