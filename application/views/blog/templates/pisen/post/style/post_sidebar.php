<section class="blog-detail posts blog-creative blog-crypto blog-agency blog-detail-sidebar blog-news">
    <div class="container">
        <div class="row">

            <div class="col-12 col-lg-8">
                <div class="post-header">
                    <div class="posts blog-index">
                        <div class="post-block post-classic">
                            <?php if (!empty($post['image']['original'])): ?>                            
                                <div class="post-img">
                                    <img src="<?php echo $post['image']['original'] ?>" title="<?php echo $post['title'] ?>" alt="<?php echo $post['title'] ?>">
                                </div>
                            <?php endif ?>
                            <div class="post-detail">
                                <h1 class="post-title regular">
                                    <?php echo $post['title'] ?>
                                </h1>
                                <div class="post-credit">
                                    <div class="author">                                        
                                        <h5 class="author-name">
                                            <i class="fa fa-eye"></i>&nbsp;
                                            <?php echo $post['views'] ?>                                    
                                        </h5>
                                    </div>
                                    <h5 class="upload-day">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <?php echo $post['time'] ?>                                        
                                    </h5>
                                    <div class="post-tag">
                                        <?php if ($post['category']): ?>                                            
                                            <a title="<?php echo $post['category']['name'] ?>"
                                                href="<?php echo $post['category']['url'] ?>">
                                                <?php echo $post['category']['name'] ?>
                                            </a>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $this->load->view('blog/templates/pisen/post/part/ads_content_top');?>

                <div class="post-block">
                    <?php echo $post['content']; ?>
                </div>

                <?php $this->load->view('blog/templates/pisen/post/part/ads_content_bottom');?>

                <div class="post-footer">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php $this->load->view('blog/templates/pisen/post/part/post_tags');?>
                        </div>
                        <div class="col-sm-6 text-sm-right">
                            <?php $this->load->view('blog/templates/pisen/post/part/post_share');?>
                        </div>
                    </div>
                </div>                

                <?php $this->load->view('blog/templates/pisen/post/part/post_pagination');?>
                <?php $this->load->view('blog/templates/pisen/post/part/post_related');?>                
                <?php $this->load->view('blog/templates/pisen/post/part/comment');?>   
            </div>

            <?php $this->load->view('blog/templates/pisen/_layouts/sidebar');?>

            <!-- row close -->
        </div>
    </div>
</section>
