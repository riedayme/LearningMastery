<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 col-xl-8 offset-xl-2 u-mv-small">

    <form action="<?php echo base_url('app/lms_courses/process_lesson') ?>"  method="post" enctype="multipart/form-data">

        <?php $this->load->view('app/_layouts/alert'); ?>

        <div class="c-stage u-mb-zero">

            <div class="c-stage__header o-media u-justify-start">
                <div class="c-stage__header-title o-media__body">
                    <?php if (!empty($lesson)): ?>
                        <input name="id" type="hidden" value="<?php echo $lesson['id'] ?>">
                    <?php endif ?>     
                    <input type="hidden" name="id_courses" value="<?php echo $data['courses_id']; ?>">   
                    <input type="hidden" name="id_section" value="<?php echo $data['section_id']; ?>">
                    <button type="submit" class="c-btn c-btn--info c-btn--custom"> 
                        <i class="fa fa-send-o" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

            <div class="c-stage__panel u-p-zero">

                <div class="row">
                    <div class="col-12 col-lg-12">                        
                        <div class="c-field u-ph-medium u-pv-small">
                            <label class="c-field__label">title : </label>
                            <input autofocus="" required class="c-input" name="title" type="text" placeholder="title" value="<?php echo (!empty($lesson['title']) ? $lesson['title'] : '') ?>">
                        </div>
                    </div>

                    <div class="col-12 col-lg-12">                        
                        <div class="c-field u-ph-medium u-pv-small u-mb-small">
                            <label class="c-field__label">type : </label>

                            <select required name="type" class="select2-search">
                                <option></option>
                                <option <?php echo (!empty($lesson['type']) AND $lesson['type'] == 'Text') ? 'selected' : ''; ?> value="Text">Text</option>
                                <option <?php echo (!empty($lesson['type']) AND $lesson['type'] == 'Video') ? 'selected' : ''; ?> value="Video">Video</option>
                                <option <?php echo (!empty($lesson['type']) AND $lesson['type'] == 'Image') ? 'selected' : ''; ?> value="Image">Image</option>
                            </select>
                        </div>  
                    </div>     

                    <div class="col-12 col-lg-12">                        
                        <div class="c-field">
                            <textarea required class="editor" name="content">
                                <?php echo (!empty($lesson['content']) ? $lesson['content'] : '') ?>
                            </textarea>
                        </div>                  
                    </div>

                </div>

            </div>
        </div>

    </form>

</div>

<?php $this->load->view('app/_layouts/modal_filemanager'); ?>
<?php $this->load->view('app/_layouts/footer'); ?>