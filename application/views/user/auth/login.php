<?php $this->load->view('app/_layouts/header'); ?>

<div class="o-page__card o-page__card--horizontal">
    <div class="c-card c-login-horizontal u-mb-xsmall">
        <div class="c-login__content-wrapper">
            <header class="c-login__header">
                <a title='<?php echo $site['title'] ?>' class="c-login__icon c-login__icon--rounded c-login__icon--left" href="<?php echo base_url() ?>">
                    <img src="<?php echo base_url('storage/assets/lms/default-app/img/logo-square.png') ?>" alt="<?php echo $site['title'] ?>">
                </a>

                <h2 class="c-login__title"><?php echo $this->lang->line('sign_in') ?></h2>

            </header>

            <form class="c-login__content" action="<?php echo base_url('auth/process') ?>" method="POST">

                <?php $this->load->view('app/_layouts/alert'); ?>

                <div class="c-field u-mb-small">
                    <label class="c-field__label">
                        <?php echo $this->lang->line('email') ?>
                    </label> 
                    <input required="" autofocus="" name="email" class="c-input" type="email" placeholder="<?php echo $this->lang->line('email') ?>"> 
                </div>

                <div class="c-field u-mb-small">
                    <label class="c-field__label"><?php echo $this->lang->line('password') ?></label> 
                    <input required="" name='password' class="c-input" type="password" placeholder="<?php echo $this->lang->line('password') ?>"> 
                </div>

                <?php if (!empty($this->input->get('redirect'))): ?>
                    <input type="hidden" name="redirect" value="<?php echo strip_tags($this->input->get('redirect')) ?>">
                <?php endif ?>

                <input type="hidden" name="csrf_code" value="<?php echo $this->session->userdata('csrf_code') ?>">
                <button class="c-btn c-btn--info c-btn--fullwidth" type="submit">
                    <?php echo $this->lang->line('sign_in') ?>
                </button>

                <span class="c-divider has-text c-divider--small u-mv-medium"><?php echo $this->lang->line('sign_in_by_sosmed') ?></span>

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

        <div class="c-login__content-image">
            <img src="<?php echo base_url('storage/assets/lms/default-app/img/bg.svg') ?>" alt="<?php echo $site['title'] ?>">

            <h3><?php echo $site['title'] ?></h3>
            <p class="u-text-large">
                <?php echo $site['description'] ?>
            </p>
        </div>
    </div>

    <div class="o-line">
        <a class="u-text-mute u-text-small" title='<?php echo $this->lang->line('register') ?>' href="<?php echo base_url('auth/register') ?>">
        <i class="fa fa-long-arrow-left u-mr-xsmall"></i> <?php echo $this->lang->line('register') ?>
        </a>
    </div>
</div>

<?php $this->load->view('lms/default-app/_layouts/footer'); ?>