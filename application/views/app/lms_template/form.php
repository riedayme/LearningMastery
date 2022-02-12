<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
	<form action="<?php echo base_url('app/lms_template/process_update') ?>" method="POST">
		<div class="c-card c-card--responsive h-100vh u-p-zero">
			<div class="c-card__header u-bg-white o-line">       

				<div class="c-field has-addon-right">

					<input value="<?php echo (!empty($this->input->get('filename')) ? $this->input->get('filename') : '') ?>" required="" name="filename" id='button-templatefile' data-toggle="modal" data-target="#modal-templatefile" type="text" class="c-input" placeholder="select file" readonly="">

					<span class="c-field__addon" style="margin-left: 10px;background: none;border: none">
						<button class="c-btn--custom c-btn c-btn--info" type="submit">
							<i class="fa fa-save"></i>
						</button>
					</span>
				</div>

			</div>
			<div class="c-card__body">   

				<?php $this->load->view('app/_layouts/alert'); ?>

				<input type="hidden" name="redirect" value="<?php echo current_url() ?>"/>
				<textarea data-readonly="<?php echo (!empty($this->input->get('filename')) ? 'false' : 'true') ?>" name="code" id="codemirror" class="c-input" rows="20"><?php echo (!empty($this->input->get('filename')) ? htmlentities(file_get_contents($this->input->get('filename'))) : '') ?></textarea>

			</div>
		</div>
	</form>
</div>

<!-- Modal -->
<div class="c-modal c-modal--medium modal fade" id="modal-templatefile" tabindex="-1">
	<div class="c-modal__dialog modal-dialog" role="document">

		<div class="modal-content target-templatefile">

			<div class="c-modal__header">
				<h3 class="c-modal__title">
					Select File Template
				</h3>
				<span class="c-modal__close" data-dismiss="modal" aria-label="Close">
					<i class="fa fa-close"></i>
				</span>
			</div>

			<div class="c-modal__body">


				<style>.mytemplatefile ul {margin: initial;list-style-type: square;padding-left: 30px}</style>
				<?php  
				function create_option($allfile) {

					echo "<ul class='mytemplatefile'>";
					foreach ($allfile as $key => $file) {
						if (is_array($file)) {

							if (is_numeric($key)) {
								$filext = pathinfo($file['name'], PATHINFO_EXTENSION);
								if ($filext == 'php') {
									echo "<li><a data-action='".base_url('app/lms_template/get_template_file')."' class='link u-color-primary' href='javascript:;' data-href='".$file['path']."'><i class='fa fa-file'></i> ".$file['name']."</a></li>";
								}
							}else {							
								echo "<li class='u-color-warning'><i class='fa fa-folder'></i> <b>$key</b></li>";
							}

							create_option($file);
						}
					}
					echo "</ul>";

				}   
				?>

				<?php  
				echo create_option($allfile);
				?>			

			</div>

		</div>

	</div><!-- // .c-modal__dialog -->
</div><!-- // .c-modal -->


<?php $this->load->view('app/_layouts/footer'); ?>