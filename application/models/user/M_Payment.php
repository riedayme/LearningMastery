<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class M_Payment extends CI_Model
{

    public $table_user = 'tb_user';

    public $table_lms_courses = 'tb_lms_courses';

    public $table_lms_user_courses = 'tb_lms_user_courses';
    public $table_lms_user_payment = 'tb_lms_user_payment'; 

    public function read($site,$slug){

        /**
         * read courses data
         */
        $this->db->select('
            tb_lms_courses.*
            ');
        $this->db->from($this->table_lms_courses);		
        $this->db->where('tb_lms_courses.permalink',$slug);
        $this->db->where('tb_lms_courses.price != 0');
        $this->db->where("time <= NOW()");
        $this->db->where("status = 'Published'"); 				
        $courses_detail =$this->db->get();

        if ($courses_detail->num_rows() < 1) redirect(base_url());

        $read_courses =  $courses_detail->row_array();	

        $check_user_courses = $this->_Process_MYSQL->get_data($this->table_lms_user_courses,[
            'id_courses' => $read_courses['id'],
            'id_user' => $this->session->userdata('id_user'),
        ])->num_rows();

        if ($check_user_courses > 0) redirect(base_url());

        $all_courses = $this->_Courses->read_long_single($site,$read_courses);

        /**
         * read lesson data
         */
        $lesson = $this->_Lesson->build_lesson($all_courses);

        foreach ($lesson['all_data'] as $all_lesson) {
            foreach ($all_lesson['lesson'] as $detail_lesson) {
                $id_lesson[] = $detail_lesson['id'];  
                $type_lesson[] = $detail_lesson['type'];
            }
        }

        $lesson['total_lesson'] = count($id_lesson);
        $lesson['count_type_lesson'] = array_count_values($type_lesson);

        /**
         * read user payment
         */
        if ($site['payment_method'] == 'Manual') {
            $user_payment['payment'] = json_decode($this->_Process_MYSQL->get_data($this->table_user,[
                'id' => $read_courses['id_user']
            ])->row()->payment,true);

            $all_data = array_merge($all_courses,$lesson,$user_payment);
        }elseif ($site['payment_method'] == 'Midtrans') {
            $midtrans['payment'] = $this->M_Payment_Midtrans->create_token($all_courses);
            $all_data = array_merge($all_courses,$lesson,$midtrans);
        }
        
        return $all_data;
    }

    public function insert_purchased_courses($id_order){

        $read_payment = $this->_Process_MYSQL->get_data($this->table_lms_user_payment,['id' => $id_order])->row_array();

        $post_data = [
            'id_user' => $read_payment['id_user'],
            'id_courses' => $read_payment['id_courses'],
        ];
        $post_data['time'] = date('Y:m:d H:i:s');

        /** update other order courses set to failed */
        $this->_Process_MYSQL->update_data($this->table_lms_user_payment,['status' => 'Failed'],[
            'id !=' => $id_order,
            'id_user' => $read_payment['id_user'],
            'id_courses' => $read_payment['id_courses']
        ]);

        return $this->_Process_MYSQL->insert_data($this->table_lms_user_courses, $post_data);
    }

    public function delete_purchased_courses($id_order){

        $read_payment = $this->_Process_MYSQL->get_data($this->table_lms_user_payment,['id' => $id_order])->row_array();

        $post_data = [
            'id_user' => $read_payment['id_user'],
            'id_courses' => $read_payment['id_courses'],
        ];

        return $this->_Process_MYSQL->delete_data($this->table_lms_user_courses, $post_data);
    }     	
}