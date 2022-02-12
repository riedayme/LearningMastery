<?php $this->load->view('app/_layouts/header'); ?>

<div class="o-page__card">
    <div class="c-card u-mb-xsmall">
        <header class="c-card__header u-pt-large">
            <a class="c-card__icon" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url('storage/assets/lms/default-app/img/logo-square.png') ?>" alt="<?php echo $site['title'] ?>">
            </a>
            <h1 class="u-h3 u-text-center u-mb-zero">
                <?php echo $this->lang->line('register') ?>
            </h1>
        </header>

        <form class="c-card__body using-captcha" action="<?php echo base_url('auth/register') ?>" method="POST">

            <?php $this->load->view('app/_layouts/alert'); ?>

            <div class="c-field u-mb-small">
                <label class="c-field__label"><?php echo $this->lang->line('full_name') ?></label> 
                <input required='' value="<?php echo set_value('full_name'); ?>" autofocus="" name='full_name' class="c-input" type="text" placeholder="<?php echo $this->lang->line('full_name') ?>">
                <?php echo form_error('full_name', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
            </div>  

            <div class="c-field u-mb-small">
                <label class="c-field__label">
                    <?php echo $this->lang->line('email') ?>
                </label> 
                <input required='' value="<?php echo set_value('email'); ?>" value="" name="email" class="c-input" type="email" placeholder="<?php echo $this->lang->line('email') ?>"> 
                <?php echo form_error('email', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
            </div>               

            <div class="c-field u-mb-small">
                <label class="c-field__label"><?php echo $this->lang->line('no_handphone') ?></label> 
                <input required='' value="<?php echo set_value('no_handphone'); ?>" name='no_handphone' class="c-input" type="number" placeholder="<?php echo $this->lang->line('no_handphone') ?>"> 
                <?php echo form_error('no_handphone', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
            </div>    

            <div class="u-mb-small">
                <label class="c-field__label"><?php echo $this->lang->line('password') ?></label>
                <div class="c-field has-addon-right">
                    <input required='' value="<?php echo set_value('password'); ?>" id='password' name="password" class="c-input" type="password">
                    <button tabindex="-1" type="button" class="c-field__addon" onclick="toggle('password',this)">
                        <i class="fa fa-eye-slash"></i>
                    </button>
                </div>
                <?php echo form_error('password', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
            </div>

            <div class="u-mb-small">
                <label class="c-field__label"><?php echo $this->lang->line('password_confirm') ?></label>
                <div class="c-field has-addon-right">
                    <input required='' value="<?php echo set_value('password_confirm'); ?>" id='password_confirm' name="password_confirm" class="c-input" type="password">
                    <button tabindex="-1" type="button" class="c-field__addon" onclick="toggle('password_confirm',this)">
                        <i class="fa fa-eye-slash"></i>
                    </button>
                </div>                                                         
                <?php echo form_error('password_confirm', '<small class="c-field__message u-color-danger"><i class="fa fa-times-circle"></i>', '</small>'); ?> 
            </div>

            <?php if ($site['google_recaptcha']['status'] == 'Yes'): ?>
                <div class="g-recaptcha u-mb-medium" data-sitekey="<?php echo $site['google_recaptcha']['site_key'] ?>" data-callback="recaptchaCallback"></div>  
            <?php endif ?>
            
            <input type="hidden" name="csrf_code" value="<?php echo $this->session->userdata('csrf_code') ?>">
            <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">
                <?php echo $this->lang->line('register') ?>
            </button>

            <span class="c-divider has-text c-divider--small u-mv-medium"><?php echo $this->lang->line('register_by_sosmed') ?></span>

            <div class="u-text-center">
                <a class="c-icon u-bg-facebook" href="<?php echo base_url('auth/facebook') ?>">
                    <i class="fa fa-facebook"></i>
                </a>

                <a class="c-icon u-bg-danger" href="<?php echo base_url('auth/google') ?>">
                    <i class="fa fa-google"></i>
                </a>
            </div>
        </form>
    </div>


    <div class="o-line">
        <a class="u-text-mute u-text-small" title='<?php echo $this->lang->line('sign_in') ?>' href="<?php echo base_url('auth') ?>">
            <i class="fa fa-long-arrow-left u-mr-xsmall"></i> <?php echo $this->lang->line('sign_in') ?>
        </a>
    </div>

</div>

<?php $this->load->view('lms/default-app/_layouts/footer'); ?>