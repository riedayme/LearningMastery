<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
	<form action="<?php echo base_url('app/setting_general/process') ?>" class="row" method="post" enctype="multipart/form-data">

		<div class="col-12 col-xl-8 col-lg-10 col-md-12 offset-xl-2 offset-lg-1">

			<div class="c-card c-card--responsive u-p-zero">
				<div class="c-card__header o-line">   
					<h5 class="c-card__title">  
						<?php echo $title; ?>
					</h5>     
					<button class="c-btn c-btn--info u-ml-auto u-mr-small c-btn--custom" type="submit">
						<i class="fa fa-save" aria-hidden="true"></i>
					</button>
				</div>
				<div class="c-card__body u-p-zero u-pt-small u-bg-secondary">      

					<div class="row">

						<div class="col-12">

							<div class="u-ph-medium">
								<?php $this->load->view('app/_layouts/alert'); ?>
							</div>

							<div class="c-tabs">

								<ul class="c-tabs__list c-tabs__list--splitted nav nav-tabs u-ph-medium" id="myTab" role="tablist">
									<li class="c-tabs__item"><a class="c-tabs__link u-pv-xsmall u-ph-small u-text-small active show" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="false">General</a></li>
									<li class="c-tabs__item"><a class="c-tabs__link u-pv-xsmall u-ph-small u-text-small" id="nav-lms-tab" data-toggle="tab" href="#nav-lms" role="tab" aria-controls="nav-lms" aria-selected="false">Lms</a></li>
									<li class="c-tabs__item"><a class="c-tabs__link u-pv-xsmall u-ph-small u-text-small" id="nav-blog-tab" data-toggle="tab" href="#nav-blog" role="tab" aria-controls="nav-blog" aria-selected="false">Blog</a></li>
									<li class="c-tabs__item"><a class="c-tabs__link u-pv-xsmall u-ph-small u-text-small" id="nav-user-tab" data-toggle="tab" href="#nav-user" role="tab" aria-controls="nav-user" aria-selected="false">User</a></li>
								</ul>

								<div class="c-tabs__content tab-content" id="nav-tabContent">

									<div class="c-tabs__pane active show u-p-zero u-pt-large" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab">
										<?php $this->load->view('app/setting_general/form-general'); ?>
									</div>	

									<div class="c-tabs__pane u-p-medium u-pt-large" id="nav-lms" role="tabpanel" aria-labelledby="nav-lms-tab">
										<?php $this->load->view('app/setting_general/form-lms'); ?>
									</div>		

									<div class="c-tabs__pane u-p-medium u-pt-large" id="nav-blog" role="tabpanel" aria-labelledby="nav-blog-tab">
										<?php $this->load->view('app/setting_general/form-blog'); ?>
									</div>	

									<div class="c-tabs__pane u-p-medium u-pt-large" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab">
										<?php $this->load->view('app/setting_general/form-user'); ?>
									</div>			

								</div>

							</div>

						</div>

					</div>					

				</div>
			</div>

		</div>

	</form>

</div>

<?php $this->load->view('app/_layouts/footer'); ?>