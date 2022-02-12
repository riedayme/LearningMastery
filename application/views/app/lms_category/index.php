<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/toolbar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">

    <div class="c-card h-100vh u-p-zero">
        <div class="c-card__header c-card__header--transparent o-line">
            <a class="c-btn--custom c-btn--small c-btn c-btn--success" href="<?php echo base_url('app/lms_category/create') ?>">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="c-card__body row">

            <div class="col-12">
                <?php $this->load->view('app/_layouts/alert'); ?>
            </div>

            <?php 
            if ($category) {
                foreach ($category as $data) {
                    ?>

                    <div class="col-12 col-xl-4">
                        <div class="c-graph-card">
                            <div class="c-graph-card__content u-flex u-justify-between u-align-items-center u-ph-small u-pv-small">
                                <h3 class="c-graph-card__title u-h4 u-text-bold">
                                     <i class="fa <?php echo $data['icon'] ?> u-mr-xsmall"></i>
                                    <?php echo $data['name'] ?>
                                </h3>
                                <div>
                                    <a href="<?php echo base_url('app/lms_category/update/'.$data['id']) ?>" class="c-btn c-btn--info c-btn--custom c-btn--small">
                                        <i class="fa fa-edit u-text-xsmall"></i>
                                    </a>
                                    <?php if (empty($data['sub_category'])): ?>
                                        <button data-title="are you sure ?" data-text="want to delete <?php echo $data['name'] ?> category" class="c-btn--custom c-btn--small c-btn c-btn--danger single-action" data-id="$1" data-href="<?php echo base_url('app/lms_category/delete/'.$data['id']) ?>" type="button">
                                            <i class="fa fa-trash u-text-xsmall"></i>
                                        </button>
                                    <?php endif ?>
                                </div>
                            </div>


                            <div class="c-graph-card__footer u-p-zero" style="max-height: 200px;overflow-y: auto">
                                <?php
                                if (!empty($data['sub_category'])) {
                                    foreach ($data['sub_category'] as $sub_category) {
                                        ?>
                                        <div class="u-flex u-justify-between u-align-items-center u-border-bottom u-ph-small u-pv-xsmall">

                                            <span class="u-text-small u-color-primary">
                                                <i class="fa <?php echo $sub_category['icon'] ?> u-mr-xsmall"></i>
                                                <a class="u-text-dark" target='_blank' href="<?php echo $sub_category['url'] ?>">
                                                    <?php echo $sub_category['name'] ?>
                                                </a>
                                            </span>

                                            <div class="u-text-right u-color-primary">
                                                <a href="<?php echo base_url('app/lms_category/update/'.$sub_category['id']) ?>" class="c-btn c-btn--info c-btn--custom c-btn--small">
                                                    <i class="fa fa-edit u-text-xsmall"></i>
                                                </a>
                                                <button data-title="are you sure ?" data-text="want to delete <?php echo $sub_category['name'] ?> category" class="c-btn--custom c-btn--small c-btn c-btn--danger single-action" data-id="$1" data-href="<?php echo base_url('app/lms_category/delete/'.$sub_category['id']) ?>" type="button">
                                                    <i class="fa fa-trash u-text-xsmall"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <?php if (empty($data['sub_category'])): ?>
                                    <div class="u-flex u-justify-between u-align-items-center u-border-bottom u-ph-small u-pv-xsmall">

                                        <span class="u-text-small u-color-primary">
                                            No Sub Category.
                                        </span>
                                    </div>
                                <?php endif ?>
                            </div><!-- // .c-graph-card__footer -->

                        </div>
                    </div>                              

                    <?php
                }
            }else {
                ?>

                <div class="col-12 ">                
                    <div class="c-alert c-alert--info">
                        No Category.
                    </div>
                </div>

                <?php
            }
            ?>       

        </div>
    </div>
</div>

<?php $this->load->view('app/_layouts/footer'); ?>