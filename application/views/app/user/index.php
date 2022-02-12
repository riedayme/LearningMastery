<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/toolbar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">

    <div class="c-card c-card--responsive h-100vh u-p-zero">
        <div class="c-card__header c-card__header--transparent o-line">
            <a class="c-btn--custom c-btn--small c-btn c-btn--success" href="<?php echo base_url('app/user/create') ?>">
                <i class="fa fa-plus"></i>
            </a>     
            <button data-title="are you sure ?" data-text="actived selected user" title="Active User Multiple" value="active" class="u-ml-auto c-btn--custom c-btn--small c-btn c-btn--info u-mr-xsmall action-multiple btn-opsi">
                <i class="fa fa-check"></i>
            </button>                    
            <button data-title="are you sure ?" data-text="block selected user" title="Block User Multiple" value="block" class="c-btn--custom c-btn--small c-btn c-btn--warning u-mr-xsmall action-multiple btn-opsi">
                <i class="fa fa-ban"></i>
            </button>            
            <button data-title="are you sure ?" data-text="to delete selected item" title="Delete Multiple" value="delete" class="c-btn--custom c-btn--small c-btn c-btn--danger action-multiple btn-opsi">
                <i class="fa fa-trash"></i>
            </button>
        </div>
        <div class="c-card__body">

            <?php $this->load->view('app/_layouts/alert'); ?>

            <form id='form-multiple' action="<?php echo base_url('app/user/process_multiple') ?>" method="post">

                <div class="c-table-responsive">
                    <table data-mysearch="Search..." data-myorder='1' data-myurl="<?php echo base_url('app/user/datatables') ?>" class="c-table c-table--highlight u-hidden" id="table">
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
                                <th class="c-table__cell c-table__cell--head all">username</th> 
                                <th class="c-table__cell c-table__cell--head none">no_handphone</th>
                                <th class="c-table__cell c-table__cell--head all">status</th>                                
                                <th class="c-table__cell c-table__cell--head none">created</th>
                                <th class="c-table__cell c-table__cell--head none">last_login</th>                                
                                <th class="c-table__cell c-table__cell--head no-sort all u-text-center">view</th>
                                <th class="c-table__cell c-table__cell--head no-sort all u-text-center">tools</th>
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
