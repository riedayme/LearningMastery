<section class="posts blog-index">
    <div class="container">
        <div class="row justify-content-center">

            <h3 class="blog-detail-title col-12 text-center mb-5"><?php echo $site['sub_title'] ?></h3>

            <?php foreach ($blog_post['data'] as $post): ?>

                <div class="col-12 col-md-10">
                    <div class="post-block post-classic">
                        <?php if ($post['image']['original']): 
                        //?>
                        <a title="<?php echo $post['title']; ?>" href="<?php echo $post['url'] ?>">
                            <div class="post-img">
                                <img
                                src="<?php echo $post['image']['thumbnail'] ?>"
                                title="<?php echo $post['title'] ?>" alt="<?php echo $post['title'] ?>" />
                            </div>
                        </a>
                        <?php else : ?>
                            <a title="<?php echo $post['title']; ?>" href="<?php echo $post['url'] ?>">
                                <div class="post-img">
                                    <img
                                    src="<?php echo $post['image']['no_image'] ?>"
                                    title="<?php echo $post['title'] ?>" alt="<?php echo $post['title'] ?>" />
                                </div>
                            </a>                            
                        <?php endif ?>  
                        <div class="row">
                            <div class="col-12 col-md-10 mx-auto">
                                <div class="post-detail">

                                    <a title="<?php echo $post['title']; ?>" class="post-title" href="<?php echo $post['url'] ?>">
                                        <?php echo $post['title'] ?>
                                    </a>

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

                                    <p class="post-describe"><?php echo $post['content'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach;?>

            <div class="col-12 text-center justify-content-center">
                <?php $this->load->view('blog/templates/pisen/homepage/part/pagination');?>
            </div>

        </div>
    </div>
</section>