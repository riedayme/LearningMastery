<div class="c-stage u-m-zero u-border-bottom-zero">

	<div class="c-stage__header o-media u-justify-start cursor-default">
		<div class="c-stage__icon o-media__img">
			<i class="fa fa-info"></i>
		</div>
		<div class="c-stage__header-title o-media__body">
			<h6 class="u-mb-zero">Site Information</h6>
		</div>
	</div>

	<div class="c-stage__panel u-p-medium row">

		<div class="col-lg-6">
			<div class="c-field u-mb-medium">
				<label class="c-field__label">Title</label> 
				<input class="c-input" name="title" type="text" placeholder="title" value="<?php echo (!empty($site) ? $site['title'] : '') ?>"> 
			</div>

		</div>

		<div class="col-lg-6">

			<div class="c-field u-mb-medium">
				<label class="c-field__label">Slogan</label> 
				<input class="c-input" name="slogan" type="text" placeholder="slogan" value="<?php echo (!empty($site) ? $site['slogan'] : '') ?>"> 
			</div>

		</div>

		<div class="col-lg-12">

			<div class="c-field u-mb-medium">
				<label class="c-field__label">Description</label> 
				<textarea required="" class="c-input" name="description" placeholder="description"><?php echo (!empty($site) ? $site['description'] : '') ?></textarea>
			</div>

		</div>

		<div class="c-field u-mb-medium col-md-6">
			<label class="c-field__label">Language</label>
			<select required="" name="language" class="c-select select2">
				<option></option>
				<option value="english" <?php echo ($site['language'] == 'english') ? 'selected' : ''; ?>>English</option>
				<option value="indonesia" <?php echo ($site['language'] == 'indonesia') ? 'selected' : ''; ?>>Indonesia</option>
			</select>
		</div>						

		<?php $this->load->view('app/setting_general/part/timezone'); ?>	

		<div class="c-field u-mb-medium col-md-6">
			<label class="c-field__label">Using Cache ?</label>
			<select required="" name="cache" class="c-select select2">
				<option></option>
				<option value="Yes" <?php echo ($site['cache'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
				<option value="No" <?php echo ($site['cache'] == 'No') ? 'selected' : ''; ?>>No</option>
			</select>
		</div>	


		<div class="c-field u-mb-medium col-md-6">
			<label class="c-field__label">Cookie Notification</label>
			<select required="" name="cookie_status" class="c-select select2 select-cookie">
				<option></option>
				<option value="Yes" <?php echo ($site['cookie_notification']['status'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
				<option value="No" <?php echo ($site['cookie_notification']['status'] == 'No') ? 'selected' : ''; ?>>No</option>
			</select>
		</div>

		<div style='<?php echo ($site['cookie_notification']['status'] == 'Yes') ? '' : 'display:none'; ?>' class="c-field u-mb-medium col-md-12 cookie-message">
			<label class="c-field__label">Cookie Message : </label>
			<textarea required="" class="c-input" name="cookie_message"" placeholder="comment message"><?php echo (!empty($site) ? $site['cookie_notification']['message'] : '') ?></textarea>
		</div>

	</div>

	<div class="c-stage__header o-media u-justify-start cursor-default">
		<div class="c-stage__icon o-media__img">
			<i class="fa fa-info"></i>
		</div>
		<div class="c-stage__header-title o-media__body">
			<h6 class="u-mb-zero">Media Website</h6>
		</div>
	</div>

	<div class="c-stage__panel u-p-medium row">

		<div class="col-lg-4">

			<div class="c-field u-mb-small">
				<label class="c-field__label">Recent Logo : </label>
				<img style="width: 50px" src="<?php echo (!empty($site) ? base_url('storage/uploads/site/thumbnail/'.$site['image']) : '') ?>" alt="">
			</div>

			<div class="c-field u-mb-small">
				<label class="c-field__label">New Logo : </label>
				<input type="hidden" name="image_old" value="<?php echo (!empty($site) ? $site['image'] : '') ?>">
				<input class="c-input" name="image" type="file">
			</div>  

		</div>

		<div class="col-lg-4">												

			<div class="c-field u-mb-small">
				<label class="c-field__label">Recent Icon : </label>
				<img style="width: 50px" src="<?php echo (!empty($site) ? base_url('storage/uploads/site/thumbnail/'.$site['icon']) : '') ?>" alt="">
			</div>

			<div class="c-field u-mb-small">
				<label class="c-field__label">New Icon : </label>
				<input type="hidden" name="icon_old" value="<?php echo (!empty($site) ? $site['icon'] : '') ?>">
				<input class="c-input" name="icon" type="file">
			</div> 

		</div>

		<div class="col-lg-4">												

			<div class="c-field u-mb-small">
				<label class="c-field__label">Recent No Image : </label>
				<img style="width: 50px" src="<?php echo (!empty($site) ? base_url('storage/uploads/site/thumbnail/'.$site['no_image']) : '') ?>" alt="">
			</div>

			<div class="c-field u-mb-small">
				<label class="c-field__label">New No Image : </label>
				<input type="hidden" name="no_image_old" value="<?php echo (!empty($site) ? $site['no_image'] : '') ?>">
				<input class="c-input" name="no_image" type="file">
			</div> 

		</div>

	</div>

	<div class="c-stage__header o-media u-justify-start cursor-default">
		<div class="c-stage__icon o-media__img">
			<i class="fa fa-info"></i>
		</div>
		<div class="c-stage__header-title o-media__body">
			<h6 class="u-mb-zero">Robots.txt & Ads.txt</h6>
		</div>
	</div>

	<div class="c-stage__panel u-p-medium row">

		<div class="col-lg-6">

			<div class="c-field u-mb-medium">
				<label class="c-field__label">Robots.txt</label> 
				<textarea rows="5" class="c-input" name="robots_txt" placeholder="robots_txt"><?php echo (!empty($site) ? $site['robots_txt'] : '') ?></textarea>
				<small class="u-text-mute u-color-info">
					Notes : [sitemap_url] = your sitemap url.
				</small>
			</div>

		</div>

		<div class="col-lg-6">

			<div class="c-field u-mb-medium">
				<label class="c-field__label">Ads.txt</label> 
				<textarea rows="5" class="c-input" name="ads_txt" placeholder="ads_txt"><?php echo (!empty($site) ? $site['ads_txt'] : '') ?></textarea>
			</div>

		</div>	

	</div>

</div>