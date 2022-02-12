<style>#main{padding-top:105px}</style>
<section class="blog-detail blog-detail-02">
    <div class="full-fluid">
        <div class="blog-detail_banner" style="background: #123 url(<?php echo $post['image']['original'] ?>);background-size:cover; background-attachment: fixed; background-blend-mode: overlay; background-repeat: no-repeat; background-position: center center;">
            <h1 class="blog-detail-title"><?php echo $post['title'] ?></h1>
            <div class="blog-credit">
                <div class="blog-credit_wrapper">
                    <p> 
                        <i class="fa fa-calendar"></i><?php echo $post['time'] ?>             
                    </p>
                    <h5>
                        <i class="fa fa-eye"></i>&nbsp;
                        <?php echo $post['views'] ?>    
                    </h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">

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
        </div>
    </div>
</section>
