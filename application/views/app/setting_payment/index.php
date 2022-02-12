<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
	<form action="<?php echo base_url('app/setting_payment/process_setting') ?>" class="row" method="post" enctype="multipart/form-data">

		<div class="col-12 col-xl-8 col-lg-10 col-md-12 offset-xl-2 offset-lg-1">

			<?php $this->load->view('app/_layouts/alert'); ?>

			<div class="c-card c-card--responsive u-p-zero">
				<div class="c-card__header o-line">   
					<h5 class="c-card__title">  
						<?php  echo $title; ?>
					</h5>   
					<?php if ($this->session->userdata('app_grade') == 'App'): ?>		
						<button class="c-btn c-btn--info u-ml-auto u-mr-small c-btn--custom" type="submit">
							<i class="fa fa-save" aria-hidden="true"></i>
						</button>  
					<?php endif ?>
				</div>
				<div class="c-card__body u-p-zero u-pt-small">   

					<?php if ($this->session->userdata('app_grade') == 'App'): ?>		
						<?php $this->load->view('app/setting_payment/form-setting'); ?>		   
					<?php endif ?>

					<div class="row">

						<div class="col-12">

							<!-- start -->	
							<div class="c-stage u-m-zero u-border-bottom-zero type-manual" style='<?php echo ($site['payment_method'] == 'Manual') ? '' : 'display:none'; ?>'>

								<div class="c-stage__header o-media u-justify-start cursor-default">
									<div class="c-stage__icon o-media__img">
										<i class="fa fa-info"></i>
									</div>
									<div class="c-stage__header-title o-media__body">
										<h6 class="u-mb-zero">Transaction</h6>
									</div>
									<div class="u-ml-auto o-line">                       
										<button type="button" class="c-btn c-btn--success c-btn--custom u-mr-xsmall button-payment-transaction-create" data-toggle="modal" data-target="#form-transaction"> 
											<i class="fa fa-plus"></i>
										</button>           
									</div>
								</div>

								<div class="c-stage__panel u-p-medium">

									<div class="c-table-responsive">
										<table class="c-table c-table--highlight" style="display: table">
											<thead class="c-table__head c-table__head--slim">
												<tr class="c-table__row">
													<th class="c-table__cell c-table__cell--head">type</th>
													<th class="c-table__cell c-table__cell--head">account_number</th> 
													<th class="c-table__cell c-table__cell--head">receiver</th>
													<th class="c-table__cell c-table__cell--head">tools</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($payment['transaction']): ?>
													<?php foreach ($payment['transaction'] as $transaction): ?>
														<tr class="c-table__row">
															<th class="c-table__cell">
																<?php echo $transaction['type'] ?>
															</th>
															<th class="c-table__cell">
																<?php echo $transaction['account_number'] ?>
															</th> 
															<th class="c-table__cell">
																<?php echo $transaction['receiver'] ?>
															</th>
															<th class="c-table__cell" style="width: 10%">
																<button data-type='<?php echo $transaction['type'] ?>' data-account_number='<?php echo $transaction['account_number'] ?>' data-receiver='<?php echo $transaction['receiver'] ?>' data-identity='<?php echo $transaction['identity'] ?>' type="button" class="c-btn c-btn--small c-btn--info c-btn--custom button-payment-transaction" data-toggle="modal" data-target="#form-transaction"> 
																	<i class="fa fa-edit"></i>
																</button>
																<button data-title="are you sure ?" data-text="want to delete transaction  <?php echo $transaction['type'] ?>" class="c-btn--custom c-btn--small c-btn c-btn--danger single-action" data-href="<?php echo base_url('app/setting_payment/delete/transaction/'.$transaction['identity']) ?>" type="button"><i class="fa fa-trash"></i></button>
															</th>
														</tr>
													<?php endforeach ?>
												<?php endif ?>
												<?php if (empty($payment['transaction'])): ?>
													<tr class="c-table__row">
														<th class="c-table__cell u-text-center" colspan="4">
															No Data
														</th>
													</tr>
												<?php endif ?>
											</tbody>
										</table>
									</div>

								</div>

							</div>
							<!-- end -->

							<!-- start -->
							<div class="c-stage u-m-zero u-border-top-zero type-manual" style='<?php echo ($site['payment_method'] == 'Manual') ? '' : 'display:none'; ?>'>

								<div class="c-stage__header o-media u-justify-start cursor-default">
									<div class="c-stage__icon o-media__img">
										<i class="fa fa-info"></i>
									</div>
									<div class="c-stage__header-title o-media__body">
										<h6 class="u-mb-zero">Confirmation</h6>
									</div>
									<div class="u-ml-auto o-line">                       
										<button type="button" class="c-btn c-btn--success c-btn--custom u-mr-xsmall button-payment-confirmation-create" data-toggle="modal" data-target="#form-confirmation"> 
											<i class="fa fa-plus"></i>
										</button>         
									</div>
								</div>

								<div class="c-stage__panel u-p-medium">

									<div class="c-table-responsive">
										<table class="c-table c-table--highlight" style="display: table">
											<thead class="c-table__head c-table__head--slim">
												<tr class="c-table__row">
													<th class="c-table__cell c-table__cell--head">type</th>
													<th class="c-table__cell c-table__cell--head">data</th> 
													<th class="c-table__cell c-table__cell--head">tools</th>
												</tr>
											</thead>
											<tbody>
												<?php if ($payment['confirmation']): ?>
													<?php foreach ($payment['confirmation'] as $confirmation): ?>
														<tr class="c-table__row">
															<th class="c-table__cell">
																<?php echo $confirmation['type'] ?>
															</th>
															<th class="c-table__cell">
																<?php echo $confirmation['data'] ?>
															</th> 
															<th class="c-table__cell" style="width: 10%">
																<button data-type='<?php echo $confirmation['type'] ?>' data-data='<?php echo $confirmation['data'] ?>' data-identity='<?php echo $confirmation['identity'] ?>' type="button" class="c-btn c-btn--small c-btn--info c-btn--custom button-payment-confirmation" data-toggle="modal" data-target="#form-confirmation"> 
																	<i class="fa fa-edit"></i>
																</button>
																<button data-title="are you sure ?" data-text="want to delete confirmation <?php echo $confirmation['type'] ?>" class="c-btn--custom c-btn--small c-btn c-btn--danger single-action" data-href="<?php echo base_url('app/setting_payment/delete/confirmation/'.$confirmation['identity']) ?>" type="button"><i class="fa fa-trash"></i></button>
															</th>
														</tr>
													<?php endforeach ?>
												<?php endif ?>
												<?php if (empty($payment['confirmation'])): ?>
													<tr class="c-table__row">
														<th class="c-table__cell u-text-center" colspan="3">
															No Data
														</th>
													</tr>
												<?php endif ?>
											</tbody>
										</table>
									</div>

								</div>

							</div>
							<!-- end -->

						</div>

					</div>
				</div>
			</div>

		</div>

	</form>

</div>

<?php $this->load->view('app/setting_payment/form-confirmation'); ?>
<?php $this->load->view('app/setting_payment/form-transaction'); ?>

<?php $this->load->view('app/_layouts/footer'); ?>