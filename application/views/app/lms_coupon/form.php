<!-- Modal -->
<form id="form-master" data-action="<?php echo base_url('app/lms_coupon/process') ?>" method="POST">
    <div class="c-modal c-modal--medium modal fade" id="modal" tabindex="-1">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title cst-modal-title"></h3>
                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </span>
                </div>
                <div class="c-modal__body row">

                    <div class="c-field u-mb-small col-6">
                        <label class="c-field__label">code : </label>
                        <input autocomplete="off" required class="c-input" name="code" type="text" placeholder="code">
                    </div>

                    <div class="c-field u-mb-small col-6">
                        <label class="c-field__label">expired : </label>
                        <input id="datetimepicker" autocomplete="off" required class="c-input" name="expired" type="text" placeholder="expired">
                    </div>

                    <div class="c-field u-mb-small col-6">
                        <label class="c-field__label">type : </label>
                        <select id="coupon-type" required name="type" class="select2" data-placeholder='select type'>
                            <option></option>
                            <option value="Price">Price</option>                            
                            <option value="Percent">Percent</option>
                        </select>
                    </div>

                    <div class="c-field u-mb-small col-6">
                        <label class="c-field__label">for : </label>
                        <select id="coupon-for" required name="for" class="select2" data-placeholder='select for'>
                            <option></option>
                            <option value="all-product">all-product</option>
                        </select>
                    </div>


                    <div class="c-field u-mb-small col-12">
                        <label class="c-field__label">data : </label>
                        <input autocomplete="off" required class="c-input" name="data" type="text" placeholder="data" onkeyup="FormatCurrency(this)">
                    </div>

                </div>

                <div class="c-modal__footer">
                    <input type="hidden" name="id">
                    <button class="c-btn c-btn--info" name="submit" type="submit">
                        <i class="fa fa-send-o"></i>
                    </button>
                </div>

            </div><!-- // .c-modal__content -->

        </div><!-- // .c-modal__dialog -->
    </div><!-- // .c-modal -->
</form>
