<?php if ($post['comment_post']['type'] == 'disqus'): ?>
	<?php echo $post['comment_post']['data']; ?>
<?php endif ?>

<?php if ($post['comment_post']['type'] == 'system'): ?>

    <div id="post-comment" class="post-comment">

        <h4>
            <?php if (empty($post['comment_post']['data'])): ?>
                Leave a comment
                <?php else: ?>   
                    <?php echo $post['comment_post']['count'] ?> Comments
                <?php endif ?>
            </h4>
            <div class="comment-item mt-4 mb-5">
                <?php  
                if (!empty($post['comment_post']['data'])) {
                    foreach ($post['comment_post']['data'] as $comment) {
                        foreach ($comment as $post_comment) {
	                    //echo $post_comment['id'];
	                    //echo json_encode($post_comment);
                            ?>
                            <div class="wall-comment mb-0 mt-10">
                                <span class="avatar float-left">
                                    <img alt="<?php echo $post_comment['name'] ?>" src="<?php echo base_url('storage/blog/pisen/img/person.png') ?>" title="<?php echo $post_comment['name'] ?>">
                                </span>
                                <div class="ml-50 comment-block" id="comment-<?php echo $post_comment['id'] ?>" <?php echo ($post_comment['status'] == 'Blocked') ? 'style="background: #ffdce1;"' : '' ?>>
                                    <div class="media-body text-middle">
                                        <h4 class="comment-name">
                                            <?php echo $post_comment['name'] ?>
                                        </h4>
                                        <small class="text-muted">
                                            <?php echo $post_comment['date'] ?>
                                        </small>
                                    </div>
                                    <p>
                                        <?php echo $post_comment['content'] ?>
                                    </p>
                                </div>
                                <div class="dropdown comment-operation">
                                    <a class="comment-reply-link badge badge-light" comment-id="comment-<?php echo $post_comment['id'] ?>" data-comment-id="<?php echo $post_comment['id'] ?>"><i class="fa fa-reply"></i></a>
                                </div>
                            </div>  
                            <?php
                            if (!empty($post_comment['child'])) {
                                foreach ($post_comment['child'] as $post_comment_child) {
                            	//echo json_encode($post_comment_child);
                                    ?>
                                    <div class="wall-comment ml-50 mt-10">
                                        <span class="avatar float-left">
                                            <img alt="<?php echo $post_comment_child['name'] ?>" src="<?php echo base_url('storage/blog/pisen/img/person.png') ?>" title="<?php echo $post_comment_child['name'] ?>">
                                        </span>
                                        <div class="ml-50 comment-block" id="comment-<?php echo $post_comment_child['id'] ?>" <?php echo ($post_comment_child['status'] == 'Blocked') ? 'style="background: #ffdce1;"' : '' ?>>
                                            <div class="media-body text-middle">
                                                <h4 class="comment-name">
                                                    <?php echo $post_comment_child['name'] ?>
                                                </h4>
                                                <small class="text-muted">
                                                    <?php echo $post_comment_child['date'] ?>
                                                </small>
                                            </div>
                                            <p>
                                                <?php echo $post_comment_child['content'] ?>
                                            </p>
                                        </div>
                                    </div>  
                                    <?php
                                }
                            }
                        }
                    }
                }
                ?>
            </div>  

            <form id="form-comment" method="POST">
                <?php  
                if ($this->session->flashdata('comment')) {
                    if ($this->session->flashdata('comment') == 'success_pending') {
                        ?>

                        <div class="alert alert-warning alert-dismissable">
                            <i class="fa fa-info-circle"></i> Success send comment, will show after aproved by administrator
                        </div>

                        <?php
                    }elseif ($this->session->flashdata('comment') == 'success_approved') {
                        ?>

                        <div class="alert alert-info alert-dismissable">
                            <i class="fa fa-info-circle"></i> Success send comment.
                        </div>

                        <?php
                    }elseif ($this->session->flashdata('comment') == 'failed') {
                        ?>

                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-info-circle"></i> Failed send comment, try again latter
                        </div>

                        <?php
                    }
                }
                ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input value="" class="input-form trans-bg" name="name" type="text" placeholder="Name" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <input value="" class="input-form trans-bg" name="email" type="email" placeholder="Email"
                        required="">
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="textarea-form trans-bg" name="content" cols="30" rows="6" placeholder="Message" required=""></textarea>
                </div>
                <input type="hidden" name="id_blog_post" value="<?php echo $post['id'] ?>">
                <input id="parent" type="hidden" name="parent">
                <input type="hidden" name="csrf_code" value="<?php echo $this->session->userdata('csrf_code') ?>">
                <button class="normal-btn" type="submit">Send</button>
            </form>
            <button class="normal-btn new-comment" type="button" style="display:none">New Comment</button>

        </div>

        <?php endif ?>