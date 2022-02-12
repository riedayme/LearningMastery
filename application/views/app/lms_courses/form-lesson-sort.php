<!-- Modal -->
<div class="c-modal c-modal--small modal fade" id="modal-lesson-sort-<?php echo $section['id'] ?>" tabindex="-1">
	<div class="c-modal__dialog modal-dialog" role="document">
		<div class="c-modal__content">
			<div class="c-modal__body" data-plugin="dragula" data-containers='["lesson-list-<?php echo $section['id'] ?>"]'>

				<form id="form-lesson-sort-<?php echo $section['id'] ?>" action="<?php echo base_url('app/lms_courses/process_lesson_sort') ?>" method="POST">

					<h3 class="modal-title">  
						Sort lesson                      
					</h3>

					<style>.draggable-item {cursor: all-scroll;}</style>

					<div id="lesson-list-<?php echo $section['id'] ?>">			
						<?php foreach ($lesson as $data): ?>
							<div style="background: #333" class="c-alert draggable-item-<?php echo $section['id'] ?>" id="<?php echo $data['id'] ?>"><?php echo $data['title'] ?></div>
						<?php endforeach ?>
					</div>

					<input class="input-lesson-order-<?php echo $section['id'] ?>" type="hidden" name="order">  
					<input type="hidden" name="redirect" value="<?php echo current_url().'?tab=material'; ?>">   
					<button data-id='<?php echo $section['id']; ?>' class="c-btn c-btn--info btn-lesson-sort" type="button">
						<i class="fa fa-save"></i>
					</button>

				</form>

			</div>

		</div><!-- // .c-modal__content -->

	</div><!-- // .c-modal__dialog -->
</div><!-- // .c-modal -->