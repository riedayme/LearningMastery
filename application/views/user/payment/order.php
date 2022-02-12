<?php $this->load->view('lms/default-app/_layouts/header'); ?>

<?php $this->load->view('user/_layouts/nav-payment'); ?>

<form id='form-payment' method="POST" style='position: relative; min-height: 100%;'>
	<div class="container u-mt-medium">                   
		<div class="row">
			<div class="col-12 col-xl-8 offset-xl-2">    

				<!-- Courses -->
				<div class="u-h4 u-mb-small">
					<?php echo $this->lang->line('payment_detail'); ?> 
				</div> 
				<div class="c-card u-p-small u-mb-small">  

					<article class="c-stage u-mb-zero" id="stages">
						<a class="c-stage__header u-flex u-justify-between" data-toggle="collapse" href="#stage-detail-pembelian" aria-expanded="true" aria-controls="stage-detail-pembelian">
							<div class="o-media">
								<div class="c-stage__header-title o-media__body">
									<h6 class="u-mb-zero">
										<?php echo $courses['title']; ?>
									</h6>
								</div>
							</div>

							<i class="fa fa-angle-down u-text-mute"></i>
						</a>
						<div class="c-stage__panel c-stage__panel--mute collapse show" id="stage-detail-pembelian" style="">
							<div class="u-p-medium">

								<p class="u-text-mute u-text-uppercase u-text-small u-mb-xsmall">
									<?php echo $this->lang->line('payment_lesson'); ?> 
								</p>

								<ul class="row">
									<?php if (!empty($courses['count_type_lesson']['Text'])): ?>
										<li class="col-md-6 u-mb-xsmall u-text-small u-color-primary">
											<i class="fa fa-file-text u-color-info u-text-mute u-mr-xsmall"></i>
											<?php echo $courses['count_type_lesson']['Text'] ?> Text
										</li>
									<?php endif ?>  
									<?php if (!empty($courses['count_type_lesson']['Video'])): ?>
										<li class="col-md-6 u-mb-xsmall u-text-small u-color-primary">
											<i class="fa fa-newspaper-o u-color-info u-text-mute u-mr-xsmall"></i>
											<?php echo $courses['count_type_lesson']['Video'] ?> Video
										</li>
									<?php endif ?>  
									<?php if (!empty($courses['count_type_lesson']['Image'])): ?>
										<li class="col-md-6 u-mb-xsmall u-text-small u-color-primary">
											<i class="fa fa-newspaper-o u-color-info u-text-mute u-mr-xsmall"></i>
											<?php echo $courses['count_type_lesson']['Image'] ?> Image
										</li>
									<?php endif ?>  
									<?php if (!empty($courses['count_type_lesson']['File'])): ?>
										<li class="col-md-6 u-mb-xsmall u-text-small u-color-primary">
											<i class="fa fa-newspaper-o u-color-info u-text-mute u-mr-xsmall"></i>
											<?php echo $courses['count_type_lesson']['File'] ?> File
										</li>
									<?php endif ?>                                
								</ul>

							</div>
						</div>
					</article>

				</div>	

				<!-- Coupon -->
				<div class="u-h4 u-mb-small">
					<?php echo $this->lang->line('payment_coupon'); ?> 
				</div> 
				<div class="c-card u-p-small u-mb-small">  
					<input value="<?php echo $courses['id'] ?>" name="id_courses" class="c-input" type="hidden">	
					<input value="<?php echo $courses['id_user'] ?>" name="id_courses_user" type="hidden">
					<div class="c-field has-addon-right">
						<input placeholder="<?php echo $this->lang->line('payment_coupon_insert'); ?> " name="code" class="c-input" type="text">
						<span class="u-ml-auto c-field__addon">
							<button id='check-coupon' class="c-btn c-btn--fancy u-p-xsmall" type="button" data-action="<?php echo base_Url('payment/use_coupon') ?>">
								<?php echo $this->lang->line('payment_coupon_check'); ?> 
							</button>

							<button id='remove-coupon' class="c-btn c-btn--danger u-p-xsmall u-hidden" type="button">
								<i class="fa fa-trash"></i>
							</button>
						</span>
					</div>
					<span id="coupon-respon"></span>
				</div>

				<!-- Transaction -->
				<?php if ($site['payment_method'] == 'Manual'): ?>   
					<div class="u-h4 u-mb-small">
						<?php echo $this->lang->line('payment_method'); ?> 
					</div> 

					<div class="c-card u-p-small u-mb-small">
						<h4>
							<?php echo $this->lang->line('bank_transfer'); ?> 
						</h4>

						<?php if (empty($courses['payment']['transaction'])): ?>		
							<div class="c-alert c-alert--info">Metode pembayaran belum tersedia.</div>
						<?php endif ?>

						<?php if ($courses['payment']['transaction']): ?>		
							<?php foreach ($courses['payment']['transaction'] as $transaction): ?>
								<div class="c-card u-p-zero u-mb-small">  
									<div class="c-choice c-choice--radio u-p-zero u-m-zero">
										<input class="c-choice__input checkbox-image" id="<?php echo $transaction['type'] ?>" name="transaction" type="radio" value='<?php echo $transaction['type'] ?>'>
										<label class="c-choice__label u-flex u-p-small" for="<?php echo $transaction['type'] ?>">
											<img style="width:100px" src="<?php echo base_url('storage/assets/user/img/'.$transaction['type'].'.png') ?>" alt="<?php echo $transaction['type'] ?>">
										</label>        
									</div>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
				<?php endif ?>            


			</div>
		</div>
	</div>

	<!-- Pay Button -->
	<footer class="u-border-top u-bg-white" style=" position:relative;bottom:0;width:100%; ">
		<div class="container">
			<div class="row">
				<div class="col-12 col-xl-8 offset-xl-2 u-pv-xsmall"> 

					<div class="row">
						<div class="col-4 col-lg-4 c-toolbar__state">
							<span class="c-toolbar__state-title">
								<?php echo $this->lang->line('price'); ?> 
							</span>
							<h4 class="c-toolbar__state-number u-h4">
								<?php echo $courses['price'] ?>
							</h4>
						</div>
						<div class="col-4 col-lg-4 c-toolbar__state">
							<span class="c-toolbar__state-title">
								<?php echo $this->lang->line('discount'); ?> 
							</span>
							<h4 class="c-toolbar__state-number u-h4">
								<?php if (!empty($courses['discount'])): ?>
									<?php echo $courses['discount'] ?>
								<?php endif ?>
								<?php if (empty($courses['discount'])): ?>
									<?php echo $courses['discount_original'] ?>
								<?php endif ?>
							</h4>
							<div id="order-discount-coupon" class="u-hidden">                            
								<span class="c-toolbar__state-title">
									<?php echo $this->lang->line('discount_coupun'); ?> 
								</span>
								<h4 class="c-toolbar__state-number u-h4">
									<?php if (!empty($courses['discount'])): ?>
										<?php echo $courses['discount'] ?>
									<?php endif ?>
									<?php if (empty($courses['discount'])): ?>
										<?php echo $courses['discount_original'] ?>
									<?php endif ?>
								</h4>
							</div>
						</div>

						<div class="col-4 col-lg-4 c-toolbar__state">
							<div class="c-toolbar__state-number u-h4">
								<?php echo $this->lang->line('total_price'); ?> 
								<div id='order-price-total' class="u-block" data-price-total='<?php echo $courses['price_total'] ?>'>
									<?php echo $courses['price_total'] ?>
								</div>
							</div>

							<input name="free_action" type="hidden" value="<?php echo base_url('payment/process_free') ?>">
							<input name="free_code" type="hidden">  
							<input name="payment_method" type="hidden" value="<?php echo $site['payment_method'] ?>">  

							<?php if ($site['payment_method'] == 'Manual'): ?>        
								<input name="action" type="hidden" value="<?php echo base_url('payment/process_manual') ?>">
								<input name="payment_transaction" type="hidden">

								<button class="c-btn c-btn--custom u-mb-small" type="submit" id="pay-manual" disabled=""> 
									<?php echo $this->lang->line('order_now'); ?> 
								</button>
							<?php endif ?>


							<?php if ($site['payment_method'] == 'Midtrans'): ?>        
								<input name="action" type="hidden" value="<?php echo base_url('payment/process_midtrans') ?>">
								<input name="lang" type="hidden" value="<?php echo ($site['language'] == 'indonesia') ? 'id' : 'en' ?>">
								<input name="token" type="hidden" value="<?php echo $courses['payment']['token'] ?>" data-value="<?php echo $courses['payment']['token'] ?>">

								<button id="pay-midtrans" class="c-btn c-btn--custom u-mb-small" type='submit'> 
									<?php echo $this->lang->line('order_now'); ?> 
								</button>
							<?php endif ?>

						</div>
					</div>

				</div>

			</div>
		</div>
	</footer>

</form>

<?php $this->load->view('lms/default-app/_layouts/footer'); ?>