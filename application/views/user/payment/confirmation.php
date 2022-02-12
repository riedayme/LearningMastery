<?php $this->load->view('lms/default-app/_layouts/header'); ?>

<?php $this->load->view('user/_layouts/nav-confirmation'); ?>

<form method="POST" enctype="multipart/form-data">
	<div class="container u-mt-medium">                   
		<div class="row">
			<div class="col-12 col-xl-6 offset-xl-3">  

				<?php  
				if ($this->session->flashdata('message')) {
					if ($this->session->flashdata('message') == TRUE) {
						?>

						<!-- alert-automatic -->
						<div class="c-alert c-alert--<?php echo $this->session->flashdata('message_type') ?>">
							<?php echo $this->session->flashdata('message_text') ?>     
						</div>

						<?php
					}
				}
				?>  

				<div class="c-card u-p-medium u-mb-small u-text-center">  

					<h3>
						<?php echo $confirmation['title'] ?>
					</h3>

					<div class="c-card u-p-small u-mh-large u-mb-medium">  
						<p>
							<?php echo $this->lang->line('payment_proof_price'); ?> 
						</p>

						<h2 class="u-text-bold">
							<?php echo $confirmation['amount'] ?>
						</h2>
					</div>

					<p class="u-h4 u-mb-small">
						<?php echo $this->lang->line('payment_proof_message'); ?> 
					</p>

					<table class="c-table">
						<tbody class="c-table__head">
							<tr class="c-table__row">
								<td class="c-table__cell c-table__cell--head u-text-center" colspan="2">
									<img src="<?php echo base_url('storage/assets/user/img/'.$confirmation['transaction_type'].'.png') ?>" alt="transaction">
								</td>
							</tr>
							<tr class="c-table__row">
								<td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
									<?php echo $this->lang->line('bank'); ?> 
								</td>
								<td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
									<?php echo $confirmation['transaction_type'] ?>
								</td>
							</tr>
							<tr class="c-table__row">
								<td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
									<?php echo $this->lang->line('account_number'); ?> 
								</td>
								<td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
									<?php echo $confirmation['transaction_account_number'] ?>
								</td>
							</tr>
							<tr class="c-table__row">
								<td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
									<?php echo $this->lang->line('receiver'); ?> 
								</td>
								<td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
									<?php echo $confirmation['transaction_receiver'] ?>
								</td>
							</tr>							
						</tbody>
					</table>

				</div>

				<!-- proof upload -->
				<div class="u-h4 u-mb-small">
					<?php echo $this->lang->line('payment_proof_upload'); ?> 
				</div> 
				<div class="c-card u-p-medium u-mb-small">  

					<div class="u-text-center u-mb-medium">

						<div class="u-mb-small">
							<img style="width:250px" class="file-return" src="<?php echo base_url('storage/assets/user/img/proof-default.jpg') ?>" alt="proof">
							<div>
								format gambar yang dibolehkan (jpg, jpeg, png)
							</div>
						</div>

						<input name="proof" class="custom-input-file" id="my-file" type="file">
						<label tabindex="0" for="my-file" class="custom-input-file-trigger c-btn c-btn--secondary c-btn--custom">
							<?php echo $this->lang->line('select').' '.$this->lang->line('proof_transaction') ?>
						</label>
						<?php echo form_error('proof', '<small class="c-field__message u-color-danger u-block"><i class="fa fa-times-circle"></i>', '</small>'); ?> 

					</div>	

					<div class="c-field u-mb-small">
						<label class="c-field__label">
							<?php echo $this->lang->line('proof_sender') ?>
						</label>
						<input name="sender" class="c-input" type="text" value="">
						<?php echo form_error('sender', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
					</div>				

					<div class="c-field u-mb-small">
						<input name="id" class="c-input" type="hidden" value="<?php echo $confirmation['id'] ?>">
						<button class="c-btn c-btn--info c-btn--fullwidth">
							<?php echo $this->lang->line('send'); ?> 
						</button>
					</div>

				</div>

			</div>
		</div>
	</div>

</form>

<?php $this->load->view('lms/default-app/_layouts/footer'); ?>