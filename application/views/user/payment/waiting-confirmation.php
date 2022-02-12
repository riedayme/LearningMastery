<?php $this->load->view('lms/default-app/_layouts/header'); ?>

<div class="o-page__card">

	<div class="u-text-center">
		<a href="<?php echo base_url() ?>" class="u-block u-mb-medium">
			<img src="<?php echo base_url('storage/assets/lms/default-app/img/logo.png') ?>" alt="<?php echo $site['title'] ?>" style="width: 120px;">
		</a>
		<h3 class="u-text-bold u-h2">
			<?php echo $this->lang->line('wait_confirmation') ?>
		</h3>
		<p class="u-h5">
			<?php echo $this->lang->line('wait_confirmation_message') ?>
		</p>

		<a class="c-btn c--btn-info c-btn--custom u-mt-small" href="<?php echo base_url('user/order') ?>">
			<?php echo $this->lang->line('view_transaction') ?>
		</a>

		<?php if ($confirmation): ?>			

			<p class="u-mt-medium u-mb-xsmall u-h5">
				<?php echo $this->lang->line('confirmation_message') ?>
			</p>

			<?php foreach ($confirmation as $read): ?>
				<table class="c-table">
					<tbody class="c-table__head">
						<tr class="c-table__row">
							<td class="c-table__cell c-table__cell--head u-text-center" colspan="2">
								<img width="100px" src="<?php echo $read['image'] ?>" alt="transaction">
							</td>
						</tr>
						<tr class="c-table__row">
							<td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
								<?php echo $read['type']; ?> 
							</td>
							<td class="u-border-right u-pv-xsmall u-ph-small u-text-left">
								<?php echo $read['data'] ?>
							</td>
						</tr>
					</tbody>
				</table>

			<?php endforeach ?>
		<?php endif ?>


	</div>

</div>

<?php $this->load->view('lms/default-app/_layouts/footer'); ?>