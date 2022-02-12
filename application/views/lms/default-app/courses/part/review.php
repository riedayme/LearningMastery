<div class="container u-ph-small">
    <div class="row u-mv-small u-p-zero">
        <div class="col-12 col-xl-10 offset-xl-1 col-lg-8 offset-lg-2">

            <div class="c-card u-p-medium">  
                <h3 class="u-mb-small">                   
                    <?php echo $this->lang->line('review') ?>
                </h3>        

                <?php if (empty($courses['rating'])): ?>        
                    <div class="c-alert u-bg-secondary u-text-dark">
                        <?php echo $this->lang->line('no_review') ?>
                    </div>                               
                <?php endif ?>

                <?php if (!empty($courses['rating'])): ?>        
                    <div class="row">

                        <div class="col-12 col-xl-4 u-mb-medium">
                            <div class="c-card u-p-medium u-text-center" data-mh="state-review">  
                                <p class="u-h3 u-text-bold">
                                    <?php echo $courses['review_pagination']['total_rows'] ?>
                                </p>
                                <p class="u-text-dark">
                                    <?php echo $this->lang->line('gived_review') ?>                                    
                                </p>
                                <div class='rating-stars'>
                                    <ul>
                                        <?php  
                                        for ($i=0; $i < 5 ; $i++) { 

                                            if ($i < $courses['rating']) {
                                                echo "
                                                <li class='star selected'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>";
                                            }else{
                                                echo "
                                                <li class='star'>
                                                    <i class='fa fa-star fa-fw'></i>
                                                </li>";
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-8 u-mb-medium" data-mh="state-review">
                            <p class="u-text-bold u-h5">
                                 <?php echo $this->lang->line('detail_review') ?> :
                            </p>
                            <?php foreach ($courses['review_stats'] as $key => $review_stats): ?>
                                <div class="stars-1 row">
                                    <div class="col-7 u-pt-xsmall">                                    
                                        <div class="c-progress c-progress--small c-progress--info">
                                            <div class="c-progress__bar" style="width:<?php echo $courses['review_stats'][$key]['percent'] ?>;"></div>
                                        </div>
                                    </div>
                                    <div class="col-3">          

                                        <div class='rating-stars'>
                                            <ul class="u-flex">
                                                <?php  
                                                for ($i=0; $i < 5 ; $i++) { 

                                                    if ($i < $courses['review_stats'][$key]['star']) {
                                                        echo "
                                                        <li class='star selected'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>";
                                                    }else{
                                                        echo "
                                                        <li class='star'>
                                                            <i class='fa fa-star fa-fw'></i>
                                                        </li>";
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-2 u-pl-small">
                                        <span class="u-text-mute u-ml-auto">
                                            <?php echo $courses['review_stats'][$key]['count'] ?>
                                        </span>
                                    </div>
                                </div>                                                                                                              
                            <?php endforeach ?>
                        </div>

                        <div class="col-12">
                            <div class="review-content">
                                <?php foreach ($courses['review'] as $review): ?>

                                    <!--  -->
                                    <div class="c-card u-mb-small">
                                        <div class="o-media u-justify-start u-ph-medium u-pv-small u-border-bottom">
                                            <div class="o-line">
                                                <div class="o-media__img u-mr-xsmall">
                                                    <div class="c-avatar c-avatar--xsmall">
                                                        <img class="c-avatar__img" src="<?php echo $review['photo'] ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="o-media__body">
                                                    <?php echo $review['name'] ?>
                                                    <small class="u-block u-text-mute">
                                                        <?php echo $review['time'] ?>
                                                    </small>
                                                </div>
                                                <div class="u-ml-auto">                       
                                                    <div class='rating-stars'>
                                                        <ul>
                                                            <?php  
                                                            for ($i=0; $i < 5 ; $i++) { 

                                                                if ($i < $review['rating']) {
                                                                    echo "
                                                                    <li class='star selected'>
                                                                        <i class='fa fa-star fa-fw'></i>
                                                                    </li>";
                                                                }else{
                                                                    echo "
                                                                    <li class='star'>
                                                                        <i class='fa fa-star fa-fw'></i>
                                                                    </li>";
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>         
                                                </div>
                                            </div>
                                        </div>
                                        <div class="u-ph-medium u-pv-small">
                                            <?php echo $review['message'] ?>
                                        </div>
                                    </div>
                                    <!--  -->
                                <?php endforeach ?>

                            </div>
                            <div class="u-text-center">

                                <?php if ($courses['review_pagination']['total_rows'] > $courses['review_pagination']['per_page']): ?>                                   
                                    <div class="u-hidden">
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

                                        $this->pagination->initialize(array_merge($courses['review_pagination'],$my_pagination));
                                        ?>

                                        <?php echo $this->pagination->create_links(); ?>
                                    </div>

                                    <button data-text='Muat Lainnya' class="c-btn c-btn--primary c-btn--custom btn-review-pagination" type="button">
                                         <?php echo $this->lang->line('load_more') ?>
                                    </button>
                                <?php endif ?>
                            </div>
                        </div>

                    </div>
                <?php endif ?>

            </div>

        </div>
    </div>
</div>