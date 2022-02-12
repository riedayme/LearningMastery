<?php $this->load->view('blog/templates/pisen/_layouts/header');?>
<?php $this->load->view('blog/templates/pisen/_layouts/nav');?>


<?php  
if (!empty($blog_post)) {
	?>

	<?php 
	$this->load->view('blog/templates/pisen/homepage/style/'.$template['style']['homepage']);
	?>

	<?php
}else{
	?>

	<section class="error-404">
		<div class="container">
			<div class="row">
				<div class="col-12 text-center">
					<img class="img-fluid" src="<?php echo base_url('storage/assets/blog/pisen/img/nopost.png') ?>" alt="error image">
					<?php if ($site['page_type'] == 'search'): ?>
						<h1><?php echo $this->lang->line('search_not_found') ?></h1>
						<p><?php echo $this->lang->line('search_instruction') ?></p>
						<a href="<?php echo base_url() ?>">
							<?php echo $this->lang->line('go_homepage') ?>
						</a>
						<?php else: ?>					
						<h1><?php echo $this->lang->line('blog_post_not_found') ?></h1>
						<p><?php echo $this->lang->line('blog_post_not_found_message') ?></p>
					<?php endif ?>
				</div>
			</div>
		</div>
	</section>

	<?php
}
?>
<?php $this->load->view('blog/templates/pisen/_layouts/footer-widget');?>
<?php $this->load->view('blog/templates/pisen/_layouts/footer');?>