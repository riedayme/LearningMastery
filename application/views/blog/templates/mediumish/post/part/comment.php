<?php if ($post['comment_post']['type'] == 'disqus'): ?>
    <?php echo $post['comment_post']['data']; ?>
<?php endif ?>

<?php if ($post['comment_post']['type'] == 'system'):?>
   <div class="alert alert-info"><?php echo $this->lang->line('comment_not_support') ?></div>
<?php endif ?>