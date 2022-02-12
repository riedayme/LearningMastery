<?php  
$my_pagination['full_tag_open']    = '<div class="pagging"><nav><ul class="pagination">';
$my_pagination['attributes'] = array('class' => 'page-link');
$my_pagination['full_tag_close']   = '</ul></nav></div>';

$my_pagination['num_tag_open']     = '<li class="page-item">';
$my_pagination['num_tag_close']    = '</li>';

$my_pagination['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
$my_pagination['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';

$my_pagination['next_tag_open']    = '<li class="page-item">';
$my_pagination['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';

$my_pagination['prev_tag_open']    = '<li class="page-item">';
$my_pagination['prev_tagl_close']  = 'Next</li>';

$my_pagination['first_tag_open']   = '<li class="page-item">';
$my_pagination['first_tagl_close'] = '</li>';

$my_pagination['last_tag_open']    = '<li class="page-item">';
$my_pagination['last_tagl_close']  = '</li>';

$this->pagination->initialize(array_merge($blog_post['pagination'],$my_pagination));
?>

<?php echo $this->pagination->create_links(); ?>