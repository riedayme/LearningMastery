<div class="c-field u-mb-medium">
    <label><input value="active" name="<?php echo $widget['id'] ?>[status]" type="radio" <?php echo (!empty($widget['data']['status'])) ? ($widget['data']['status'] == 'active') ? 'checked' : '' : 'checked'?>>Active</label>
    <label><input value="nonactive" name="<?php echo $widget['id'] ?>[status]" type="radio" <?php echo (!empty($widget['data']['status'])) ? ($widget['data']['status'] == 'nonactive') ? 'checked' : '' : '' ?>>NonActive</label>
</div>

<div class="c-field u-mb-small">
	<label class="c-field__label">Recent image : </label>
	<img style="width: 200px" src="<?php echo base_url('storage/uploads/blog/thumbnail/'.$widget['data']['content']) ?>" alt="Image">
</div>
<div class="c-field u-mb-small">
	<label class="c-field__label">New image (optional) : </label>
	<input type="hidden" name="<?php echo $widget['id'] ?>[image_old]" value="<?php echo $widget['data']['content'] ?>">
	<input class="c-input" name="<?php echo $widget['id'] ?>[image]" type="file">
</div>

<input name="<?php echo $widget['id'] ?>[id]" type="hidden" value="<?php echo $widget['id']  ?>">
<input name="<?php echo $widget['id'] ?>[type]" type="hidden" value="<?php echo $widget['type']  ?>">