<div class="col-xl-3 u-hidden-down@desktop">
	<aside class="c-menu u-mb-small">

		<div class="u-hidden-down@desktop">		
			<h4 class="c-menu__title u-h4">Menu</h4>
			<ul>
				<li class="c-menu__item">
					<a class="c-menu__link <?php echo ($this->uri->segment(2) == 'profile') ? 'is-active' : '' ?>" href="<?php echo base_url('user/profile') ?>">
						<i class="fa fa-user u-mr-xsmall"></i><?php echo $this->lang->line('my_profile') ?>
					</a>
				</li>
				<li class="c-menu__item">
					<a class="c-menu__link <?php echo ($this->uri->segment(2) == 'courses') ? 'is-active' : '' ?>" href="<?php echo base_url('user/courses') ?>">
						<i class="fa fa-book u-mr-xsmall <?php echo ($this->uri->segment(2) == 'courses') ? '' : 'u-color-info' ?>"></i>
						<?php echo $this->lang->line('my_courses') ?>
					</a>
				</li>
				<li class="c-menu__item">
					<a class="c-menu__link <?php echo ($this->uri->segment(2) == 'wishlist') ? 'is-active' : '' ?>" href="<?php echo base_url('user/wishlist') ?>">
						<i class="fa fa-heart u-color-danger u-mr-xsmall"></i>
						<?php echo $this->lang->line('my_wishlist') ?>
					</a>
				</li>
				<li class="c-menu__item">
					<a class="c-menu__link <?php echo ($this->uri->segment(2) == 'order') ? 'is-active' : '' ?>" href="<?php echo base_url('user/order') ?>">
						<i class="fa fa-shopping-cart u-color-success u-mr-xsmall"></i>
						<?php echo $this->lang->line('my_order') ?>
					</a>
				</li>					
			</ul>
		</div>

		<!-- <div class="u-hidden-up@desktop">		

			<h4 class="u-h4">Menu</h4>

			<select id="selectmenu" class="select2">
				<option value=""></option>

				<option <?php echo ($this->uri->segment(2) == 'profile') ? 'selected' : '' ?> value="<?php echo base_url('user/profile') ?>">
					<i class="fa fa-user u-mr-xsmall"></i><?php echo $this->lang->line('my_profile') ?>
				</option>


				<option <?php echo ($this->uri->segment(2) == 'courses') ? 'selected' : '' ?> value="<?php echo base_url('user/courses') ?>">
					<i class="fa fa-book u-mr-xsmall"></i><?php echo $this->lang->line('my_courses') ?>
				</option>


				<option <?php echo ($this->uri->segment(2) == 'wishlist') ? 'selected' : '' ?> value="<?php echo base_url('user/wishlist') ?>">
					<i class="fa fa-star u-mr-xsmall"></i><?php echo $this->lang->line('my_wishlist') ?>
				</option>


				<option <?php echo ($this->uri->segment(2) == 'order') ? 'selected' : '' ?> value="<?php echo base_url('user/order') ?>">
					<i class="fa fa-shopping-cart u-mr-xsmall"></i><?php echo $this->lang->line('my_order') ?>
				</option>

			</select>
		</div> -->
	</aside>
</div>