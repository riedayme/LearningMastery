<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>

<div class="c-toolbar u-justify-center u-mb-small">
    <div class="col-12 col-lg-10 col-xl-8">
        <div class="row">
            <div class="col-6 col-md-6 c-toolbar__state">
                <h4 class="c-toolbar__state-number"><?php echo $statistic['total_amount']; ?></h4>
                <span class="c-toolbar__state-title">Total Amount</span>
            </div>
            <div class="col-6 col-md-6 c-toolbar__state">
                <h4 class="c-toolbar__state-number"><?php echo $statistic['total_invoice']; ?></h4>
                <span class="c-toolbar__state-title">Total Invoice</span>
            </div>
        </div><!-- // .row -->
    </div><!-- // -->
</div>

<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">

    <div class="c-card c-card--responsive h-100vh u-p-zero">
        <div class="c-card__body">

            <?php $this->load->view('app/_layouts/alert'); ?>

            <form id='form-multiple' action="<?php echo base_url('app/user_invoice_history/process_multiple') ?>" method="post">

                <div class="c-table-responsive">
                    <table data-mysearch="Search..." data-myorder='5' data-myurl="<?php echo base_url('app/user_invoice_history/datatables') ?>" class="c-table c-table--highlight u-hidden" id="table">
                        <caption class="c-table__title cst-table">
                        </caption>

                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head text-center no-sort none">
                                    <div class="c-choice c-choice--checkbox">
                                        <input class="c-choice__input" id="checkbox-all" name="select_all" type="checkbox">
                                        <label class="c-choice__label" for="checkbox-all"></label>
                                    </div>
                                </th>
                                <th class="c-table__cell c-table__cell--head all">id</th>
                                <th class="c-table__cell c-table__cell--head no-sort all">invoice</th> 
                                <th class="c-table__cell c-table__cell--head all">transaction</th>
                                <th class="c-table__cell c-table__cell--head all">amount</th>
                                <th class="c-table__cell c-table__cell--head all">time</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </form>

        </div>
    </div>
</div>

<?php $this->load->view('app/_layouts/footer'); ?>