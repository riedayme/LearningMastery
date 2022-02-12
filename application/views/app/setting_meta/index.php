<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
	<form action="<?php echo base_url('app/setting_meta/process') ?>" class="row" method="post" enctype="multipart/form-data">

		<div class="col-12 col-xl-8 col-lg-10 col-md-12 offset-xl-2 offset-lg-1">

			<div class="c-card c-card--responsive u-p-zero">
				<div class="c-card__header o-line">   
					<h5 class="c-card__title">  
						<?php  echo $title; ?>
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
									<li class="c-tabs__item"><a class="c-tabs__link u-pv-xsmall u-ph-small u-text-small active show" id="nav-schema-tab" data-toggle="tab" href="#nav-schema" role="tab" aria-controls="nav-schema" aria-selected="false">Schema</a></li>
									<li class="c-tabs__item"><a class="c-tabs__link u-pv-xsmall u-ph-small u-text-small" id="nav-open-graph-tab" data-toggle="tab" href="#nav-open-graph" role="tab" aria-controls="nav-open-graph" aria-selected="false">Open Graph</a></li>
									<li class="c-tabs__item"><a class="c-tabs__link u-pv-xsmall u-ph-small u-text-small" id="nav-twitter-card-tab" data-toggle="tab" href="#nav-twitter-card" role="tab" aria-controls="nav-twitter-card" aria-selected="false">Twitter Card</a></li>
								</ul>

								<div class="c-tabs__content tab-content" id="nav-tabContent">

									<div class="c-tabs__pane active show u-p-medium u-pt-large" id="nav-schema" role="tabpanel" aria-labelledby="nav-schema-tab">
										<?php $this->load->view('app/setting_meta/form-schema'); ?>
									</div>	

									<div class="c-tabs__pane u-p-medium u-pt-large" id="nav-open-graph" role="tabpanel" aria-labelledby="nav-open-graph-tab">
										<?php $this->load->view('app/setting_meta/form-open-graph'); ?>
									</div>		

									<div class="c-tabs__pane u-p-medium u-pt-large" id="nav-twitter-card" role="tabpanel" aria-labelledby="nav-twitter-card-tab">
										<?php $this->load->view('app/setting_meta/form-twitter-card'); ?>
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