<?php defined('BASEPATH') or exit('No direct script access allowed');

class Feeds extends My_Site {

    public function __construct()
    {
        parent::__construct();

        header("Content-Type: text/xml;charset=iso-8859-1");

        $this->load->helper('xml');
        $this->load->helper('text');

        $this->load->model('site/M_Feeds');
    }  

    function courses()
    {

        $data['site'] = $this->site;
        $data['posts'] = $this->M_Feeds->courses($data['site']);

        $this->load->view("site/feeds/courses",$data);
    }    

    function blog_post()
    {

        $data['site'] = $this->site;
        $data['posts'] = $this->M_Feeds->blog_post($data['site']);

        $this->load->view("site/feeds/blog-post",$data);
    }           

}
