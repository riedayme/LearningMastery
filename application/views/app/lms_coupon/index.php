<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/toolbar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">

    <div class="c-card c-card--responsive h-100vh u-p-zero">
        <div class="c-card__header c-card__header--transparent o-line">
            <button data-title="Create" class="c-btn--custom c-btn--small c-btn c-btn--blue" id='modal-create' data-toggle="modal" data-target="#modal">
                <i class="fa fa-plus"></i>
            </button>
            <button data-title="are you sure ?" data-text="to delete selected item" title="Delete Multiple" value="delete" class="c-btn--custom c-btn--small c-btn c-btn--danger action-multiple btn-opsi">
                <i class="fa fa-trash"></i>
            </button>
        </div>
        <div class="c-card__body">

            <form id='form-multiple' action="<?php echo base_url('app/lms_coupon/process_multiple') ?>" method="post">

                <div class="c-table-responsive">
                    <table data-mysearch="Search..." data-myorder='1' data-myurl="<?php echo base_url('app/lms_coupon/datatables') ?>" class="c-table c-table--highlight u-hidden" id="table">
                        <caption class="c-table__title cst-table">
                        </caption>

                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head text-center no-sort all">
                                    <div class="c-choice c-choice--checkbox">
                                        <input class="c-choice__input" id="checkbox-all" name="select_all" type="checkbox">
                                        <label class="c-choice__label" for="checkbox-all"></label>
                                    </div>
                                </th>
                                <th class="c-table__cell c-table__cell--head none">id</th>
                                <th class="c-table__cell c-table__cell--head all">code</th>
                                <th class="c-table__cell c-table__cell--head all">type</th>
                                <th class="c-table__cell c-table__cell--head all">data</th>
                                <th class="c-table__cell c-table__cell--head all">for</th>
                                <th class="c-table__cell c-table__cell--head all">expired</th>
                                <th class="c-table__cell c-table__cell--head no-sort all">view</th>
                                <th class="c-table__cell c-table__cell--head no-sort all">tools</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </form>

        </div>
    </div>
</div>

<?php $this->load->view('app/lms_coupon/form'); ?>
<?php $this->load->view('app/_layouts/footer'); ?>