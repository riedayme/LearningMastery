<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">

	<div class="c-stage u-mb-zero">
		<div class="c-stage__header o-media u-justify-start">
			<div class="c-stage__icon o-media__img">
				<i class="fa fa-check"></i>
			</div>
			<div class="c-stage__header-title o-media__body">
				<h6 class="u-mb-zero">Template List</h6>
			</div>
		</div>

		<div class="c-stage__panel u-p-medium">

			<?php $this->load->view('app/_layouts/alert'); ?>   

			<form action="<?php echo base_url('app/lms_template/process_template') ?>" class="row" method="post">

				<?php foreach ($templates as $data): ?>

					<div class="col-lg-4">
						<div class="c-card u-p-medium" data-mh="landing-cards">

							<img class="u-mb-small" src="<?php echo base_url('storage/assets/lms/'.$data['template']['path'].'/preview.png') ?>" alt="<?php echo $data['template']['name'] ?>">

							<p class="u-h4 u-text-bold u-mb-small">
								<?php echo $data['template']['name'] ?>
							</p>		

							<?php if ($data['template']['status'] == 'Active'): ?><div class="c-candidate__status u-color-success o-line">
								<i class="fa fa-check u-mr-xsmall"></i>
								Actived

								<a href="<?php echo base_url('app/lms_template/update/'.$data['template']['id']) ?>" class="c-btn c-btn--fancy u-ml-auto"><i class="fa fa-code"></i> Edit</a>
							</div>
							<?php else: ?>                                        
								<button value="<?php echo $data['template']['id'] ?>" name="id" class="c-btn c-btn--info" type="submit">
									<i class="fa fa-check u-mr-xsmall u-opacity-heavy"></i>Apply
								</button>
							<?php endif ?>
						</div>
					</div>				                          
				<?php endforeach ?>

			</form>

		</div>

	</div>
</div>

<?php $this->load->view('app/_layouts/footer'); ?>