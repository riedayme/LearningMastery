<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/toolbar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">

    <div class="c-card c-card--responsive h-100vh u-p-zero">
        <div class="c-card__header c-card__header--transparent o-line">
            
            <button data-title="are you sure ?" data-text="to approve selected comment" title="Approved Multiple" value="approved" class="c-btn--custom c-btn--small c-btn c-btn--info u-mr-xsmall  action-multiple btn-opsi">
                <i class="fa fa-check"></i>
            </button>                

            <button data-title="are you sure ?" data-text="to block selected comment" title="Block Multiple" value="blocked" class="c-btn--custom c-btn--small c-btn c-btn--warning u-mr-xsmall  action-multiple btn-opsi">
                <i class="fa fa fa-ban"></i>
            </button>            

            <button data-title="are you sure ?" data-text="to delete selected comment" title="Delete Multiple" value="delete" class="c-btn--custom c-btn--small c-btn c-btn--danger action-multiple btn-opsi">
                <i class="fa fa-trash"></i>
            </button>

            <button class="c-btn--custom c-btn--small c-btn c-btn--success action-refresh u-ml-auto">
                <i class="fa fa-refresh"></i>
            </button>            


        </div>
        <div class="c-card__body">

            <form id='form-multiple' action="<?php echo base_url('app/blog_post_comment/process_multiple') ?>" method="post">

                <div class="c-table-responsive">
                    <table data-mysearch="Search..." data-myorder='1' data-myurl="<?php echo base_url('app/blog_post_comment/datatables') ?>" class="c-table c-table--highlight" id="table" width="100%">
                        <caption class="c-table__title cst-table">
                        </caption>

                        <thead class="c-table__head c-table__head--slim">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head text-center no-sort all">
                                    <input name="select_all" type="checkbox" id="checkbox-all">
                                </th>
                                <th class="c-table__cell c-table__cell--head none">id</th>
                                <th class="c-table__cell c-table__cell--head all">content</th>
                                <th class="c-table__cell c-table__cell--head all">date</th>
                                <th class="c-table__cell c-table__cell--head all">status</th>
                                <th class="c-table__cell c-table__cell--head none">email</th>
                                <th class="c-table__cell c-table__cell--head none">log</th>
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

<?php $this->load->view('app/_layouts/footer'); ?>