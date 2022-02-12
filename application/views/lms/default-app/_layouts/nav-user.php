<?php if ($this->session->userdata('user')): ?>
    <div class="c-dropdown dropdown">
        <a  class="c-avatar c-avatar--xsmall has-dropdown dropdown-toggle" href="javascript:;" id="dropdwonMenuAvatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="c-avatar__img" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo (!empty($this->session->userdata('photo')) ?  base_url('storage/uploads/user/photo/'.$this->session->userdata('photo')) : base_url('storage/uploads/user/photo/default.png')) ?>" alt="<?php echo $this->session->userdata('username') ?>">
        </a>

        <div class="c-dropdown__menu dropdown-menu dropdown-menu-right" aria-labelledby="dropdwonMenuAvatar">
            <a class="c-dropdown__item dropdown-item" href="<?php echo base_url('user/profile') ?>">
                <i class="fa fa-user u-mr-xsmall"></i>
                <?php echo $this->lang->line('my_profile') ?>
            </a>
            <a class="c-dropdown__item dropdown-item" href="<?php echo base_url('user/courses') ?>">
                <i class="fa fa-book u-mr-xsmall <?php echo ($this->uri->segment(2) == 'courses') ? '' : 'u-color-info' ?>"></i>
                <?php echo $this->lang->line('my_courses') ?>
            </a>
            <a class="c-dropdown__item dropdown-item" href="<?php echo base_url('user/wishlist') ?>">
                <i class="fa fa-heart u-color-danger u-mr-xsmall"></i>
                <?php echo $this->lang->line('my_wishlist') ?>
            </a>
            <a class="c-dropdown__item dropdown-item" href="<?php echo base_url('user/order') ?>">
                <i class="fa fa-shopping-cart u-color-success u-mr-xsmall"></i>
                <?php echo $this->lang->line('my_order') ?>
            </a>
            <a class="c-dropdown__item dropdown-item" href="<?php echo base_url('auth/process_logout') ?>">
                <i class="fa fa-sign-out u-mr-xsmall"></i>
                <?php echo $this->lang->line('sign_out') ?>
            </a>
        </div>
    </div>
    <?php endif ?>