<div class="row">

	<div class="col-lg-12">

		<div class="c-field u-mb-medium">
			<label class="c-field__label">Limit Post (Pagination)</label> 
			<input class="c-input" type="text" name="lms_limit_post" placeholder="limit post" value="<?php echo (!empty($site) ? $site['lms_limit_post'] : '') ?>"> 
		</div>

		<div class="c-field u-mb-medium">
			<label class="c-field__label">Free Courses Readable ?</label>
			<select required="" name="lms_free_courses_readable" class="c-select select2">
				<option></option>
				<option value="Yes" <?php echo ($site['lms_free_courses_readable'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
				<option value="No" <?php echo ($site['lms_free_courses_readable'] == 'No') ? 'selected' : ''; ?>>No</option>
			</select>
		</div>	

	</div>	

</div>