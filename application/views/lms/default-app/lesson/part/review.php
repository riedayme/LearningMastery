<!-- Modal -->
<form id="form-review" data-action="<?php echo base_url('user/review/process/') ?>" method="POST">
    <div class="c-modal c-modal--small modal fade" id="modal" tabindex="-1">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title">
                        <?php echo $this->lang->line('review') ?>
                    </h3>
                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </span>
                </div>
                <div class="c-modal__body">

                    <div class="c-field u-mb-medium u-text-center">
                        <label class="c-field__label"><?php echo $this->lang->line('rating') ?> : </label>
                        <div class='rating-stars stars-input u-pt-xsmall'>
                            <ul id='stars'>
                                <li class='star selected c-tooltip c-tooltip--top' aria-label="<?php echo $this->lang->line('rating_message_1') ?>" data-value='1'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected c-tooltip c-tooltip--top' aria-label="<?php echo $this->lang->line('rating_message_2') ?>" data-value='2'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected c-tooltip c-tooltip--top' aria-label="<?php echo $this->lang->line('rating_message_3') ?>" data-value='3'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected c-tooltip c-tooltip--top' aria-label="<?php echo $this->lang->line('rating_message_4') ?>" data-value='4'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                                <li class='star selected c-tooltip c-tooltip--top' aria-label="<?php echo $this->lang->line('rating_message_5') ?>" data-value='5'>
                                    <i class='fa fa-star fa-fw'></i>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="c-field u-mb-small">
                        <label class="c-field__label"><?php echo $this->lang->line('review') ?> : </label>
                        <textarea id='textarea-review' rows="5" autofocus="" autocomplete="off" required class="c-input" name="review" type="text" placeholder="<?php echo $this->lang->line('write_review') ?>"></textarea>
                    </div>

                </div>

                <div class="c-modal__footer">
                    <input id='rating-input' type="hidden" name="rating" value="5">
                    <input type="hidden" name="id_courses" value="<?php echo $courses['id'] ?>">
                    <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">
                        <?php echo $this->lang->line('send') ?>
                    </button>
                </div>

            </div><!-- // .c-modal__content -->

        </div><!-- // .c-modal__dialog -->
    </div><!-- // .c-modal -->
</form>