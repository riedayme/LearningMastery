<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
	<form action="<?php echo base_url('app/setting_api_key/process') ?>" class="row" method="post" enctype="multipart/form-data">

		<div class="col-12 col-xl-8 col-lg-10 col-md-12 offset-xl-2 offset-lg-1">

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
				<div class="c-card__body u-p-zero u-pt-small">   

					<div class="c-stage u-m-zero u-border-bottom-zero">
						<div class="c-stage__header o-media u-justify-start">
							<div class="c-stage__icon o-media__img">
								<i class="fa fa-info"></i>
							</div>
							<div class="c-stage__header-title o-media__body">
								<h6 class="u-mb-zero">Facebook App</h6>
							</div>
						</div>

						<div class="c-stage__panel u-p-medium row">							

							<div class="col-12">
								<div class="c-alert u-bg-primary">Get Key : <a class="u-text-white" href="https://developers.facebook.com/">https://developers.facebook.com/</a></div>
							</div>

							<div class="col-lg-6">
								<div class="c-field u-mb-medium">
									<label class="c-field__label">app_id</label> 
									<input onclick='select()' class="c-input" name="facebook_app_id" type="text" placeholder="facebook_app_id" value="<?php echo (!empty($site) ? $site['fb_app']['facebook_app_id'] : '') ?>"> 
								</div>
							</div>

							<div class="col-lg-6">
								<div class="c-field u-mb-medium">
									<label class="c-field__label">app_secret</label> 
									<input onclick='select()' class="c-input" name="facebook_app_secret" type="text" placeholder="facebook_app_secret" value="<?php echo (!empty($site) ? $site['fb_app']['facebook_app_secret'] : '') ?>"> 
								</div>
							</div>

						</div>
					</div>
					<!-- end -->

					<div class="c-stage u-m-zero u-border-top-zero u-border-bottom-zero">
						<div class="c-stage__header o-media u-justify-start">
							<div class="c-stage__icon o-media__img">
								<i class="fa fa-info"></i>
							</div>
							<div class="c-stage__header-title o-media__body">
								<h6 class="u-mb-zero">Google API</h6>
							</div>
						</div>

						<div class="c-stage__panel u-p-medium row">							

							<div class="col-12">
								<div class="c-alert u-bg-primary">Get Key : <a class="u-text-white" href="https://console.developers.google.com/apis/dashboard">https://console.developers.google.com/apis/dashboard</a></div>
							</div>

							<div class="col-lg-6">
								<div class="c-field u-mb-medium">
									<label class="c-field__label">client_id</label> 
									<input onclick='select()' class="c-input" name="client_id" type="text" placeholder="client_id" value="<?php echo (!empty($site) ? $site['google_api']['client_id'] : '') ?>"> 
								</div>
							</div>

							<div class="col-lg-6">
								<div class="c-field u-mb-medium">
									<label class="c-field__label">client_secret</label> 
									<input onclick='select()' class="c-input" name="client_secret" type="text" placeholder="client_secret" value="<?php echo (!empty($site) ? $site['google_api']['client_secret'] : '') ?>"> 
								</div>
							</div>

						</div>
					</div>	
					<!--  -->

					<div class="c-stage u-m-zero u-border-top-zero u-border-bottom-zero">
						<div class="c-stage__header o-media u-justify-start">
							<div class="c-stage__icon o-media__img">
								<i class="fa fa-info"></i>
							</div>
							<div class="c-stage__header-title o-media__body">
								<h6 class="u-mb-zero">Google reCaptcha</h6>
							</div>
						</div>

						<div class="c-stage__panel u-p-medium row">

							<div class="col-12">
								<div class="c-alert u-bg-primary">Get Key : <a class="u-text-white" href="https://www.google.com/recaptcha/">https://www.google.com/recaptcha/</a></div>
							</div>

							<div class="c-field u-mb-medium col-md-12">
								<label class="c-field__label">Using reCaptcha ?</label>
								<select required="" name="status" class="c-select select2">
									<option></option>
									<option value="Yes" <?php echo ($site['google_recaptcha']['status'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
									<option value="No" <?php echo ($site['google_recaptcha']['status'] == 'No') ? 'selected' : ''; ?>>No</option>
								</select>
							</div>	

							<div class="col-lg-6">
								<div class="c-field u-mb-medium">
									<label class="c-field__label">site_key</label> 
									<input onclick='select()' class="c-input" name="site_key" type="text" placeholder="site_key" value="<?php echo (!empty($site) ? $site['google_recaptcha']['site_key'] : '') ?>"> 
								</div>
							</div>

							<div class="col-lg-6">
								<div class="c-field u-mb-medium">
									<label class="c-field__label">secret_key</label> 
									<input onclick='select()' class="c-input" name="secret_key" type="text" placeholder="secret_key" value="<?php echo (!empty($site) ? $site['google_recaptcha']['secret_key'] : '') ?>"> 
								</div>
							</div>

						</div>
					</div>	
					<!--  -->					

				</div>
			</div>

		</div>

	</form>

</div>

<?php $this->load->view('app/_layouts/footer'); ?>