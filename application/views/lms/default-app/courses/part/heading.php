<div>
    <div class="container">                   
        <div class="row">

            <div class="col-12 col-xl-10 offset-xl-1 col-lg-8 offset-lg-2">    

                <div class="row u-pv-medium">
                    <div class="col-lg-9">
                        <h1 class="u-h3 u-text-bold">
                            <?php echo $courses['title'] ?>
                        </h1>   


                        <div class="row u-mb-small">

                            <div class="col-12 col-lg-4">
                                <div class="c-state-card u-m-zero u-p-small" data-mh="state-cards" style="height: 62px;">

                                    <?php if ($courses['user_courses']): ?>
                                        <div class="c-state-card__icon c-state-card__icon--info u-bg-info" style="width: 30px;height: 30px;">
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <div class="c-state-card__content">
                                            <?php echo $this->lang->line('hasben_owned') ?>
                                        </div>
                                    <?php endif ?>
                                    <?php if (empty($courses['user_courses'])): ?>

                                        <?php if (empty($courses['price'])): ?>

                                            <div class="c-state-card__icon c-state-card__icon--info u-bg-primary" style="width: 30px;height: 30px;">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                            <div class="c-state-card__content">
                                                <?php echo $this->lang->line('free') ?>
                                            </div>
                                        <?php endif ?>
                                        <?php if (!empty($courses['price'])): ?>
                                            <div class="c-state-card__icon c-state-card__icon--info u-bg-success" style="width: 30px;height: 30px;">
                                                <i class="fa fa-shopping-cart"></i>
                                            </div>
                                            <div class="c-state-card__content">
                                                <?php if (!empty($courses['discount'])): ?>
                                                    <s class="u-text-xsmall u-block"><?php echo $courses['price'] ?></s>
                                                    <?php echo $courses['price_total'] ?>
                                                <?php endif ?>
                                                <?php if (empty($courses['discount'])): ?>
                                                 <?php echo $courses['price_total'] ?>
                                             <?php endif ?>
                                         </div>
                                     <?php endif ?>
                                 <?php endif ?>
                             </div>
                         </div>

                         <div class="col-12 col-lg-4">
                            <div class="c-state-card u-m-zero u-p-small" data-mh="state-cards" style="height: 62px;">
                                <div class="c-state-card__icon c-state-card__icon--info" style="width: 30px;height: 30px;">
                                    <i class="fa fa-eye"></i>
                                </div>
                                <div class="c-state-card__content">                                     
                                    <?php echo $courses['views'] ?>                                       
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="c-state-card u-m-zero u-p-small" data-mh="state-cards" style="height: 62px;">
                                <div class="c-state-card__icon c-state-card__icon--info" style="width: 30px;height: 30px;">
                                    <?php if ($courses['sub_category']['icon']): ?>
                                        <i class="fa <?php echo $courses['sub_category']['icon'] ?>"></i>
                                    <?php endif ?>
                                    <?php if (empty($courses['sub_category']['icon'])): ?>
                                        <i class="fa fa-folder"></i>
                                    <?php endif ?>
                                </div>
                                <div class="c-state-card__content">
                                    <a class='u-text-dark' href="<?php echo $courses['sub_category']['url'] ?>" title="<?php echo $courses['sub_category']['name'] ?>">
                                        <?php echo $courses['sub_category']['name'] ?>
                                    </a>
                                </div>
                            </div>
                        </div>                            

                    </div>

                    <?php if ($this->session->userdata('user')): ?>                           

                        <?php if (!empty($courses['first_lesson'])): ?>

                            <?php if ($courses['user_courses']): ?>
                                <a class="c-btn c-btn--info c-btn--custom" href="<?php echo $courses['first_lesson'] ?>">
                                    <i class="fa fa-send-o u-mr-xsmall"></i><?php echo $this->lang->line('learn_now') ?>
                                </a>
                            <?php endif ?>

                            <?php if (empty($courses['user_courses'])): ?>

                                <?php if (empty($courses['price'])): ?>
                                    <button data-redirect='<?php echo current_url() ?>' data-id='<?php echo base64_encode($courses['id']) ?>' class="c-btn c-btn--info c-btn--custom btn-process-courses" data-action="<?php echo base_url('user/courses/add_courses/') ?>">
                                        <i class="fa fa-plus u-mr-xsmall"></i><?php echo $this->lang->line('add_to_my_courses') ?>
                                    </button >
                                <?php endif ?>
                                <?php if (!empty($courses['price'])): ?>
                                    <a class="c-btn c-btn--success c-btn--custom" href='<?php echo base_url('payment/order/'.$courses['slug']) ?>'>
                                        <i class="fa fa-shopping-cart u-mr-xsmall"></i><?php echo $this->lang->line('buy') ?>
                                    </a >

                                    <?php if (empty($courses['user_wishlist'])): ?>
                                        <button data-id='<?php echo base64_encode($courses['id']) ?>' class="c-btn c-btn--secondary c-btn--custom btn-process-wishlist c-tooltip c-tooltip--top" data-action="<?php echo base_url('user/wishlist/process/') ?>" aria-label="<?php echo $this->lang->line('wishlist') ?>" style='overflow: unset;'>
                                            <i class="fa fa-heart-o"></i>
                                        </button >
                                    <?php endif ?>
                                    <?php if (!empty($courses['user_wishlist'])): ?>
                                        <button data-id='<?php echo base64_encode($courses['id']) ?>' class="c-btn c-btn--secondary c-btn--custom btn-process-wishlist c-tooltip c-tooltip--top" data-action="<?php echo base_url('user/wishlist/process/') ?>" aria-label="<?php echo $this->lang->line('wishlist') ?>" style='overflow: unset;'>
                                            <i class="fa fa-heart u-text-danger"></i>
                                        </button >
                                    <?php endif ?>
                                    
                                <?php endif ?>

                            <?php endif ?>
                        <?php endif ?>

                        <?php if (empty($courses['first_lesson'])): ?>
                            <button class="c-btn c-btn--custom" disabled="">
                                <i class="fa fa-send-o u-mr-xsmall"></i><?php echo $this->lang->line('no_lesson') ?>
                            </button>
                        <?php endif ?>

                    <?php endif ?>

                    <?php if (empty($this->session->userdata('user'))): ?>

                        <?php if (!empty($courses['first_lesson'])): ?>  

                            <?php if (empty($courses['price'])): ?>
                                <?php if ($site['lms_free_courses_readable'] == 'Yes'): ?>
                                    <a class="c-btn c-btn--info c-btn--custom" href="<?php echo $courses['first_lesson'] ?>">
                                        <i class="fa fa-send-o u-mr-xsmall"></i><?php echo $this->lang->line('learn_now') ?>
                                    </a>
                                <?php endif ?>
                                <?php if ($site['lms_free_courses_readable'] == 'No'): ?>
                                    <a class="c-btn c-btn--info c-btn--custom" href="<?php echo base_url('auth?redirect='.urlencode($courses['url'])) ?>"> 
                                        <i class="fa fa-send-o u-mr-xsmall"></i><?php echo $this->lang->line('learn_now') ?>
                                    </a>
                                <?php endif ?>
                            <?php endif ?>
                            <?php if (!empty($courses['price'])): ?>
                                <a class="c-btn c-btn--success c-btn--custom" href="<?php echo base_url('auth?redirect='.urlencode(base_url('payment/order/'.$courses['slug']))) ?>">
                                    <i class="fa fa-shopping-cart u-mr-xsmall"></i><?php echo $this->lang->line('buy') ?>
                                </a>
                            <?php endif ?>      
                        <?php endif ?>

                        <?php if (empty($courses['first_lesson'])): ?>
                            <button class="c-btn c-btn--custom" disabled="">
                                <i class="fa fa-send-o u-mr-xsmall"></i><?php echo $this->lang->line('no_lesson') ?>
                            </button>
                        <?php endif ?>

                    <?php endif ?>

                </div>
                <div class="col-lg-3 u-hidden-down@desktop">
                    <img style="width: 100%" src="<?php echo $courses['image']['original'] ?>" alt="<?php echo $courses['title'] ?>">   
                </div>
            </div>

        </div>

    </div>
</div>
</div>