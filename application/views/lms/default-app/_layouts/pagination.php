<?php  
$my_pagination['full_tag_open']    = '<nav class="c-pagination u-justify-right u-mv-medium u-mb-zero"> <ul class="c-pagination__list">';
$my_pagination['attributes'] = array('class' => 'c-pagination__link');
$my_pagination['full_tag_close']   = '</ul> </nav>';

$my_pagination['num_tag_open']     = '<li class="c-pagination__item">';
$my_pagination['num_tag_close']    = '</li>';

$my_pagination['cur_tag_open']     = '<li class="c-pagination__item"><span class="is-active c-pagination__link">';
$my_pagination['cur_tag_close']    = '</span></li>';

$my_pagination['next_tag_open']    = '<li class="c-pagination__item news">';
$my_pagination['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></li>';

$my_pagination['prev_tag_open']    = '<li class="c-pagination__item">';
$my_pagination['prev_tagl_close']  = 'Next</li>';

$my_pagination['first_tag_open']   = '<li class="c-pagination__item">';
$my_pagination['first_tagl_close'] = '</li>';

$my_pagination['last_tag_open']    = '<li class="c-pagination__item">';
$my_pagination['last_tagl_close']  = '</li>';

$this->pagination->initialize(array_merge($courses['pagination'],$my_pagination));
?>

<?php echo $this->pagination->create_links(); ?>