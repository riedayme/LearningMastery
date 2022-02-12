<form action="<?php echo base_url('app/lms_courses/process') ?>" class="row" method="post" enctype="multipart/form-data">

    <div class="col-12 col-xl-9 col-lg-9">

        <div class="c-stage u-mb-zero">

            <div class="c-stage__header o-media u-justify-start cursor-default <?php echo ($this->input->get('editcourse') == 'false') ? 'u-hidden' : '' ?>">
                <div class="c-stage__header-title o-media__body">
                    <?php if (!empty($data)): ?>
                        <input name="id" type="hidden" value="<?php echo $data['id'] ?>">
                    <?php endif ?>           
                    <button class="c-btn c-btn--info c-btn--custom" name="publish" type="submit" title="publish">
                        <i class="fa fa-send-o" aria-hidden="true"></i>
                    </button>
                    <?php if (!empty($data)): ?>
                        <button class="u-ml-small c-btn c-btn--primary c-btn--custom" type="submit" name="save" title="save" value="<?php echo uri_string(); ?>">
                            <i class="fa fa-save" aria-hidden="true"></i>
                        </button>
                    <?php endif ?>
                </div>
                <div class="u-ml-auto" style="min-width: 150px">
                    <div class="c-toggle">
                        <div class="c-toggle__btn <?php echo (!empty($data['status'])) ? ($data['status'] == 'Published') ? 'is-active' : '' : ''?>">
                            <label class="c-toggle__label" for="publish">
                                <input value="Published" class="c-toggle__input" id="publish" name="status" type="radio" <?php echo (!empty($data['status'])) ? ($data['status'] == 'Published') ? 'checked' : '' : ''?>>Publish
                            </label>
                        </div>

                        <div class="c-toggle__btn <?php echo (!empty($data['status'])) ? ($data['status'] == 'Draft') ? 'is-active' : '' : 'is-active'?>">
                            <label class="c-toggle__label" for="draft">
                                <input value="Draft" class="c-toggle__input" id="draft" name="status" type="radio" <?php echo (!empty($data['status'])) ? ($data['status'] == 'Draft') ? 'checked' : '' : 'checked' ?>>Draft
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="c-stage__panel u-p-zero">

                <div class="row">
                    <div class="col-12 col-lg-12">                        
                        <div class="c-field u-ph-medium u-pt-small u-mb-medium">
                            <label class="c-field__label">title : </label>
                            <input required class="c-input" name="title" type="text" placeholder="title" value="<?php echo (!empty($data['title']) ? $data['title'] : '') ?>" id="title">
                        </div>
                    </div>
                </div> 

                <ul class="c-tabs__list nav nav-tabs u-ph-zero u-pv-small" role="tablist">
                    <li>
                        <a class="c-tabs__link u-p-small u-mr-zero u-bg-secondary active" id="nav-description-tab" data-toggle="tab" href="#nav-description" role="tab" aria-controls="nav-description" aria-selected="true">description</a>
                    </li>

                    <li>
                        <a class="c-tabs__link u-p-small u-mr-zero u-bg-secondary" id="nav-faq-tab" data-toggle="tab" href="#nav-faq" role="tab" aria-controls="nav-faq" aria-selected="false">faq</a>
                    </li>
                </ul> 

                <div class="c-tabs__content tab-content" id="nav-tabContent">
                    <div class="c-tabs__pane active u-p-zero" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">

                        <div class="c-field">
                            <textarea required class="editor" name="description">
                                <?php echo (!empty($data['description']) ? $data['description'] : '') ?>
                            </textarea>
                        </div>  

                    </div>
                    <div class="c-tabs__pane u-p-zero" id="nav-faq" role="tabpanel" aria-labelledby="nav-faq-tab">

                        <div class="c-field">
                            <textarea required class="editor" name="faq">
                                <?php echo (!empty($data['faq']) ? $data['faq'] : '') ?>
                            </textarea>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <div class="col-xl-3 col-lg-3">

        <div class="c-card c-card--responsive">
            <div class="c-card__header c-card__header--transparent o-line">
                <h5 class="c-card__title">
                    Setting
                </h5>
            </div>
            <div class="c-card__body u-p-zero">

                <div class="c-stage u-mb-zero u-border-zero" id="accordion">

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-permalink" aria-expanded="false" aria-controls="stage-permalink">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">permalink</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>
                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse" id="stage-permalink">

                        <?php if ((empty($data['status']))): ?>
                            <label><input name="permalink_auto" value="auto" type="radio" checked="">Auto</label>
                            <label><input name="permalink_auto" value="manual" type="radio">Manual</label>

                            <input name="permalink_old" type="hidden" value="<?php echo (!empty($data['permalink']) ? $data['permalink'] : '') ?>">
                            <input onClick="this.select();" autocomplete="off"
                            value="<?php echo (!empty($data['permalink']) ? $data['permalink'] : '') ?>"
                            class="c-input" name="permalink" id="permalink"
                            type="hidden" placeholder="permalink">
                        <?php endif ?>
                        <?php if ((!empty($data['status']))): ?>

                            <label><input name="permalink_auto" value="auto" type="radio">Auto</label>
                            <label><input name="permalink_auto" value="manual" type="radio" checked="">Manual</label>

                            <input name="permalink_old" type="hidden" value="<?php echo (!empty($data['permalink']) ? $data['permalink'] : '') ?>">
                            <input onClick="this.select();" autocomplete="off"
                            value="<?php echo (!empty($data['permalink']) ? $data['permalink'] : '') ?>"
                            class="c-input" name="permalink" id="permalink"
                            type="text" placeholder="permalink">                    
                        <?php endif ?>

                    </div>

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-category" aria-expanded="false" aria-controls="stage-category">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">category</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>
                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse show" id="stage-category">

                        <select required name="category" class="select2-search">
                            <option></option>
                            <?php
                            foreach ($categorys as $category_name => $child_category) {

                                echo "<optgroup label='".$category_name."'>";

                                foreach ($child_category as $category) {
                                    if (!empty($data['id_sub_category']) AND $data['id_sub_category'] == $category['id_sub_category']) {
                                        echo "<option value='".$category['id_category']."__".$category['id_sub_category']."' selected>".$category['name']."</option>";
                                    }else {
                                        echo "<option value='".$category['id_category']."__".$category['id_sub_category']."'>".$category['name']."</option>";
                                    }
                                }

                                echo "</optgroup>";
                            }

                            ?>
                        </select>
                    </div>

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-image" aria-expanded="false" aria-controls="stage-image">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">image</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>
                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse show" id="stage-image">

                        <div class="c-field u-mb-small">
                            <img data-default_image='<?php echo base_url('storage/assets/app/img/preview-image.jpg') ?>' data-base_url='<?php echo base_url('storage/uploads/medium/') ?>' id='preview-image' style="width: 100%;max-height: 160px" src="<?php echo (!empty($data['image'])) ? base_url('storage/uploads/medium/'.$data['image']) : base_url('storage/assets/app/img/preview-image.jpg') ?>" alt="Image">
                        </div>

                        <div class="c-field has-addon-right">
                            <input value="<?php echo (!empty($data['image']) ? $data['image'] : '') ?>" required name="image" class="c-input" id="image" type="text">
                            <span class="u-ml-auto c-field__addon">
                                <button id='button-filemanager' data-src="<?php echo base_url(PATH_FILE_MANAGER."?type=1&relative_url=1&field_id=image&multiple=0&akey=".$this->session->userdata('key')) ?>" class="c-btn c-btn--fancy u-p-xsmall" type="button" data-toggle="modal" data-target="#modal-filemanager">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-price" aria-expanded="false" aria-controls="stage-price">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">price</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>
                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse show" id="stage-price">
                        <input required class="c-input" name="price" type="text" placeholder="price" value="<?php echo (!empty($data['price']) ? number_format($data['price'], 0, ',', '.') : '0') ?>" onkeyup="FormatCurrency(this)">
                    </div>

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-discount" aria-expanded="false" aria-controls="stage-discount">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">discount</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>
                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse show" id="stage-discount">
                        <input class="c-input" name="discount" type="text" placeholder="discount" value="<?php echo (!empty($data['discount']) ? number_format($data['discount'], 0, ',', '.') : '0') ?>" onkeyup="FormatCurrency(this)">
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>