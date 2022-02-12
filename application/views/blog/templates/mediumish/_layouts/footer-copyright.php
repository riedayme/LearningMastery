<!-- Begin Footer
	================================================== -->
	<div class="footer">
		<p class="pull-left">
			<?php echo $this->lang->line('copyright') ?> <?php echo "©".date('Y '); echo $site['title']; ?>.
			<?php echo $this->lang->line('rendered_in') ?> {elapsed_time} <?php echo $this->lang->line('seconds') ?>
		</p>
		<?php if ($widget['footer_pages']['status'] == 'active'): ?>
			<p class="pull-right">
				<?php foreach ($widget['footer_pages']['content'] as $page): ?>
					<a title='<?php echo $page['title'] ?>' href="<?php echo $page['url'] ?>"><?php echo $page['title'] ?></a>				
				<?php endforeach ?>
			</p>
		<?php endif ?>
		<div class="clearfix">
		</div>
	</div>
<!-- End Footer
================================================== -->