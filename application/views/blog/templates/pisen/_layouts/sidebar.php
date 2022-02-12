<div class="col-12 col-lg-4">
    <div class="blog-detail_sidebar">

        <!--  search -->
        <div class="blog-sidebar_block sidebar-search">
            <form action="<?php echo base_url('blog-search') ?>" method="GET">
                <input class="input-form" type="text" name="q" placeholder="<?php echo $this->lang->line('search') ?>">
            </form>
        </div>

        <?php if ($widget['ads_sidebar']['status'] == 'active'): ?>
            <?php echo html_entity_decode($widget['ads_sidebar']['content']); ?>
        <?php endif ?>

        <?php if ($widget['popular_post']): ?>
            <!--  recent post -->
            <div class="blog-sidebar_block sidebar-recent-posts">
                <h5 class="sidebar-block-title"><?php echo $widget['popular_post']['title'] ?></h5>
                <div class="posts">
                    <div class="row">

                        <?php foreach ($widget['popular_post']['content'] as $post): ?>                        
                            <div class="col-12 col-sm-6 col-lg-12">
                                <div class="post-mini_block">
                                    <?php if ($post['image']['thumbnail']): 
                                    //?>
                                    <a style="margin-right: 30px" title="<?php echo $post['title'] ?>" href="<?php echo $post['url'] ?>">
                                        <img src="<?php echo $post['image']['thumbnail']; ?>" alt="<?php echo $post['title']; ?>">
                                    </a>
                                    <?php else: ?>                                  
                                        <a style="margin-right: 30px" title="<?php echo $post['title'] ?>" href="<?php echo $post['url'] ?>">
                                            <img src="<?php echo $post['image']['no_image']; ?>" alt="<?php echo $post['title']; ?>">
                                        </a>
                                    <?php endif ?>
                                    <div class="post-detail">
                                        <a class="post-title title-small" href="<?php echo $post['url'] ?>">
                                            <?php echo $post['title'] ?>
                                        </a>
                                        <div class="post-credit">
                                            <div class="author">
                                                <h5 class="author-name">
                                                    <i class="fa fa-eye"></i>&nbsp;
                                                    <?php echo $post['views'] ?>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>

                    </div>
                </div>
            </div>
        <?php endif ?>

        <?php if ($widget['category_sidebar']['status'] == 'active'): ?>
            <!--  category -->
            <div class="blog-sidebar_block sidebar-categories">
                <h5 class="sidebar-block-title"><?php echo $widget['category_sidebar']['title'] ?></h5>
                <ul>
                    <li>
                        <?php foreach ($widget['category_sidebar']['content'] as $category): ?>                    
                            <a class="category-link" href="<?php echo $category['url'] ?>"><?php echo ucwords($category['title']) ?></a>
                        <?php endforeach ?>
                    </li>
                </ul>
            </div>        
        <?php endif ?>

        <?php if ($widget['tags_sidebar']['status'] == 'active'): ?>
            <!-- tags -->    
            <div class="blog-sidebar_block sidebar-tags">
                <h5 class="sidebar-block-title"><?php echo $widget['tags_sidebar']['title'] ?></h5>
                <?php foreach ($widget['tags_sidebar']['content'] as $tag): ?>              
                    <a href="<?php echo $tag['url'] ?>"><?php echo ucwords($tag['title']) ?></a>
                <?php endforeach ?>
            </div>
        <?php endif ?>

    </div>
</div>
