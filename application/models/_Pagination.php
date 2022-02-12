<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class _Pagination extends CI_Model 
{

    public function pagination($post_count,$max_result,$url,$segment = false,$display_pages = true,$query = false)
    {

        # load library
        $this->load->library('pagination');

        # setup config for pagination
        $config['base_url'] = $url;
        $config['total_rows'] = $post_count;
        $config['per_page'] = $max_result;
        if ($segment) {
            $config["uri_segment"] = $segment;
        }
        $config['use_page_numbers'] = TRUE;
        if ($query) {
            $config['page_query_string'] = TRUE;
            $config['enable_query_strings'] = TRUE;
            $config['query_string_segment'] = $query;
        }
        $config['display_pages'] = $display_pages;
        $choice = $config["total_rows"] / $config["per_page"];

        # this is for show all number of pagination i disable because this is so longer result if have many post
        #$config["num_links"] = floor($choice);

        $config["num_links"] = 3;

        # setup for pagination style
        $config['first_link']       = $this->lang->line('first');
        $config['last_link']        = $this->lang->line('last');
        $config['next_link']        = $this->lang->line('next');
        $config['prev_link']        = $this->lang->line('prev');        

        # set config for pagination
        return $config;
        // return array(
        //     'config' => $config,
        //     'total_pagination' => (!empty($post_count) ? $post_count : '0')
        // );                 

    }      

}
