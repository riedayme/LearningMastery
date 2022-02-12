<!-- Modal -->
<form action="<?php echo base_url('app/lms_courses/process_section') ?>" method="POST">
    <div class="c-modal c-modal--small modal fade" id="modal-section" tabindex="-1">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">
                <div class="c-modal__body">

                    <h3 class="modal-title">                        
                    </h3>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label">section title : </label>
                        <input autocomplete="off" required class="c-input input-section-title" name="title"
                        type="text" placeholder="title">
                    </div>

                    <input class="input-section-id" type="hidden" name="id">   
                    <input type="hidden" name="id_courses" value="<?php echo $data['id']; ?>">   
                    <input type="hidden" name="redirect" value="<?php echo current_url().'?tab=material'; ?>">   
                    <button class="c-btn c-btn--info" name="submit" type="submit">
                        <i class="fa fa-save"></i>
                    </button>

                </div>

            </div><!-- // .c-modal__content -->

        </div><!-- // .c-modal__dialog -->
    </div><!-- // .c-modal -->
</form>
