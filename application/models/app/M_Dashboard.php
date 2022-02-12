<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Dashboard extends CI_Model
{

    public $table_lms_courses = 'tb_lms_courses';
    public $table_user = 'tb_user';

    public $table_blog_post = 'tb_blog_post';
    public $table_blog_post_category = 'tb_blog_post_category';
    public $table_blog_post_tags = 'tb_blog_post_tags';
    public $table_blog_post_comment = 'tb_blog_post_comment';

    public $table_site_visitor = 'tb_site_visitor';

    public $table_site_pages = 'tb_site_pages';

    public function get_statistic(){

        /**
         * count courses
         */
        $count_courses = $this->db->from($this->table_lms_courses)->count_all_results();

        /**
         * count blog post
         */
        $count_post = $this->db
        ->select("id")
        ->from($this->table_blog_post)
        ->where("time <= NOW()")
        ->where("status = 'Published'")
        ->count_all_results();

        /**
         * count pages
         */
        $count_pages = $this->db
        ->select("id")
        ->from($this->table_site_pages)
        ->where("time <= NOW()")
        ->where("status = 'Published'")
        ->count_all_results();        

        /**
         * count user
         */
        $count_user = $this->db->from($this->table_user)->where("grade = 'User'")->count_all_results();

        /**
         * count total visitor
         */        
        $total_visitor = $this->db
        ->select("id")
        ->from($this->table_site_visitor)
        ->group_by('ip') 
        ->group_by('DATE(date)') 
        ->count_all_results();

        /**
         * hits today
         */ 
        $hits_today = $this->db
        ->select("SUM(hits) as hits")
        ->from($this->table_site_visitor)
        ->where('DATE(date) = DATE(CURDATE())')
        ->get()->row()->hits;

        /**
         * Statistic Visitor Chart.js
         * 7 Last Day
         */
        $visitor = $this->db
        ->select('DATE_FORMAT(date,"%d") AS tanggal, DATE_FORMAT(date,"%b") AS bulan, COUNT(DISTINCT ip) AS jumlah') 
        ->from($this->table_site_visitor)
        ->where('DATE(date) > DATE(NOW() - INTERVAL 7 DAY)')
        ->group_by('DATE(date)') 
        ->get();

        if ($visitor->num_rows() > 0) {
            foreach($visitor->result_array() as $result){
                $label_visitor[] = $result['tanggal'].' '.$result['bulan']; 
                $data_visitor[] = (float) $result['jumlah'];
            }

            $last_array = end($data_visitor);    
            
            if ($prev_before_last = prev($data_visitor)) {
                $get_two_data = $last_array-$prev_before_last;
                $from_end_to_prev_pecent = @number_format(($get_two_data * 100) / $prev_before_last, 2);
                $from_end_to_prev_pecent_status = ($from_end_to_prev_pecent > 0) ? 'up' : 'down';
            }else {
                $from_end_to_prev_pecent = 100;
                $from_end_to_prev_pecent_status = 'up';
            }
        }else {
            $from_end_to_prev_pecent = 0;
            $from_end_to_prev_pecent_status = 'up';
        }

        /**
         * pageview today
         */ 
        $page_view_today = $this->db
        ->select("id")
        ->from($this->table_site_visitor)
        ->where('DATE(date) = DATE(CURDATE())')
        ->count_all_results();
        
        /**
         * pageview yesterday
         */
        $page_view_yesterday = $this->db
        ->select("id")
        ->from($this->table_site_visitor)
        ->where('DATE(date) = DATE(CURRENT_DATE - INTERVAL 1 DAY)')
        ->count_all_results();  
        

        /**
         * pageview last month
         */
        $page_view_last_month = $this->db
        ->select("id")
        ->from($this->table_site_visitor)
        ->where('YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH)')
        ->where('MONTH(date) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)')
        ->count_all_results();

        /**
         * pageview all time
         */
        $page_view_all_time = $this->db
        ->select("id")
        ->from($this->table_site_visitor)
        ->count_all_results();           

        $page_view_by_browser = $this->db
        ->select("
            browser,            
            COUNT(browser) AS jumlah
            ")
        ->from($this->table_site_visitor)
        ->group_by('browser') 
        ->get();     

        $page_view_by_browser_data = false;
        if ($page_view_by_browser->num_rows() > 0) {
            $page_view_by_browser_count = 0;
            foreach ($page_view_by_browser->result_array() as $data) {
                $page_view_by_browser_count = $page_view_by_browser_count + $data['jumlah'];
            }

            foreach ($page_view_by_browser->result_array() as $data) {
                $page_view_by_browser_data[] = [
                'browser' => $data['browser'],
                'jumlah' => $data['jumlah'],                    
                'percentage' => number_format(($data['jumlah'] * 100) / $page_view_by_browser_count,2)."%",
                ];
            }
        }  

        /**
         * pageview by os
         */
        $page_view_by_os = $this->db
        ->select("
            os,            
            COUNT(os) AS jumlah           
            ")
        ->from($this->table_site_visitor)
        ->group_by('os') 
        ->get();

        $page_view_by_os_data = false;
        if ($page_view_by_os->num_rows() > 0) {
            $page_view_by_os_count = 0;
            foreach ($page_view_by_os->result_array() as $data) {
                $page_view_by_os_count = $page_view_by_os_count + $data['jumlah'];
            }

            foreach ($page_view_by_os->result_array() as $data) {
                $page_view_by_os_data[] = [
                'os' => $data['os'],
                'jumlah' => $data['jumlah'],                    
                'percentage' => number_format(($data['jumlah'] * 100) / $page_view_by_os_count,2)."%",
                ];
            }
        }  


        /**
         * pageview by country
         */
        $page_view_country = $this->db
        ->select("
            country_code,            
            COUNT(country_code) AS jumlah           
            ")
        ->from($this->table_site_visitor)
        ->group_by('country_code') 
        ->get();  

        if ($page_view_country->num_rows() > 0) {
            foreach($page_view_country->result_array() as $result){
                $all_country[$result['country_code']] = (float)$result['jumlah']; 
            }
        }

        /**
         * pageview by country table
         */
        $page_view_country_table = $this->db
        ->select("
            country_name,            
            COUNT(country_name) AS jumlah           
            ")
        ->from($this->table_site_visitor)
        ->group_by('country_name') 
        ->order_by('jumlah','DESC')
        ->get()
        ->result_array();

        return array(
            'count_courses' => $count_courses,
            'count_post' => $count_post,
            'count_pages' => $count_pages,
            'count_user' => $count_user,
            'total_visitor' => $total_visitor,
            'hits_today' => $hits_today,            
            'statistic_chart_js' => true,
            'statistic_chart_js_label' => !empty($label_visitor) ? json_encode($label_visitor) : '0',
            'statistic_chart_js_data' => !empty($data_visitor) ? json_encode($data_visitor) : '0',
            'statistic_month' => date('d F Y'),
            'statistic_percent' => !empty($from_end_to_prev_pecent) ? $from_end_to_prev_pecent : '0',
            'statistic_percent_status' => $from_end_to_prev_pecent_status,
            'page_view_today' => $page_view_today,
            'page_view_yesterday' => $page_view_yesterday,
            'page_view_last_month' => $page_view_last_month,
            'page_view_all_time' => $page_view_all_time,
            'page_view_by_browser_data' => $page_view_by_browser_data,
            'page_view_by_os_data' => $page_view_by_os_data,
            'page_view_country' => !empty($all_country) ? json_encode($all_country) : '[]',
            'page_view_country_table' => $page_view_country_table,
            );

    }

}
