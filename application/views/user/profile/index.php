<?php $this->load->view('lms/default-app/_layouts/header'); ?>
<?php $this->load->view('lms/default-app/_layouts/nav'); ?>

<div class="container u-mv-medium h-100vh">                   

	<div class="row">

		<?php $this->load->view('user/_layouts/nav'); ?>

		<div class="col-xl-9">
			<form action="<?php echo base_url('user/profile') ?>" method="POST" enctype="multipart/form-data">
				<h2 class="u-h3 u-mb-small"><?php echo $this->lang->line('my_profile') ?></h2>

				<div class="c-card u-p-zero">	

					<div class="u-m-medium">
						<?php $this->load->view('app/_layouts/alert'); ?>			
					</div>

					<div class="u-text-center u-mb-medium">
						<div class="c-avatar c-avatar--xlarge u-inline-block">
							<img class="c-avatar__img" src="<?php echo (!empty($profile['photo']) ?  base_url('storage/uploads/user/photo/'.$profile['photo']) : base_url('storage/uploads/user/photo/default.png')) ?>" alt="<?php echo $this->session->userdata('username') ?>">
						</div>

						<div class="row">
							<div class="col-10 col-md-4 col-sm-6 offset-md-4 offset-sm-3 offset-1">
								<label class="c-field__label">								
									<?php echo $this->lang->line('change_photo') ?>
								</label>
								<input type="hidden" name="photo_old" value="<?php echo (!empty($profile['photo'])) ? $profile['photo'] : '' ?>" class="c-input">
								<input name="photo" class="c-input" type="file">
							</div>
						</div>
					</div>

					<div class="c-stage u-mb-zero">

						<div class="c-stage__header o-media u-justify-start">
							<div class="c-stage__icon o-media__img">
								<i class="fa fa-tree"></i>
							</div>
							<div class="c-stage__header-title o-media__body">
								<h6 class="u-mb-zero"><?php echo $this->lang->line('general') ?></h6>
							</div>
						</div>

						<div class="c-stage__panel u-ph-medium u-pv-small">

							<div class="row u-mb-medium">
								<div class="col-sm-3">
									<label class="c-field__label">								
										<?php echo $this->lang->line('full_name') ?>
									</label>
								</div> 
								<div class="col-sm-9">
									<input type="text" name="full_name" class="c-input" value="<?php echo (!empty($profile['username'])) ? (!empty(set_value('full_name')) ? set_value('full_name') : $profile['username'] ) : set_value('username') ?>"/>
									<?php echo form_error('full_name', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
								</div>
							</div>

							<div class="row u-mb-medium">
								<div class="col-sm-3">
									<label class="c-field__label">								
										<?php echo $this->lang->line('email') ?>
									</label>
								</div> 
								<div class="col-sm-9">
									<input readonly="" type="text" name="email" value="<?php echo (!empty($profile['email'])) ? $profile['email'] : '' ?>" class="c-input">
									<small class="u-text-mute">
										<?php echo $this->lang->line('note_email') ?>
									</small>
								</div>
							</div>

							<div class="row u-mb-medium">
								<div class="col-sm-3">
									<label class="c-field__label">								
										<?php echo $this->lang->line('no_handphone') ?>
									</label>
								</div> 
								<div class="col-sm-9">
									<input type="number" name="no_handphone" class="c-input" value="<?php echo (!empty($profile['no_handphone'])) ? (!empty(set_value('no_handphone')) ? set_value('no_handphone') : $profile['no_handphone'] ) : set_value('no_handphone') ?>"/>
									<?php echo form_error('no_handphone', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
								</div>
							</div>

						</div>

						<div class="c-stage__header o-media u-justify-start">
							<div class="c-stage__icon o-media__img">
								<i class="fa fa-lock"></i>
							</div>
							<div class="c-stage__header-title o-media__body">
								<h6 class="u-mb-zero"><?php echo $this->lang->line('security') ?></h6>
							</div>
						</div>

						<div class="c-stage__panel u-ph-medium u-pv-small">
							
							<div class="row u-mb-medium">
								<div class="col-sm-3">
									<label class="c-field__label">								
										<?php echo $this->lang->line('old_password') ?>
									</label>
								</div> 
								<div class="col-sm-9">
									<div class="c-field has-addon-right">
										<input autocomplete="new-password" id='old_password' name="old_password" class="c-input" type="password">
										<button tabindex="-1" type="button" class="c-field__addon" onclick="toggle('old_password',this)">
											<i class="fa fa-eye-slash"></i>
										</button>
									</div>       
									<small class="u-text-mute">
										<?php echo $this->lang->line('note_password') ?>
									</small>
									<?php echo form_error('old_password', '<small class="c-field__message u-color-danger u-block"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
								</div>
							</div>					

							<div class="row u-mb-medium">
								<div class="col-sm-3">
									<label class="c-field__label">								
										<?php echo $this->lang->line('new_password') ?>
									</label>
								</div> 
								<div class="col-sm-9">
									<div class="c-field has-addon-right">
										<input autocomplete="new-password" id='new_password' name="new_password" class="c-input" type="password">
										<button tabindex="-1" type="button" class="c-field__addon" onclick="toggle('new_password',this)">
											<i class="fa fa-eye-slash"></i>
										</button>
									</div>       
									<small class="u-text-mute">
										<?php echo $this->lang->line('note_password') ?>
									</small>
									<?php echo form_error('new_password', '<small class="c-field__message u-color-danger u-block"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
								</div>
							</div>

							<div class="row u-mb-medium">
								<div class="col-sm-3">
									<label class="c-field__label">								
										<?php echo $this->lang->line('password_confirm') ?>
									</label>
								</div> 
								<div class="col-sm-9">
									<div class="c-field has-addon-right">
										<input autocomplete="new-password" id='password_confirm' name="password_confirm" class="c-input" type="password">
										<button tabindex="-1" type="button" class="c-field__addon" onclick="toggle('password_confirm',this)">
											<i class="fa fa-eye-slash"></i>
										</button>
									</div>       
									<small class="u-text-mute">
										<?php echo $this->lang->line('note_password') ?>
									</small>
									<?php echo form_error('password_confirm', '<small class="c-field__message u-color-danger u-block"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
								</div>
							</div>

						</div>

						<div class="c-stage__panel u-ph-medium u-pv-small">
							<div class="o-line">
								<button class="c-btn c-btn--info u-ml-auto" type="submit"><?php echo $this->lang->line('save') ?></button>
							</div>
						</div>

					</div>					


				</div>
			</form>
		</div>

	</div><!-- // .row -->

</div><!-- // .container -->

<?php $this->load->view('lms/default-app/_layouts/footer-widget'); ?>
<?php $this->load->view('lms/default-app/_layouts/footer'); ?>