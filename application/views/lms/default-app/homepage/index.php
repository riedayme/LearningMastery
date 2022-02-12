<?php $this->load->view('lms/default-app/_layouts/header'); ?>
<?php $this->load->view('lms/default-app/_layouts/nav'); ?>
<?php $this->load->view('lms/default-app/homepage/part/jumbotron'); ?>

<div class="container u-mv-small">                   

	<div class="row">

		<?php if (!empty($courses['data'])): ?>

			<div class="col-lg-12 col-md-12">

				<div class="u-mb-small u-pv-small u-border-bottom">		
					<div class="row">

						<div class="col-12 col-xl-10 col-lg-10">
							<h3 class="u-h3">
								<?php echo $site['sub_title'] ?>
							</h3>
						</div>
						<div class="col-12 col-xl-2 col-lg-2 u-text-right">
							<a class="c-btn c-btn--info c-btn--fullwidth" href="<?php echo base_url('courses-filter') ?>">
								<?php echo $this->lang->line('filter_material') ?>
							</a>
						</div>
					</div>
				</div>

				<div class="row">					
					<?php foreach ($courses['data'] as $post): ?>

						<div class="col-sm-12 col-lg-4">

							<article class="c-event u-p-zero">
								<div class="c-event__img u-m-zero" data-mh="imaged">
									<a title="<?php echo $post['title'] ?>" class="u-color-primary" href="<?php echo $post['url'] ?>">
										<img width="100%" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo $post['image']['thumbnail'] ?>" alt="<?php echo $post['title'] ?>">
									</a>
									
									<span class="c-event__status u-bg-secondary u-color-primary">
										<?php if ($post['sub_category']['icon']): ?>
											<i class="fa <?php echo $post['sub_category']['icon'] ?>"></i>
										<?php endif ?>
										<?php if (empty($post['sub_category']['icon'])): ?>
											<i class="fa fa-folder"></i>
										<?php endif ?>
										<a class='u-text-dark' href="<?php echo $post['sub_category']['url'] ?>" title="<?php echo $post['sub_category']['name'] ?>">
											<?php echo $post['sub_category']['name'] ?>
										</a>
									</span>
								</div>
								<div class="c-event__meta u-ph-small u-pt-xsmall" data-mh="heading">
									<a title="<?php echo $post['title'] ?>" class="u-color-primary u-h4 u-text-bold" href="<?php echo $post['url'] ?>">
										<?php echo $post['title'] ?>
									</a>
								</div>
								<div class="c-event__meta u-ph-small u-pt-xsmall u-border-top">
									<div class="o-media">
										<div class="o-media__img u-mr-xsmall">
											<div class="c-avatar c-avatar--xsmall">
												<img class="c-avatar__img" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo $post['author']['photo'] ?>" alt="<?php echo $post['author']['name'] ?>">
											</div>
										</div>
										<div class="o-media__body">
											<?php echo $post['author']['name'] ?>
											<small class="u-block u-text-mute">
												<?php echo $post['author']['headline'] ?>
											</small>
										</div>
									</div>
									<div class="u-ml-auto">
										<div class='rating-stars u-flex u-justify-between u-pt-xsmall'>
											<ul>
												<?php  
												for ($i=0; $i < 5 ; $i++) { 

													if ($i < $post['rating']) {
														echo "
														<li class='star selected'>
															<i class='fa fa-star fa-fw'></i>
														</li>";
													}else{
														echo "
														<li class='star'>
															<i class='fa fa-star fa-fw'></i>
														</li>";
													}
												}
												?>
											</ul>
										</div>
									</div>
								</div>

								<div class="c-event__meta u-ph-small u-pt-xsmall u-border-top">
									<span class="cursor-default c-btn c-event__btn c-btn--custom u-bg-secondary u-color-primary u-border-zero"><i class="fa fa-eye u-mr-xsmall"></i><?php echo $post['views'] ?></span>          
									<?php if (empty($post['price'])): ?>
										<span class="cursor-default c-btn c-event__btn c-btn--custom u-bg-secondary u-color-primary u-border-zero">
											<i class="fa fa-shopping-cart u-mr-xsmall"></i>
											<?php echo $this->lang->line('free') ?>
										</span>
									<?php endif ?>

									<?php if (!empty($post['price'])): ?>
										<span class="cursor-default c-btn c-event__btn c-btn--custom u-bg-info u-text-small">
											<?php if (!empty($post['discount'])): ?>
												<s class="u-text-xsmall u-mr-xsmall"><?php echo $post['price'] ?></s>
												<?php echo $post['price_total'] ?>
											<?php endif ?>
											<?php if (empty($post['discount'])): ?>
												<?php echo $post['price_total'] ?>
											<?php endif ?>
										</span>
									<?php endif ?>
									
								</div>								
							</article>

						</div>

					<?php endforeach ?>	

					<div class="col-12">
						<?php $this->load->view('lms/default-app/_layouts/pagination');?>	
					</div>	
				</div>

			</div>

		<?php else: ?><div class="col-sm-12 col-lg-12">
			<div class="c-card u-p-medium u-pv-xlarge" data-mh="landing-cards">

				<div class="u-text-center u-justify-between">
					<div class="c-avatar c-avatar--large u-mb-small u-inline-flex">
						<img class="c-avatar__img" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo base_url('storage/assets/lms/default-app/img/logo-square.png') ?>" alt="<?php echo $this->lang->line('courses_not_found') ?>">
					</div>

					<p class="u-h5"><?php echo $this->lang->line('courses_not_found') ?></p>

				</div>

			</div>
		</div>
	<?php endif ?>

</div><!-- // .row -->

</div><!-- // .container -->

<?php $this->load->view('lms/default-app/_layouts/footer-widget'); ?>
<?php $this->load->view('lms/default-app/_layouts/footer'); ?>