<div class="container u-ph-small">
    <div class="row u-mt-small u-p-zero">
        <div class="col-12 col-xl-10 offset-xl-1 col-lg-8 offset-lg-2">

            <div class="c-card u-p-medium">  
                <h3 class="u-mb-small">                   
                    <?php echo $this->lang->line('material_list') ?>
                </h3>        

                <?php if (!empty($courses['all_data'])): ?>
                    <div class="ok">
                        <article class="c-stage u-mb-zero">
                            <?php 
                            $number_section = 1;
                            foreach ($courses['all_data'] as $courses_data): ?>

                            <!-- section -->
                            <div class="c-stage__header u-flex u-justify-between u-p-xsmall" data-toggle="collapse" href="#stage-panel-<?php echo $courses_data['id_section'] ?>" aria-expanded="false" aria-controls="stage-panel-<?php echo $courses_data['id_section'] ?>">

                                <div class="o-media">   
                                    <div class="c-stage__icon o-media__img">
                                        <?php echo $number_section++ ?>
                                    </div>                                   
                                    <div class="c-stage__header-title o-media__body u-text-bold">
                                        <?php echo $courses_data['title_section'] ?>
                                    </div>
                                </div>
                                <div>
                                    <div class="c-stage__icon o-media__img">
                                        <i class="fa fa-info"></i>
                                    </div>
                                </div>

                            </div>

                            <div class="c-stage__panel u-p-xsmall collapse show" id="stage-panel-<?php echo $courses_data['id_section'] ?>">

                                <?php foreach ($courses_data['lesson'] as $lesson): ?>                    
                                    <?php if (!empty($lesson)): ?>
                                        <div class="c-stage__header u-justify-start u-bg-secondary u-p-xsmall cursor-default">
                                            <h6 class="u-mb-zero u-text-dark o-line">
                                                <?php if ($lesson['type'] == 'Text'): ?>
                                                    <i class="fa fa-file-text-o u-mr-xsmall"></i>
                                                <?php endif ?>
                                                <?php if ($lesson['type'] == 'Image'): ?>
                                                    <i class="fa fa-picture-o u-mr-xsmall"></i>
                                                <?php endif ?>
                                                <?php if ($lesson['type'] == 'Video'): ?>
                                                    <i class="fa fa-youtube-play u-mr-xsmall"></i>
                                                <?php endif ?>
                                                <?php if ($lesson['type'] == 'File'): ?>
                                                    <i class="fa fa-zip-o u-mr-xsmall"></i>
                                                <?php endif ?>
                                                <?php echo $lesson['title'] ?>
                                            </h6>
                                        </div>
                                    <?php endif ?>
                                    <?php if (empty($lesson)): ?>
                                        <div class="c-alert u-bg-secondary u-text-dark u-mb-zero">
                                            <?php echo $this->lang->line('no_material') ?>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>

                            </div>
                            <!-- section -->

                        <?php endforeach ?>   
                    </article> 
                </div>
            <?php endif ?>
            <?php if (empty($courses['all_data'])): ?>
                <div class="c-alert u-bg-secondary u-text-dark u-mb-zero">
                    <?php echo $this->lang->line('no_material') ?>
                </div>
            <?php endif ?>
        </div>

    </div>
</div>
</div>