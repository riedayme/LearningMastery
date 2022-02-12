<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">

    <form action="<?php echo base_url('app/blog_post/process') ?>" class="row" method="post" enctype="multipart/form-data">

        <div class="col-12 col-xl-9 col-lg-9 u-mb-small">

           <div class="c-card c-card--responsive u-p-zero">
            <div class="c-card__header c-card__header--transparent o-line">

                <button class="c-btn c-btn--info c-btn--custom" name="publish" type="submit" title="publish">
                    <i class="fa fa-send-o" aria-hidden="true"></i>
                </button>
                <?php if (!empty($blog_post)): ?>
                    <button class="u-ml-small c-btn c-btn--primary c-btn--custom" type="submit" name="save" title="save" value="<?php echo uri_string(); ?>">
                        <i class="fa fa-save" aria-hidden="true"></i>
                    </button>
                <?php endif ?>

                <?php if (!empty($blog_post)): ?>
                    <input type="hidden" name="id" value="<?php echo (!empty($blog_post['id']) ? $blog_post['id'] : '') ?>">
                <?php endif ?>

                <div class="u-ml-auto" style="min-width: 150px">
                    <div class="c-toggle u-mb-small">
                        <div class="c-toggle__btn <?php echo (!empty($site_pages['status'])) ? ($site_pages['status'] == 'Published') ? 'is-active' : '' : 'is-active'?>">
                            <label class="c-toggle__label" for="publish">
                                <input value="Published" class="c-toggle__input" id="publish" name="status" type="radio" <?php echo (!empty($site_pages['status'])) ? ($site_pages['status'] == 'Published') ? 'checked' : '' : 'checked'?>>Publish
                            </label>
                        </div>

                        <div class="c-toggle__btn <?php echo (!empty($site_pages['status'])) ? ($site_pages['status'] == 'Draft') ? 'is-active' : '' : ''?>">
                            <label class="c-toggle__label" for="draft">
                                <input value="Draft" class="c-toggle__input" id="draft" name="status" type="radio" <?php echo (!empty($site_pages['status'])) ? ($site_pages['status'] == 'Draft') ? 'checked' : '' : '' ?>>Draft
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="c-card__body u-p-zero">

                <?php $this->load->view('app/_layouts/alert'); ?>

                <div class="c-field u-mb-small u-p-small">
                    <label class="c-field__label">title : </label>
                    <input autofocus autocomplete="off"
                    value="<?php echo (!empty($blog_post['title']) ? $blog_post['title'] : '') ?>" required
                    class="c-input" name="title" id="title" type="text"
                    placeholder="title">
                </div>

                <div class="c-field">
                    <textarea required class="editor" name="content">
                        <?php echo (!empty($blog_post['content']) ? $blog_post['content'] : '') ?>
                    </textarea>
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

                        <?php if ((empty($blog_post['status']))): ?>
                            <label><input name="permalink_auto" value="auto" type="radio" checked="">Auto</label>
                            <label><input name="permalink_auto" value="manual" type="radio">Manual</label>

                            <input name="permalink_old" type="hidden" value="<?php echo (!empty($blog_post['permalink']) ? $blog_post['permalink'] : '') ?>">
                            <input onClick="this.select();" autocomplete="off"
                            value="<?php echo (!empty($blog_post['permalink']) ? $blog_post['permalink'] : '') ?>"
                            class="c-input" name="permalink" id="permalink"
                            type="hidden" placeholder="permalink">
                        <?php endif ?>
                        <?php if ((!empty($blog_post['status']))): ?>

                            <label><input name="permalink_auto" value="auto" type="radio">Auto</label>
                            <label><input name="permalink_auto" value="manual" type="radio" checked="">Manual</label>

                            <input name="permalink_old" type="hidden" value="<?php echo (!empty($blog_post['permalink']) ? $blog_post['permalink'] : '') ?>">
                            <input onClick="this.select();" autocomplete="off"
                            value="<?php echo (!empty($blog_post['permalink']) ? $blog_post['permalink'] : '') ?>"
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

                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse" id="stage-category">

                        <select name="id_category" class="select2category">
                            <option></option>
                            <?php
                            foreach ($categorys as $category) {
                                if (!empty($blog_post['id_category']) AND $blog_post['id_category'] == $category['id']) {
                                    echo "<option value='".$category['id']."' selected>".$category['name']."</option>";
                                }else {
                                    echo "<option value='".$category['id']."'>".$category['name']."</option>";
                                }
                            }

                            ?>
                        </select>

                        <?php if (!empty($blog_post['id_category'])): ?>
                            <input type="hidden" name="id_category_old" value="<?php echo (!empty($blog_post['id_category']) ? $blog_post['id_category'] : '') ?>">
                        <?php endif ?>

                        <a class="btn-remove-category u-mv-small c-btn c-btn--danger c-btn--custom c-btn--small" href="javascript:;">
                            <i class="fa fa-trash"></i>
                        </a>

                    </div>

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-description" aria-expanded="false" aria-controls="stage-description">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">description</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>

                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse" id="stage-description">

                        <textarea rows="3" class="c-input" name="description" id="description" placeholder="description"><?php echo (!empty($blog_post['description']) ? $blog_post['description'] : '') ?></textarea>

                    </div>

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-image" aria-expanded="false" aria-controls="stage-image">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">image</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>

                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse" id="stage-image">

                        <div class="c-field u-mb-small">
                            <img data-default_image='<?php echo base_url('storage/assets/app/img/preview-image.jpg') ?>' data-base_url='<?php echo base_url('storage/uploads/medium/') ?>' id='preview-image' style="width: 100%;max-height: 160px" src="<?php echo (!empty($blog_post['image'])) ? base_url('storage/uploads/medium/'.$blog_post['image']) : base_url('storage/assets/app/img/preview-image.jpg') ?>" alt="Image">
                        </div>

                        <div class="c-field has-addon-right">
                            <input value="<?php echo (!empty($blog_post['image']) ? $blog_post['image'] : '') ?>" require name="image" class="c-input" id="image" type="text">
                            <span class="u-ml-auto c-field__addon">
                                <button id='button-filemanager' data-src="<?php echo base_url(PATH_FILE_MANAGER."?type=1&relative_url=1&multiple=0&field_id=image&akey=".$this->session->userdata('key')) ?>" class="c-btn c-btn--fancy u-p-xsmall" type="button" data-toggle="modal" data-target="#modal-filemanager">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>

                        <a class="btn-remove-image u-mv-small c-btn c-btn--danger c-btn--custom c-btn--small" href="javascript:;">
                            <i class="fa fa-trash"></i>
                        </a>

                    </div>   

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-time" aria-expanded="false" aria-controls="stage-time">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">time</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>

                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse" id="stage-time">

                        <input value="<?php echo (!empty($blog_post['time']) ? $blog_post['time'] : date('Y-m-d H:i')) ?>"
                        autocomplete="off" id="datetimepicker" class="c-input" name="time"
                        id="time" type="text" placeholder="time">

                    </div>                 

                    <div class="c-stage__header o-media u-justify-start collapsed u-pv-xsmall u-ph-small" data-toggle="collapse" href="#stage-tags" aria-expanded="false" aria-controls="stage-tags">
                        <div class="c-stage__header-title o-media__body">
                            <h6 class="u-mb-zero">tags</h6>
                        </div>
                        <div class="c-stage__icon o-media__img u-ml-auto u-mr-zero">
                            <i class="fa fa-info"></i>
                        </div>
                    </div>

                    <div data-parent="#accordion" class="c-stage__panel u-p-xsmall collapse" id="stage-tags">

                        <select name="id_tags[]" multiple class="c-select--multiple select2tags">
                            <?php
                            foreach ($tags as $key => $tag) {
                                $selected = false;
                                if (!empty($blog_post['id_tags'])) {
                                    $selected = (in_array($tags[$key]['id'],explode(',',$blog_post['id_tags'])) ? 'selected="selected"' : ''); 
                                }
                                echo "<option value='".$tag['id']."' ".$selected.">".$tag['name']."</option>";
                            }
                            ?>
                        </select>

                        <input type="hidden" name="id_tags_old" value="<?php echo (!empty($blog_post['id_tags']) ? $blog_post['id_tags'] : '') ?>">

                    </div>                    

                </div><!-- .c-stage -->

            </div>

        </div>

    </div>

</form>

</div>

<?php $this->load->view('app/_layouts/modal_filemanager'); ?>
<?php $this->load->view('app/_layouts/footer'); ?>