<?php if (!empty($courses['related_courses'])): ?>
    <div class="container u-ph-small">
        <div class="row u-mt-small u-p-zero u-flex u-justify-center">

            <div class="col-12">
                <h3 class="u-mb-small u-text-center">                   
                    <?php echo $this->lang->line('related_courses') ?>
                </h3>
            </div>

            <?php foreach ($courses['related_courses'] as $post): ?>
                <div class="col-sm-12 col-lg-4">

                    <article class="c-event u-p-zero">
                        <div class="c-event__img u-m-zero" data-mh="imaged" style="min-height: 270px">
                            <a title="<?php echo $post['title'] ?>" class="u-color-primary" href="<?php echo $post['url'] ?>">
                                <img width="100%" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo $post['image']['thumbnail'] ?>" alt="<?php echo $post['title'] ?>">
                            </a>
                            
                            <span class="c-event__status u-bg-secondary u-color-primary">
                                <?php if ($post['sub_category']['icon']): ?>
                                    <i class="fa <?php echo $post['sub_category']['icon'] ?>"></i>
                                <?php endif ?>
                                <?php if (empty($post['sub_category']['icon'])): ?>
                                    <i class="fa fa-folder"></i>
                                <?php endif ?>
                                <a class='u-text-dark' href="<?php echo $post['sub_category']['url'] ?>" title="<?php echo $post['sub_category']['name'] ?>">
                                    <?php echo $post['sub_category']['name'] ?>
                                </a>
                            </span>
                        </div>
                        <div class="c-event__meta u-ph-small" data-mh="heading">
                            <a title="<?php echo $post['title'] ?>" class="u-color-primary u-h4 u-text-bold" href="<?php echo $post['url'] ?>">
                                <?php echo $post['title'] ?>
                            </a>
                        </div>
                        <div class="c-event__meta u-ph-small u-pt-xsmall u-border-top">
                            <div class="o-media">
                                <div class="o-media__img u-mr-xsmall">
                                    <div class="c-avatar c-avatar--xsmall">
                                        <img class="c-avatar__img" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo $post['author']['photo'] ?>" alt="<?php echo $post['author']['name'] ?>">
                                    </div>
                                </div>
                                <div class="o-media__body">
                                    <?php echo $post['author']['name'] ?>
                                    <small class="u-block u-text-mute">
                                        <?php echo $post['author']['headline'] ?>
                                    </small>
                                </div>
                            </div>
                            <div class="u-ml-auto">
                                <div class='rating-stars u-flex u-justify-between u-pt-xsmall'>
                                    <ul>
                                        <?php  
                                        for ($i=0; $i < 5 ; $i++) { 

                                            if ($i < $post['rating']) {
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

                        <div class="c-event__meta u-ph-small u-pt-xsmall u-border-top">
                            <span class="cursor-default c-btn c-event__btn c-btn--custom u-bg-secondary u-color-primary u-border-zero"><i class="fa fa-eye u-mr-xsmall"></i><?php echo $post['views'] ?></span>          
                            <?php if (empty($post['price'])): ?>
                                <span class="cursor-default c-btn c-event__btn c-btn--custom u-bg-secondary u-color-primary u-border-zero">
                                    <i class="fa fa-shopping-cart u-mr-xsmall"></i>
                                    <?php echo $this->lang->line('free') ?>
                                </span>
                            <?php endif ?>

                            <?php if (!empty($post['price'])): ?>
                                <span class="cursor-default c-btn c-event__btn c-btn--custom u-bg-info u-text-small">
                                    <?php if (!empty($post['discount'])): ?>
                                        <s class="u-text-xsmall u-mr-xsmall"><?php echo $post['price'] ?></s>
                                        <?php echo $post['price_total'] ?>
                                    <?php endif ?>
                                    <?php if (empty($post['discount'])): ?>
                                        <?php echo $post['price_total'] ?>
                                    <?php endif ?>
                                </span>
                            <?php endif ?>
                            
                        </div>                              
                    </article>

                </div>
            <?php endforeach ?>

        </div>
    </div>
<?php endif ?>