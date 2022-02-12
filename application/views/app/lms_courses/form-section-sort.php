<!-- Modal -->
<form id="form-section-sort" action="<?php echo base_url('app/lms_courses/process_section_sort') ?>" method="POST">
	<div class="c-modal c-modal--small modal fade" id="modal-section-sort" tabindex="-1">
		<div class="c-modal__dialog modal-dialog" role="document">
			<div class="c-modal__content">
				<div class="c-modal__body" data-plugin="dragula" data-containers='["section-list"]'>

					<h3 class="modal-title">  
						Sort Section                      
					</h3>

					<style>.draggable-item {cursor: all-scroll;}</style>

					<div id="section-list">			
						<?php foreach ($section as $data): ?>
							<div style="background: #333" class="c-alert draggable-item" id="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></div>
						<?php endforeach ?>
					</div>

					<input class="input-section-order" type="hidden" name="order">
					<input type="hidden" name="redirect" value="<?php echo current_url().'?tab=material'; ?>">   
					<button id="btn-section-sort" class="c-btn c-btn--info" type="button">
						<i class="fa fa-save"></i>
					</button>

				</div>

			</div><!-- // .c-modal__content -->

		</div><!-- // .c-modal__dialog -->
	</div><!-- // .c-modal -->
</form>