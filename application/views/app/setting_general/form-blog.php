<div class="row">

	<div class="col-lg-6">

		<div class="c-field u-mb-medium">
			<label class="c-field__label">Limit Post (Pagination)</label> 
			<input class="c-input" type="text" name="blog_limit_post" placeholder="limit post" value="<?php echo (!empty($site) ? $site['blog_limit_post'] : '') ?>"> 
		</div>

	</div>	

	<div class="col-lg-6">

		<div class="c-field u-mb-medium">
			<label class="c-field__label">Comment Type</label>
			<select required="" name="blog_comment_type" class="c-select select2 select-comment-type">
				<option value="disable" <?php echo ($site['blog_comment']['type']== 'disable') ? 'selected' : ''; ?>>Disable</option>
				<option value="system" <?php echo ($site['blog_comment']['type']== 'system') ? 'selected' : ''; ?>>System</option>
				<option value="disqus" <?php echo ($site['blog_comment']['type']== 'disqus') ? 'selected' : ''; ?>>Disqus</option>
			</select>
		</div>
	</div>	

	<div style='<?php echo ($site['blog_comment']['type'] == 'system') ? '' : 'display:none'; ?>' class="c-field u-mb-medium col-md-12 type-system">
		<label class="c-field__label">Comment Moderate</label>
		<select required="" name="blog_moderate" class="c-select select2">
			<option></option>
			<option value="true" <?php echo ($site['blog_comment']['moderate'] == 'true') ? 'selected' : ''; ?>>Yes</option>
			<option value="false" <?php echo ($site['blog_comment']['moderate'] == 'false') ? 'selected' : ''; ?>>No</option>
		</select>
	</div>                          

	<div style='<?php echo ($site['blog_comment']['type'] == 'system') ? '' : 'display:none'; ?>' class="c-field u-mb-medium col-md-12 type-system">
		<label class="c-field__label">Message Comment : </label>
		<textarea required="" class="c-input" name="blog_message"" placeholder="comment message"><?php echo (!empty($site) ? $site['blog_comment']['message'] : '') ?></textarea>
	</div>

	<div style='<?php echo ($site['blog_comment']['type'] == 'disqus') ? '' : 'display:none'; ?>' class="c-field u-mb-medium col-md-6 type-disqus">
		<label class="c-field__label">disqus_shortname : </label>
		<input required="" value="<?php echo (!empty($site) ? $site['blog_comment']['disqus_shortname'] : '') ?>" class="c-input" name="blog_disqus_shortname" type="text" placeholder="disqus_shortname">
	</div>

	<div style='<?php echo ($site['blog_comment']['type'] == 'disqus') ? '' : 'display:none'; ?>' class="c-field u-mb-medium col-md-6 type-disqus">
		<label class="c-field__label">disqus_developer : </label>
		<input required="" value="<?php echo (!empty($site) ? $site['blog_comment']['disqus_developer'] : '') ?>" class="c-input" name="blog_disqus_developer" type="text" placeholder="disqus_developer">
	</div>

</div>