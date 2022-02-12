<?php $this->load->view('lms/default-app/_layouts/header'); ?>
<?php $this->load->view('lms/default-app/_layouts/nav'); ?>

<div class="container u-mv-medium h-100vh">                   

	<div class="row">

		<?php $this->load->view('user/_layouts/nav'); ?>

		<div class="col-xl-9">

			<h2 class="u-h3 u-mb-small"><?php echo $this->lang->line('my_courses') ?></h2>

				<?php if (!empty($courses['data'])): ?>					
					<?php foreach ($courses['data'] as $post): ?>
						<div class="c-card u-p-small u-mb-xsmall">	
							<div class="row">
								<div class="col-12 col-lg-9 order-lg-1">

									<?php if ($post['status'] != 'Draft'): ?>
										<a title="<?php echo $post['title'] ?>" class="u-color-primary u-text-bold" href="<?php echo $post['url'] ?>"'>
											<?php echo $post['title'] ?>
										</a>								
									<?php endif ?>

									<?php if ($post['status'] == 'Draft'): ?>
										<div class="u-color-primary u-text-bold">
											<?php echo $post['title'] ?> 
											<span class="c-badge c-badge--warning c-badge--small u-ml-xsmall">
												<?php echo $this->lang->line('courses_closed') ?>
											</span>
										</div>								
									<?php endif ?>

									<div class="u-block u-mv-small">
										<p class="c-badge c-badge--info">
											<?php echo $post['sub_category']['name'] ?>
										</p>
									</div>

								</div>
								<div class="col-12 col-lg-3 u-flex u-align-items-center order-last order-lg-2">
									<a title="<?php echo $post['title'] ?>" class="c-btn c-btn--primary c-btn--custom" href="<?php echo $post['first_lesson'] ?>">
										<i class="fa fa-send-o u-mr-xsmall"></i><?php echo $this->lang->line('learn_now') ?>
									</a>
								</div>
								<div class="col-12 u-mv-small order-lg-3">
									<p>
										<?php echo $this->lang->line('courses_progress') ?> : <?php echo $post['user_lesson_progress'] ?> 
										(<?php echo $post['count_lesson_user'].'/'.$post['count_lesson'] ?>)
									</p>
									<div class="c-progress c-progress--info u-m-zero" style="height: 10px">
										<div class="c-progress__bar" style="width:<?php echo $post['user_lesson_progress'] ?>;"></div>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach ?>		

					<?php if (empty($this->input->get('showall')) AND $courses['pagination']['total_rows'] > $courses['pagination']['per_page']): ?>			
						<div class="u-mv-medium row">
							<div class="col-6">
								<?php $this->load->view('lms/default-app/_layouts/pagination');?>	
							</div>
							<div class="col-6 o-line">
								<a class="u-ml-auto c-btn c-btn--custom c-btn--info" href="<?php echo base_url('user/courses?showall=true') ?>">
									<?php echo $this->lang->line('show_all') ?>
								</a>
							</div> 

						</div>	
					<?php endif ?>

				<?php endif ?>

				<?php if (empty($courses['data'])): ?>
					<div class="c-card u-p-small">

						<div class="u-text-center u-justify-between u-pv-medium">
							<p class="u-h5"><?php echo $this->lang->line('user_courses_not_found') ?></p>
						</div>

					</div>		
				<?php endif ?>
			</div>

		</div>

	</div><!-- // .row -->

</div><!-- // .container -->

<?php $this->load->view('lms/default-app/_layouts/footer-widget'); ?>
<?php $this->load->view('lms/default-app/_layouts/footer'); ?>