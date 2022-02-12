<div class="another-posts">
    <div class="row no-gutters">
        <div class="col-12 col-md-6">
            <?php if ($post['prev_post']['title']): ?>
                <div class="another-post_block prev-post">
                    <div class="post-mini-img text-left">
                        <a title="<?php echo $post['prev_post']['title']; ?>" href="<?php echo $post['prev_post']['url'] ?>">
                            <?php if ($post['prev_post']['image']['thumbnail']): 
                            //?>   
                            <img src="<?php echo $post['prev_post']['image']['thumbnail']; ?>" alt="<?php echo $post['prev_post']['title']; ?>">                        
                            <?php else : ?>
                               <img src="<?php echo $post['prev_post']['image']['no_image']; ?>" alt="<?php echo $post['prev_post']['title']; ?>">        
                           <?php endif ?>
                       </a>
                   </div>
                   <div class="post-title">
                    <p>Previous post</p>
                    <a title="<?php echo $post['prev_post']['title']; ?>" href="<?php echo $post['prev_post']['url'] ?>"><?php echo $post['prev_post']['title'] ?></a>
                </div>
            </div>
        <?php endif ?>
    </div>
    <div class="col-12 col-md-6">
        <?php if ($post['next_post']['title']): ?>
            <div class="another-post_block text-right next-post">
                <div class="post-title">
                    <p>Next post</p>
                    <a title="<?php echo $post['next_post']['title']; ?>" href="<?php echo $post['next_post']['url'] ?>"><?php echo $post['next_post']['title'] ?></a>
                </div>
                <div class="post-mini-img text-right">
                    <a title="<?php echo $post['next_post']['title']; ?>" href="<?php echo $post['next_post']['url'] ?>">
                        <?php if ($post['next_post']['image']['thumbnail']): 
                        //?>   
                        <img src="<?php echo $post['next_post']['image']['thumbnail']; ?>" alt="<?php echo $post['next_post']['title']; ?>">                        
                        <?php else : ?>
                           <img src="<?php echo $post['next_post']['image']['no_image']; ?>" alt="<?php echo $post['next_post']['title']; ?>">        
                       <?php endif ?>                        
                   </a>
               </div>
           </div>
       <?php endif ?>
   </div>
</div>
</div>
