<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
	<form action="<?php echo base_url('app/setting_smtp/process') ?>" class="row" method="post" enctype="multipart/form-data">

		<div class="col-12 col-xl-6 col-lg-8 col-md-12 offset-xl-3 offset-lg-2">

			<?php $this->load->view('app/_layouts/alert'); ?>

			<div class="c-card c-card--responsive u-p-zero">
				<div class="c-card__header o-line">   
					<h5 class="c-card__title">  
						<?php  echo $title; ?>
					</h5>   
					<button class="c-btn c-btn--info u-ml-auto u-mr-small c-btn--custom" type="submit">
						<i class="fa fa-save" aria-hidden="true"></i>
					</button>  
				</div>
				<div class="c-card__body">   

					<div class="c-field u-mb-medium">
						<label class="c-field__label">protocol</label> 
						<input onclick='select()' class="c-input" name="protocol" type="text" placeholder="protocol" value="<?php echo (!empty($site) ? $site['smtp']['protocol'] : '') ?>"> 
					</div>

					<div class="c-field u-mb-medium">
						<label class="c-field__label">smtp_host</label> 
						<input onclick='select()' class="c-input" name="smtp_host" type="text" placeholder="smtp_host" value="<?php echo (!empty($site) ? $site['smtp']['smtp_host'] : '') ?>"> 
					</div>

					<div class="c-field u-mb-medium">
						<label class="c-field__label">smtp_port</label> 
						<input onclick='select()' class="c-input" name="smtp_port" type="text" placeholder="smtp_port" value="<?php echo (!empty($site) ? $site['smtp']['smtp_port'] : '') ?>"> 
					</div>

					<div class="c-field u-mb-medium">
						<label class="c-field__label">smtp_user</label> 
						<input onclick='select()' class="c-input" name="smtp_user" type="text" placeholder="smtp_user" value="<?php echo (!empty($site) ? $site['smtp']['smtp_user'] : '') ?>"> 
					</div>

					<div class="c-field u-mb-medium">
						<label class="c-field__label">smtp_pass</label> 
						<input autocomplete="new-password" onclick='select()' class="c-input" name="smtp_pass" type="password" placeholder="smtp_pass" value="<?php echo (!empty($site) ? $site['smtp']['smtp_pass'] : '') ?>"> 
					</div>

				</div>
			</div>

		</div>

	</form>

</div>

<?php $this->load->view('app/_layouts/footer'); ?>