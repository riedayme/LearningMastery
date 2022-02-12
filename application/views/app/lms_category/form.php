<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2 u-mv-medium">
    <form action="<?php echo base_url('app/lms_category/process') ?>"  method="post" enctype="multipart/form-data">

        <?php $this->load->view('app/_layouts/alert'); ?>

        <div class="c-stage u-mb-zero">

            <a class="c-stage__label c-stage__header u-flex u-justify-">
                <div class="o-media">
                    <div class="c-stage__header-title o-media__body">
                        <h6 class="u-mb-zero c-stage__label-title">
                            <?php echo $sub_title ?>
                            &nbsp;
                        </h6>
                    </div>
                </div>
            </a>

            <div class="c-stage__panel u-p-medium" >

                <div class="c-field u-mb-small">
                    <label class="c-field__label">name : </label>
                    <input autofocus="" autocomplete="off" required class="c-input" name="name" type="text" placeholder="name" value="<?php echo (!empty($data['name'])) ? $data['name'] : '' ?>">
                </div>

                <?php if (!empty($parent) AND $parent < 1 or empty($parent)): ?>
                <div class="c-field u-mb-medium">
                    <label class="c-field__label">parent : </label>

                    <select name="parent" class="has-search select2 category-parent">
                        <option value="None" selected="">None</option>
                        <?php
                        foreach ($categorys as $category) {
                            if (!empty($data['parent']) AND $data['parent'] == $category['id']) {
                                echo "<option value='".$category['id']."' selected>".$category['name']."</option>";
                            }else {
                                echo "<option value='".$category['id']."'>".$category['name']."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            <?php endif ?>

            <div class="c-field u-mb-small">
                <label class="c-field__label">icon : </label>
                <input required class="c-input icon-picker" name="icon" type="text" placeholder="icon" value="<?php echo (!empty($data['icon'])) ? $data['icon'] : '' ?>">
            </div>

            <div class="c-field u-mb-small input-parent" style='<?php echo (!empty($data['parent'])) ? 'display:none' : '' ?>'>
                <label class="c-field__label">Image : </label>
                <div class="c-field has-addon-right">
                    <input value="<?php echo (!empty($data['image']) ? $data['image'] : '') ?>" require name="image" class="c-input" id="image" type="text">
                    <span class="u-ml-auto c-field__addon">
                        <button id='button-filemanager' data-src="<?php echo base_url(PATH_FILE_MANAGER."?type=1&relative_url=1&multiple=0&field_id=image&akey=".$this->session->userdata('key')) ?>" class="c-btn c-btn--fancy u-p-xsmall" type="button" data-toggle="modal" data-target="#modal-filemanager">
                            <i class="fa fa-search"></i>
                        </button>

                    </span>
                </div>
            </div>

        </div>

        <div class="c-stage__panel u-p-medium">
            <?php if (!empty($data)): ?>
                <input name="id" type="hidden" value="<?php echo $data['id'] ?>">
            <?php endif ?>           
            <button type="submit" class="c-btn c-btn--primary c-btn--custom"> 
                Submit
            </button>
        </div>

    </div>

</form>
</div>

<?php $this->load->view('app/_layouts/modal_filemanager'); ?>
<?php $this->load->view('app/_layouts/footer'); ?>