<?php  
function countcomment($data){
    if (!empty($data)) {
        $data = explode(',', $data);
        return count($data);
    }else {
        return "0";
    }
}

function formatstatus($time,$status){
    $post_time = date("YmdHis",strtotime($time));
    $time_now = date("YmdHis");
    if ($status == 'Draft') {
        return '<span class="u-mr-xsmall c-badge c-badge--xsmall c-badge--warning"><i class="fa fa-sticky-note-o u-color-primary"></i> Draft</span>';
    }else {        
        if ($post_time >= $time_now) {
            return '<span class="u-mr-xsmall c-badge c-badge--xsmall c-badge--info"><i class="fa fa-sticky-note-o u-color-primary"></i> Scheduled</span>';
        }elseif ($post_time <= $time_now) {
            //return '<span class="c-badge c-badge--xsmall c-badge--success"><i class="fa fa-sticky-note-o u-color-primary"></i> Published</span>';
        }else {
            return 'Something Error...';
        }
    }
}

function statuscomment($status){
    if ($status == 'Approved') {
        return "<span class='c-badge c-badge--xsmall c-badge--success'>Approved</span>";
    }elseif ($status == 'Blocked') {
        return "<span class='c-badge c-badge--xsmall c-badge--danger'>Blocked</span>";
    }elseif ($status == 'Pending') {
        return "<span class='c-badge c-badge--xsmall c-badge--warning'>Pending</span>";
    }
}

function photo_user($data){
    if (empty($data)) {
        return '<img class="c-avatar__img" src="'.base_url('storage/uploads/user/photo/default.png').'" alt="'.$data.'">';
    }else {
        return '<img class="c-avatar__img" src="'.base_url('storage/uploads/user/photo/'.$data).'" alt="'.$data.'">';
    }
}

function grade_user($grade){
    if ($grade == 'App') {
        return "<span class='u-ml-xsmall c-badge c-badge--xsmall c-badge--primary'>App</span>";
    }elseif ($grade == 'User') {
        return "<span class='u-ml-xsmall c-badge c-badge--xsmall c-badge--info'>User</span>";
    }elseif ($grade == 'Instructor') {
        return "<span class='u-ml-xsmall c-badge c-badge--xsmall c-badge--success'>Instructor</span>";
    }
}

function set_currency($data) {
    if ($data) {
       return number_format($data, 0, ',', '.');
   }else{
    return 0;
   }
}