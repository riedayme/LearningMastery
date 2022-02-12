<section class="blog-detail posts blog-creative blog-crypto blog-agency blog-detail-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-8">

                <div class="blog-news_bundle lastest-news-bundle">
                    <h3 class="bundle-title"><?php echo $site['sub_title'] ?></h3>
                    <div class="row">

                        <?php foreach ($blog_post['data'] as $post): ?>

                            <div class="col-12">
                                <div class="post-mini_block">     

                                    <?php if ($post['image']['original']): 
                                    //?>                                        
                                    <a style="margin-right: 30px" title="<?php echo $post['title'] ?>" href="<?php echo $post['url'] ?>">
                                        <img
                                        src="<?php echo $post['image']['original'] ?>"
                                        title="<?php echo $post['title'] ?>" alt="<?php echo $post['title'] ?>" />
                                    </a>
                                    <?php else : ?>
                                        <a style="margin-right: 30px" title="<?php echo $post['title'] ?>" href="<?php echo $post['url'] ?>">
                                            <img
                                            src="<?php echo $post['image']['no_image'] ?>"
                                            title="<?php echo $post['title'] ?>" alt="<?php echo $post['title'] ?>" />
                                        </a>
                                    <?php endif ?>

                                    <!-- start post detail -->
                                    <div class="post-detail">

                                        <!--  -->
                                        <!--  -->
                                        <!--  -->  
                                        <div class="post-credit">
                                            <div class="post-tag">
                                                <?php if ($post['category']): ?>
                                                    <a title="<?php echo $post['category']['name'] ?>"
                                                        href="<?php echo $post['category']['url'] ?>">
                                                        <?php echo $post['category']['name'] ?>
                                                    </a>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <!--  -->
                                        <!--  -->  

                                        <a title="<?php echo $post['title'] ?>" class="post-title" href="<?php echo $post['url'] ?>">
                                            <?php echo $post['title'] ?>
                                        </a>

                                        <p class="post-describe" style="display: none">
                                            <?php echo $post['content'] ?>
                                        </p>


                                        <!--  -->
                                        <!--  -->
                                        <!--  -->                                                                
                                        <div class="post-credit">
                                            <div class="author">
                                                <h5 class="author-name">
                                                    <i class="fa fa-calendar"></i>&nbsp;
                                                    <?php echo $post['time'] ?>&nbsp;&nbsp;
                                                    <i class="fa fa-eye"></i>&nbsp;
                                                    <?php echo $post['views'] ?>
                                                </h5>
                                            </div>
                                        </div>
                                        <!--  -->
                                        <!--  -->
                                        <!--  -->                                               

                                    </div>
                                    <!-- post-detail --> 


                                </div>
                            </div>
                        <?php endforeach;?>

                        <div class="col-12">
                             <?php $this->load->view('blog/templates/pisen/homepage/part/pagination');?>
                        </div>

                    </div>
                </div>
            </div>

            <?php $this->load->view('blog/templates/pisen/_layouts/sidebar');?>

        </div>
    </div>
</section>
<!--End posts-->
