<?php $this->load->view('lms/default-app/_layouts/header'); ?>
<?php $this->load->view('lms/default-app/_layouts/nav'); ?>

<div class="container u-mv-medium h-100vh">                   

	<div class="row">

		<?php $this->load->view('user/_layouts/nav'); ?>

		<div class="col-xl-9">

			<h2 class="u-h3 u-mb-small"><?php echo $this->lang->line('my_wishlist') ?></h2>

			<?php if (!empty($wishlist['data'])): ?>					
				<?php foreach ($wishlist['data'] as $post): ?>
					<div class="c-card u-p-small u-mb-xsmall">	
						<div class="row">
							<div class="col-12 col-lg-9 order-lg-1">

								<p class="u-color-primary u-text-bold">
									<?php echo $post['title'] ?> 
									<?php if ($post['status'] == 'Draft'): ?>
										<span class="c-badge c-badge--warning c-badge--small u-ml-xsmall">
											<?php echo $this->lang->line('courses_closed') ?>
										</span>
									<?php endif ?>
								</p>								

								<div class="u-block u-mv-small">
									<p class="c-badge c-badge--info">
										<?php echo $post['sub_category']['name'] ?>
									</p>
								</div>

							</div>
							<div class="col-12 col-lg-3 u-flex u-align-items-center order-last order-lg-2">

								<?php if ($post['status'] != 'Draft'): ?>
									<a title="<?php echo $post['title'] ?>" class="c-btn c-btn--primary c-btn--custom" href="<?php echo $post['url'] ?>">
										<?php echo $this->lang->line('view_courses') ?>
									</a>
								<?php endif ?>

								<?php if ($post['status'] == 'Draft'): ?>
									<button class="c-btn" disabled="">
										<?php echo $this->lang->line('courses_closed') ?>
									</button>
								<?php endif ?>

								<button data-title="<?php echo $this->lang->line('notif_title') ?>" data-text="<?php echo $this->lang->line('notif_delete').' '.$this->lang->line('wishlist').' '.$post['title'] ?>" class="u-ml-xsmall c-btn c-btn--danger c-btn--custom btn-remove-wishlist" data-action="<?php echo base_url('user/wishlist/process_delete/'.$post['id']) ?>">
									<i class="fa fa-trash"></i>
								</button>
							</div>
						</div>
					</div>
				<?php endforeach ?>	

				<?php if (empty($this->input->get('showall')) AND $wishlist['pagination']['total_rows'] > $wishlist['pagination']['per_page']): ?>			
					<div class="u-mv-medium row">
						<div class="col-6">
							<?php $this->load->view('lms/default-app/_layouts/pagination',['courses' => $wishlist]);?>	
						</div>
						<div class="col-6 o-line">
							<a class="u-ml-auto c-btn c-btn--custom c-btn--info" href="<?php echo base_url('user/wishlist?showall=true') ?>">
								<?php echo $this->lang->line('show_all') ?>
							</a>
						</div> 

					</div>	
				<?php endif ?>

			<?php endif ?>

			<?php if (empty($wishlist['data'])): ?>
				<div class="c-card u-p-small">
					
					<div class="u-text-center u-justify-between u-pv-medium">
						<p class="u-h5"><?php echo $this->lang->line('user_wishlist_not_found') ?></p>
					</div>

				</div>		
			<?php endif ?>
		</div>

	</div>

</div><!-- // .row -->

</div><!-- // .container -->

<?php $this->load->view('lms/default-app/_layouts/footer-widget'); ?>
<?php $this->load->view('lms/default-app/_layouts/footer'); ?>