<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sitemap extends My_Site {

    public $splid;
    public $loop_blog_post;
    public $loop_blog_pages;

    public function __construct()
    {
        parent::__construct();

        header("Content-Type: text/xml; charset=UTF-8");

        $this->load->model('site/M_Sitemap');

        $this->splid = 100;   
    }  

    function sitemap_index(){

        $data['site'] = $this->site;

        $data['courses'] = $this->M_Sitemap->index_courses($this->splid);
        $data['blog_post'] = $this->M_Sitemap->index_blog_post($this->splid);
        $data['pages'] = $this->M_Sitemap->index_pages($this->splid);

        $this->load->view("site/sitemap/index",$data);
    }

    function sitemap_root(){

        $data['site'] = $this->site;

        $this->load->view("site/sitemap/root",$data);
    }

    function sitemap_courses($page)
    {

        $data['courses'] = $this->M_Sitemap->sitemap_courses($page,$this->splid);
        if (!$data['courses']) redirect(base_url());

        $this->load->view("site/sitemap/courses",$data);
    }

    function sitemap_blog_post($page)
    {

        $data['post'] = $this->M_Sitemap->sitemap_blog_post($page,$this->splid);
        if (!$data['post']) redirect(base_url());

        $this->load->view("site/sitemap/blog-post",$data);
    }

    function sitemap_pages($page)
    {

        $data['pages'] = $this->M_Sitemap->sitemap_pages($page,$this->splid);
        if (!$data['pages']) redirect(base_url());

        $this->load->view("site/sitemap/pages",$data);
    }    
}
