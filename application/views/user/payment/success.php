<?php $this->load->view('lms/default-app/_layouts/header'); ?>

<div class="o-page__card">

	<div class="u-text-center">
		<a href="<?php echo base_url() ?>" class="u-block u-mb-medium">
			<img src="<?php echo base_url('storage/assets/lms/default-app/img/logo.png') ?>" alt="<?php echo $site['title'] ?>" style="width: 120px;">
		</a>
		<h3 class="u-text-bold u-h2">
			<?php echo $this->lang->line('success_payment') ?>
		</h3>
		<p class="u-h5">
			<?php echo $this->lang->line('success_payment_message') ?>
		</p>
		<a class="c-btn c--btn-info u-mt-medium c-btn--custom" href="<?php echo base_url('user/courses') ?>">
			<?php echo $this->lang->line('view_courses') ?>
		</a>
	</div>

</div>

<?php $this->load->view('lms/default-app/_layouts/footer'); ?>