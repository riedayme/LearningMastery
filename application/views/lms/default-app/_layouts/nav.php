 <header class="u-bg-white">
    <div class="container">
        <div class="row ">

            <div class="col-12">
                <div class="c-navbar u-border-bottom-zero u-p-zero">

                    <a class="u-text-center u-mr-medium" href="<?php echo base_url() ?>" title='<?php echo $site['title'] ?>'>
                        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo base_url('storage/assets/lms/default-app/img/logo.png') ?>" alt="<?php echo $site['title'] ?>" style="width: 120px;">
                    </a>

                    <h1 class="u-h3 navbar__title u-text-bold u-hidden-visually"><?php echo $site['title'] ?></h1>

                    <div class="u-ml-auto u-hidden-up@tablet"></div>
                    <form class='u-width-50 u-hidden-down@tablet' action="<?php echo base_url('courses-filter') ?>" method="GET">
                        <div class="c-field has-icon-right">
                            <span class="c-field__icon">
                                <i class="fa fa-search"></i> 
                            </span>

                            <label class="u-hidden-visually" for="navbar-search"><?php echo $this->lang->line('search') ?></label>
                            <input onclick="this.select()" value='<?php echo (!empty($this->input->get('q')) ? $this->input->get('q') : '') ?>' class="c-input" id="navbar-search" type="text" name="q" placeholder="<?php echo $this->lang->line('search') ?>">
                        </div>
                    </form>                   

                    <!-- Navigation items that will be collapes and toggle in small viewports -->
                    <nav class="c-nav collapse u-ml-auto" id="main-nav">
                        <ul class="c-nav__list">
                            <li class="c-nav__item">
                                <a class="c-nav__link" href="<?php echo base_url() ?>" title='<?php echo $this->lang->line('home') ?>'><?php echo $this->lang->line('home') ?></a>
                            </li>
                            <?php if (empty($this->session->userdata('user'))): ?>
                                <li class="c-nav__item u-flex">
                                    <a class="c-nav__link" href="<?php echo base_url('auth') ?>" title='<?php echo $this->lang->line('sign_in') ?>'>
                                        <?php echo $this->lang->line('sign_in') ?>                                        
                                    </a>
                                    <span class="c-nav__link u-mh-xsmall">/</span>
                                    <a class="c-nav__link" href="<?php echo base_url('auth/register') ?>" title='<?php echo $this->lang->line('register') ?>'>
                                        <?php echo $this->lang->line('register') ?>                                        
                                    </a>                                    
                                </li>
                            <?php endif ?>                            
                            <li class="c-nav__item u-hidden-up@tablet">
                                <form action="<?php echo base_url('courses-filter') ?>" method="GET">
                                    <div class="c-field c-field--inline has-icon-right u-hidden-up@tablet">
                                        <span class="c-field__icon">
                                            <i class="fa fa-search"></i> 
                                        </span>

                                        <label class="u-hidden-visually"><?php echo $this->lang->line('search') ?></label>
                                        <input onclick="this.select()" value='<?php echo (!empty($this->input->get('q')) ? $this->input->get('q') : '') ?>' class="c-input" type="text" name="q" placeholder="<?php echo $this->lang->line('search') ?>">
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </nav>
                    <!-- // Navigation items  -->

                    <?php $this->load->view('lms/default-app/_layouts/nav-user'); ?>

                    <button class="c-nav-toggle " type="button" data-toggle="collapse" data-target="#main-nav">
                        <span class="c-nav-toggle__bar"></span>
                        <span class="c-nav-toggle__bar"></span>
                        <span class="c-nav-toggle__bar"></span>
                    </button><!-- // .c-nav-toggle -->

                </div>
            </div>

        </div>
    </div>
</header>