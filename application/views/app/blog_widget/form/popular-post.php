<div class="c-field u-mb-medium">
	<label><input value="active" name="<?php echo $widget['id'] ?>[status]" type="radio" <?php echo (!empty($widget['data']['status'])) ? ($widget['data']['status'] == 'active') ? 'checked' : '' : 'checked'?>>Active</label>
	<label><input value="nonactive" name="<?php echo $widget['id'] ?>[status]" type="radio" <?php echo (!empty($widget['data']['status'])) ? ($widget['data']['status'] == 'nonactive') ? 'checked' : '' : '' ?>>NonActive</label>
</div>

<div class="c-field u-mb-small">
	<label class="c-field__label">Title : </label>
	<input required="" value="<?php echo $widget['data']['title'] ?>" class="c-input" name="<?php echo $widget['id'] ?>[title]" type="text" placeholder="title">
</div>

<div class="c-field u-mb-small">
	<label class="c-field__label">max result : </label>

	<select required="" name="<?php echo $widget['id'] ?>[max_result]" class="c-select select2">		
		<?php  
		for ($i=1; $i <= 10 ; $i++) { 
			?>
			<option value="<?php echo $i ?>" <?php echo ($widget['data']['max_result']== $i) ? 'selected' : ''; ?>><?php echo $i ?></option>
			<?php
		}
		?>
	</select>
</div>

<input name="<?php echo $widget['id'] ?>[id]" type="hidden" value="<?php echo $widget['id']  ?>">
<input name="<?php echo $widget['id'] ?>[type]" type="hidden" value="<?php echo $widget['type']  ?>">