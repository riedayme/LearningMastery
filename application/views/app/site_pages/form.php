<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
    <form action="<?php echo base_url('app/site_pages/process') ?>" class="row" method="post" enctype="multipart/form-data">

        <div class="col-12 col-xl-9 col-lg-9 u-mb-small">

            <div class="c-card c-card--responsive u-p-zero">
                <div class="c-card__header c-card__header--transparent o-line">
                    <button class="c-btn c-btn--info c-btn--custom" name="publish" type="submit" title="publish">
                        <i class="fa fa-send-o" aria-hidden="true"></i>
                    </button>
                    <?php if (!empty($site_pages)): ?>
                        <button class="u-ml-small c-btn c-btn--primary c-btn--custom" type="submit" name="save" title="save" value="<?php echo uri_string(); ?>">
                            <i class="fa fa-save" aria-hidden="true"></i>
                        </button>
                    <?php endif ?>

                    <?php if (!empty($site_pages)): ?>
                        <input type="hidden" name="id" value="<?php echo (!empty($site_pages['id']) ? $site_pages['id'] : '') ?>">
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
                        value="<?php echo (!empty($site_pages['title']) ? $site_pages['title'] : '') ?>" required
                        class="c-input" name="title" id="title" type="text"
                        placeholder="title">
                    </div>

                    <div class="c-field">
                        <textarea required class="editor" name="content">
                            <?php echo (!empty($site_pages['content']) ? $site_pages['content'] : '') ?>
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
                <div class="c-card__body u-p-small">

                    <div class="c-field u-mb-small">
                        <label class="c-field__label">permalink : </label>

                        <?php if ((empty($site_pages['status']))): ?>
                            <label><input name="permalink_auto" value="auto" type="radio" checked="">Auto</label>
                            <label><input name="permalink_auto" value="manual" type="radio">Manual</label>

                            <input name="permalink_old" type="hidden" value="<?php echo (!empty($site_pages['permalink']) ? $site_pages['permalink'] : '') ?>">
                            <input onClick="this.select();" autocomplete="off"
                            value="<?php echo (!empty($site_pages['permalink']) ? $site_pages['permalink'] : '') ?>"
                            class="c-input" name="permalink" id="permalink"
                            type="hidden" placeholder="permalink">
                            <?php else: ?>

                                <label><input name="permalink_auto" value="auto" type="radio">Auto</label>
                                <label><input name="permalink_auto" value="manual" type="radio" checked="">Manual</label>

                                <input name="permalink_old" type="hidden" value="<?php echo (!empty($site_pages['permalink']) ? $site_pages['permalink'] : '') ?>">
                                <input onClick="this.select();" autocomplete="off"
                                value="<?php echo (!empty($site_pages['permalink']) ? $site_pages['permalink'] : '') ?>"
                                class="c-input" name="permalink" id="permalink"
                                type="text" placeholder="permalink">                    
                            <?php endif ?>
                        </div>
                    </div>

                </div>

            </div>

        </form>

    </div>

    <?php $this->load->view('app/_layouts/footer'); ?>