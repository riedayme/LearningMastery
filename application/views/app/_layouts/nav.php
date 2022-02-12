<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(1)=="app" and empty($this->uri->segment(2)) or $this->uri->segment(2) == 'dashboard'){echo "is-active";}?>" href="<?php echo base_url('app/dashboard') ?>">
		<i class="fa fa-fire u-mr-xsmall"></i>Dashboard
	</a>
</li>

<h4 class="c-sidebar__title">LMS</h4>

<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='lms_courses' or $this->uri->segment(2)=='lms_courses' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/lms_courses') ?>">
		<i class="fa fa-send-o u-mr-xsmall"></i>Courses
	</a>
</li>

<li class="c-sidebar__item has-submenu <?php if(strpos($this->uri->segment(2), "lms_") !== FALSE){echo "is-open";}?>">
	<a class="c-sidebar__link collapsed" data-toggle="collapse" href="#lms-submenu" aria-expanded="false" aria-controls="lms-submenu">
		<i class="fa fa-caret-square-o-down u-mr-xsmall"></i>Part of LMS
	</a>
	<ul class="c-sidebar__submenu collapse <?php if(strpos($this->uri->segment(2), "lms_") !== FALSE){echo "show";}?>" id="lms-submenu">

		<li><a class="c-sidebar__link" href="<?php echo base_url('app/lms_category') ?>">
			Category
			<?php if (strpos($this->uri->segment(2), "lms_category") !== FALSE): ?>
				<i class="fa fa-check u-ml-xsmall"></i>
			<?php endif ?>
		</a></li>

		<li><a class="c-sidebar__link" href="<?php echo base_url('app/lms_template') ?>">
			Template
			<?php if (strpos($this->uri->segment(2), "lms_template") !== FALSE): ?>
				<i class="fa fa-check u-ml-xsmall"></i><?php endif ?>
			</a>
		</li>
		<li><a class="c-sidebar__link" href="<?php echo base_url('app/lms_coupon') ?>">
			Coupon
			<?php if (strpos($this->uri->segment(2), "lms_coupon") !== FALSE): ?>
				<i class="fa fa-check u-ml-xsmall"></i>
			<?php endif ?>
		</a></li>
		<!-- <li><a class="c-sidebar__link" href="<?php echo base_url('app/lms_widget') ?>">
			Widget
			<?php if (strpos($this->uri->segment(2), "lms_widget") !== FALSE): ?>
				<i class="fa fa-check u-ml-xsmall"></i><?php endif ?>
			</a>
		</li> -->

	</ul>
</li>


<h4 class="c-sidebar__title">Blog</h4>

<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='blog_post' or $this->uri->segment(2)=='blog_post' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/blog_post') ?>">
		<i class="fa fa-send-o u-mr-xsmall"></i>Post
	</a>
</li>

<li class="c-sidebar__item has-submenu <?php if(strpos($this->uri->segment(2), "blog_") !== FALSE){echo "is-open";}?>">
	<a class="c-sidebar__link collapsed" data-toggle="collapse" href="#blog-submenu" aria-expanded="false" aria-controls="blog-submenu">
		<i class="fa fa-caret-square-o-down u-mr-xsmall"></i>Part of Blog
	</a>
	<ul class="c-sidebar__submenu collapse <?php if(strpos($this->uri->segment(2), "blog_") !== FALSE){echo "show";}?>" id="blog-submenu">
		
		<?php if ($this->site['blog_comment']['type'] == 'system'): ?>
			<li><a class="c-sidebar__link" href="<?php echo base_url('app/blog_post_comment') ?>">
				Comment
				<?php if (strpos($this->uri->segment(2), "blog_post_comment") !== FALSE): ?>
					<i class="fa fa-check u-ml-xsmall"></i><?php endif ?>
				</a>
			</li>
		<?php endif ?>

		<li><a class="c-sidebar__link" href="<?php echo base_url('app/blog_template') ?>">
			Template
			<?php if (strpos($this->uri->segment(2), "blog_template") !== FALSE): ?>
				<i class="fa fa-check u-ml-xsmall"></i><?php endif ?>
			</a>
		</li>
		<li><a class="c-sidebar__link" href="<?php echo base_url('app/blog_widget') ?>">
			Widget
			<?php if (strpos($this->uri->segment(2), "blog_widget") !== FALSE): ?>
				<i class="fa fa-check u-ml-xsmall"></i><?php endif ?>
			</a>
		</li>
	</ul>
</li>

<h4 class="c-sidebar__title">Pages</h4>

<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='site_pages' or $this->uri->segment(2)=='site_pages' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/site_pages') ?>">
		<i class="fa fa-file u-mr-xsmall"></i>Pages
	</a>
</li>

<h4 class="c-sidebar__title">User</h4>

<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='user' or $this->uri->segment(2)=='user' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/user') ?>">
		<i class="fa fa-user-circle u-mr-xsmall"></i>User
	</a>
</li>

<?php if ($this->site['payment_method'] == 'Manual'): ?>
<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='user_invoice' or $this->uri->segment(2)=='user_invoice' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/user_invoice') ?>">
		<i class="fa fa-shopping-cart u-mr-xsmall"></i>Invoice
	</a>
</li>
<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='user_invoice_history' or $this->uri->segment(2)=='user_invoice_history' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/user_invoice_history') ?>">
		<i class="fa fa-clock-o u-mr-xsmall"></i>Invoice History
	</a>
</li>
<?php endif ?>

<h4 class="c-sidebar__title">Settings</h4>

<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='setting_general' or $this->uri->segment(2)=='setting_general' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/setting_general') ?>">
		<i class="fa fa-cog u-mr-xsmall"></i>General
	</a>
</li>
<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='setting_meta' or $this->uri->segment(2)=='setting_meta' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/setting_meta') ?>">
		<i class="fa fa-bug u-mr-xsmall"></i>Meta
	</a>
</li>
<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='setting_api_key' or $this->uri->segment(2)=='setting_api_key' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/setting_api_key') ?>">
		<i class="fa fa-key u-mr-xsmall"></i>Api Key
	</a>
</li>
<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='setting_smtp' or $this->uri->segment(2)=='setting_smtp' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/setting_smtp') ?>">
		<i class="fa fa-envelope u-mr-xsmall"></i>SMTP
	</a>
</li>
<li class="c-sidebar__item">
	<a class="c-sidebar__link <?php if($this->uri->segment(2)=='setting_payment' or $this->uri->segment(2)=='setting_payment' and $this->uri->segment(3) == 'create' ){echo "is-active";}?>" href="<?php echo base_url('app/setting_payment') ?>">
		<i class="fa fa-dollar u-mr-xsmall"></i>Payment
	</a>
</li>