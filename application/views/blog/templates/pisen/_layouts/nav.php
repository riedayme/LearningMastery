<header>
    <div class="header-wrapper">
        <div class="container">
            <div class="header-menu">
                <div class="row no-gutters align-items-center justify-content-center">
                    <div class="col-4 col-md-2">
                        <a class="logo" href="<?php echo base_url() ?>">
                            <img
                            style="max-width: 180px"
                            src="<?php echo $widget['logo']['content'] ?>" alt="logo"
                            title='logo'>
                        </a>
                    </div>
                    <div class="col-8 col-md-8">
                        <div class="mobile-menu">
                            <span id="search">
                                <a class="search-btn" href="javascript:;">
                                    <i class="fa fa-search">
                                    </i>
                                </a>
                            </span>
                            <a href="javascript:;" id="showMenu">
                                <i class="fa fa-bars">
                                </i>
                            </a>
                        </div>
                        <nav class="navigation">
                            <ul>
                                <li class="nav-item">
                                    <a title='Home' class="pisen-nav-link" href="<?php echo base_url() ?>"><?php echo $this->lang->line('home') ?></a>
                                </li>
                                 <li class="nav-item">
                                    <a title='Home' class="pisen-nav-link <?php if($this->uri->segment(1)=="blog"){echo "active";}?>" href="<?php echo base_url('blog') ?>"><?php echo $this->lang->line('blog') ?></a>
                                </li>
                                <?php  
                                if ($widget['menu_header']['content']) {
                                    foreach ($widget['menu_header']['content'] as $link) {
                                        ?>

                                        <li class="nav-item">
                                            <a class="pisen-nav-link <?php if($this->uri->segment(2)==$link['text']){echo "active";}?>" href="<?php echo $link['url'] ?>" title='<?php echo $link['text'] ?>'>
                                                <?php echo $link['text'] ?>
                                            </a>
                                        </li>

                                        <?php
                                    }
                                }
                                ?>  
                            </ul>
                        </nav>
                    </div>
                    <div class="col-0 col-xl-2">
                        <div class="menu-function">
                            <div id="search">
                                <a class="search-btn" href="#">
                                    <i class="fa fa-search">
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--End header-->