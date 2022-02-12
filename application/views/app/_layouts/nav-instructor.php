<li class="c-sidebar__item">
    <a class="c-sidebar__link <?php if($this->uri->segment(2)=='lms_courses' or $this->uri->segment(2)=='lms_courses' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/lms_courses') ?>">
        <span class="c-sidebar__icon">
            <i class="fa fa-send-o"></i>
        </span>Courses
    </a>
</li>

<?php if ($this->site['payment_method'] == 'Manual'): ?>
    
    <li class="c-sidebar__item">
        <a class="c-sidebar__link <?php if($this->uri->segment(2)=='user_invoice' or $this->uri->segment(2)=='user_invoice' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/user_invoice') ?>">
            <span class="c-sidebar__icon">
                <i class="fa fa-shopping-cart"></i>
            </span>Invoice
        </a>
    </li>

    <li class="c-sidebar__item">
        <a class="c-sidebar__link <?php if($this->uri->segment(2)=='user_invoice_history' or $this->uri->segment(2)=='user_invoice_history' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/user_invoice_history') ?>">
            <span class="c-sidebar__icon">
                <i class="fa fa-clock-o"></i>
            </span>Invoice History
        </a>
    </li>    

    <li class="c-sidebar__item">
        <a class="c-sidebar__link <?php if($this->uri->segment(2)=='setting_payment' or $this->uri->segment(2)=='setting_payment' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/setting_payment') ?>">
            <span class="c-sidebar__icon">
                <i class="fa fa-dollar"></i>
            </span>Payment
        </a>
    </li>
<?php endif ?>