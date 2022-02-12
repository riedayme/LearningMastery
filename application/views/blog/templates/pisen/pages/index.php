<?php $this->load->view('blog/templates/pisen/_layouts/header');?>
<?php $this->load->view('blog/templates/pisen/_layouts/nav');?>
<style>#main{padding-top:105px}</style>
<section class="blog-detail blog-detail-02">
    <div class="full-fluid">
        <div class="blog-detail_banner" style="background: #123 url(''); background-attachment: fixed; background-blend-mode: overlay; background-repeat: no-repeat; background-position: center center;">
            <h1 class="blog-detail-title"><?php echo $post['title'] ?></h1>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="post-block">
                    <?php echo html_entity_decode($post['content']) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $this->load->view('blog/templates/pisen/_layouts/footer-widget');?>
<?php $this->load->view('blog/templates/pisen/_layouts/footer');?>