<?php if ($post['related_post']): ?>
    <div class="row">

        <div class="col-12">
            <h4 class="post-title regular relatedpost-title">                 
                Related Post
            </h4>
        </div>

        <?php foreach ($post['related_post'] as $post): ?>

            <div class="col-6 col-sm-6 col-md-4 col-sm-6">

                <div class="post-block post-classic mini-post-classic post-related">

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

                    <div class="post-detail">
                        <a title="<?php echo $post['title']; ?>" class="post-title small" href="<?php echo $post['url'] ?>"><?php echo $post['title'] ?></a>
                    </div>
                </div>
            </div>

        <?php endforeach ?>

    </div>

<?php endif ?>
