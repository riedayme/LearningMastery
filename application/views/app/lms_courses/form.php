<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 u-mv-small">
    <div class="c-tabs">

        <?php $this->load->view('app/_layouts/alert'); ?>

        <ul class="c-tabs__list c-tabs__list--splitted nav nav-tabs" role="tablist">
            <li class="c-tabs__item"><a id='tab-courses' class="c-tabs__link u-pv-xsmall u-ph-small u-text-small <?php echo (empty($this->input->get('tab')) OR $this->input->get('tab') == 'courses') ? 'active show' : '' ?>" id="nav-courses-tab" data-toggle="tab" href="#nav-courses" role="tab" aria-controls="nav-courses" aria-selected="false">Courses</a></li>
            <?php if (!empty($data)): ?>
                <li class="c-tabs__item"><a id='tab-material' class="c-tabs__link u-pv-xsmall u-ph-small u-text-small <?php echo (!empty($this->input->get('tab')) AND $this->input->get('tab') == 'material') ? 'active show' : '' ?>" id="nav-material-tab" data-toggle="tab" href="#nav-material" role="tab" aria-controls="nav-material" aria-selected="false">Material</a></li>
            <?php endif ?>
        </ul>

        <div class="c-tabs__content tab-content" id="nav-tabContent">

            <div class="c-tabs__pane u-p-medium u-pt-large <?php echo (empty($this->input->get('tab')) OR $this->input->get('tab') == 'courses') ? 'active show' : '' ?>" id="nav-courses" role="tabpanel" aria-labelledby="nav-courses-tab">
                <?php $this->load->view('app/lms_courses/form-courses'); ?>
            </div>  

            <?php if (!empty($data)): ?>
                <div class="c-tabs__pane u-p-medium u-pt-large <?php echo (!empty($this->input->get('tab')) AND $this->input->get('tab') == 'material') ? 'active show' : '' ?>" id="nav-material" role="tabpanel" aria-labelledby="nav-material-tab">
                    <?php $this->load->view('app/lms_courses/form-material'); ?>
                </div> 
            <?php endif ?>     

        </div>

    </div>
</div>

<?php if (!empty($data)): ?>
    <?php $this->load->view('app/lms_courses/form-section',$data); ?>
<?php endif ?>

<?php if (!empty($section)): ?>
    <?php $this->load->view('app/lms_courses/form-section-sort',['section' => $section]); ?>
    <?php 
    $no_section = 1;
    foreach ($section as $section_data): ?>   
    <?php  
    $lesson = $this->M_LMS_Courses->data_lesson($section_data['id']);
    ?>                                        
    <?php if (!empty($lesson)): ?>
        <?php $this->load->view('app/lms_courses/form-lesson-sort',[
            'data' => $data, 
            'section' => $section_data,
            'lesson' => $lesson
            ]); ?>
        <?php endif ?> 
    <?php endforeach ?>
<?php endif ?>

<?php $this->load->view('app/_layouts/modal_filemanager'); ?>
<?php $this->load->view('app/_layouts/footer'); ?>