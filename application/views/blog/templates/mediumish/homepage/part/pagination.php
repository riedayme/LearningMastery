<?php  
$my_pagination['full_tag_open']    = '<div class="bottompagination"><span class="navigation"><ul id="pagination">';
$my_pagination['full_tag_close']   = '</ul></span></div>';

$my_pagination['num_tag_open']     = '<li class="displaypageNum">';
$my_pagination['num_tag_close']    = '</li>';

$my_pagination['cur_tag_open']     = '<li class="pagecurrent active">';
$my_pagination['cur_tag_close']    = '</li>';

$my_pagination['next_tag_open']    = '<li class="displaypageNum lastpage">';
$my_pagination['next_tagl_close']  = '<span aria-hidden="true">»</span></li>';

$my_pagination['prev_tag_open']    = '<li class="displaypageNum firstpage">';
$my_pagination['prev_tagl_close']  = 'Next</li>';

$my_pagination['first_tag_open']   = '<li class="displaypageNum">';
$my_pagination['first_tagl_close'] = '</li>';

$my_pagination['last_tag_open']    = '<li class="displaypageNum">';
$my_pagination['last_tagl_close']  = '</li>';

$this->pagination->initialize(array_merge($blog_post['pagination'],$my_pagination));
?>

<?php echo $this->pagination->create_links(); ?>