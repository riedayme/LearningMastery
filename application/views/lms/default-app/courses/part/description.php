<div class="container u-ph-small">
    <div class="row u-mt-small u-p-zero">
        <div class="col-12 col-xl-10 offset-xl-1 col-lg-8 offset-lg-2">

            <div class="c-card u-p-medium">  
                <h3 class="u-mb-small">
                    <?php echo $this->lang->line('description') ?>
                </h3>        
                <?php if (!empty($courses['description'])): ?>
                    <div class="post-body">
                        <?php echo $courses['description']; ?> 
                    </div>
                <?php endif ?>
                <?php if (empty($courses['description'])): ?>
                    <div class="c-alert u-bg-secondary u-text-dark">
                        <?php echo $this->lang->line('no_description') ?>
                    </div>                   
                <?php endif ?>                 
            </div>

        </div>
    </div>
</div>