<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Template_Widget extends CI_Model
{

    public $table_blog_post = 'tb_blog_post';   
    public $table_blog_post_category = 'tb_blog_post_category';
    public $table_blog_post_tags = 'tb_blog_post_tags';
    public $table_blog_post_comment = 'tb_blog_post_comment'; 

    public $table_site_pages = 'tb_site_pages';       

    public function init($site,$template){

        if ($template['widget']) {

            $all_widget = false;
            foreach ($template['widget'] as $key => $widget) {
                if ($widget['type'] == 'popular-post') {
                    $all_widget[$key] = $this->widget_popular_post($site,$template['widget'][$key]);
                }elseif ($widget['type'] == 'category') {
                    $all_widget[$key] = $this->widget_category($template['widget'][$key]);
                }elseif ($widget['type'] == 'tags') {
                    $all_widget[$key] = $this->widget_tags($template['widget'][$key]);
                }elseif ($widget['type'] == 'pages') {
                    $all_widget[$key] = $this->widget_pages($template['widget'][$key]);
                }elseif ($widget['type'] == 'featured-post') {
                    $all_widget[$key] = $this->widget_featured_post($site,$template['widget'][$key]);
                }
            }

            return $all_widget;
        }else{
            return false;
        }

    }

    public function widget_popular_post($site,$popular_post){
        if ($popular_post['status'] == 'active') {

            $read = $this->db
            ->select("
                id,
                title,
                permalink,
                image,
                time,
                content,
                views
                ")
            ->from($this->table_blog_post)
            ->limit($popular_post['max_result'])
            ->order_by('views desc, time desc')     
            ->get();

            if ($read->num_rows() < 1) return false;

            /**
             * Build Post
             */
            $this->load->model('site/_Post');
            $post = $this->_Post->read_short($site,$read->result_array());

            return [
                'status' => $popular_post['status'],
                'title' => $popular_post['title'],
                'content' => $post,
            ];
        }
    }

    public function widget_category($category){

        if (!$category['id']) return false;
                
        $read =  $this->db
        ->select('*')
        ->from($this->table_blog_post_category)
        ->where_in('id',$category['id'])
        ->order_by('name', 'ASC')
        ->get();

        if ($read->num_rows() < 1) return false;
        
        foreach ($read->result_array() as $data_category) {
            $extract_category[] = array(
                'title' => $data_category['name'],
                'url' => base_url('blog-category/'.$data_category['slug']),
            );   
        }

        return [
            'status' => $category['status'],
            'title' => $category['title'],
            'content' => $extract_category,
        ];
    }

    public function widget_tags($tags){

        if (!$tags['id']) return false;

        $read =  $this->db
        ->select('*')
        ->from($this->table_blog_post_tags)
        ->where_in('id',$tags['id'])
        ->order_by('name', 'ASC')
        ->get();

        if ($read->num_rows() < 1) return false;
        
        foreach ($read->result_array() as $data_tags) {
            $extract_tags[] = array(
                'title' => $data_tags['name'],
                'url' => base_url('blog-tags/'.$data_tags['slug']),
            );   
        }

        return [
            'status' => $tags['status'],
            'title' => $tags['title'],
            'content' => $extract_tags,
        ];
    } 

    public function widget_pages($pages){

        if (!$pages['id']) return false;

        $read =  $this->db
        ->select('*')
        ->from($this->table_site_pages)
        ->where_in('id',$pages['id'])
        ->order_by('title', 'ASC')
        ->get();

        if ($read->num_rows() < 1) return false;

        foreach ($read->result_array() as $data_pages) {
            $extract_tags[] = array(
                'title' => $data_pages['title'],
                'url' => base_url('p/'.$data_pages['permalink']),
            );   
        }

        return [
            'status' => $pages['status'],
            'title' => $pages['title'],
            'content' => $extract_tags,
        ];
    }     

    public function widget_featured_post($site,$post){

        if (!$post['id']) return false;

        $read = $this->db
        ->select("
            id,
            title,
            permalink,
            image,
            time,
            content,
            views
            ")
        ->from($this->table_blog_post)
        ->where_in('id',$post['id'])
        ->order_by('title', 'ASC')
        ->get();

        if ($read->num_rows() < 1) return false;

        /**
         * Build Post
         */
        $this->load->model('blog/_Post');
        $post_data = $this->_Post->read_short($site,$read->result_array());

        return [
            'status' => $post['status'],
            'title' => $post['title'],
            'content' => $post_data,
        ];        
    }

}