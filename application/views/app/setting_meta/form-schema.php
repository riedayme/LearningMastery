<div class="c-field u-mb-small">
	<label class="c-field__label">schema</label>
	<select required="" name="schema" class="c-select select2 select-schema">
		<option value="Person" <?php echo ($meta['schema']['type'] == 'Person') ? 'selected' : ''; ?>>Person</option>
		<option value="Organization" <?php echo ($meta['schema']['type'] == 'Organization') ? 'selected' : ''; ?>>Organization</option>
	</select>
</div>

<div style='<?php echo ($meta['schema']['type'] == 'Organization') ? '' : 'display:none'; ?>' class="row type-organization">
	<div class="u-mb-medium u-mt-medium col-md-12">
		<label class="c-field__label u-border-bottom">Organization Data : </label>
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">organization_name : </label>
		<input required="" class="c-input" name="organization_name" type="text" value="<?php echo $meta['schema']['content']['organization_name'] ?>">
	</div>
	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">organization_url : </label>
		<input required="" class="c-input" name="organization_url" type="text" value="<?php echo $meta['schema']['content']['organization_url'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">organization_contactPoint_telephone : </label>
		<input required="" class="c-input" name="organization_contactPoint_telephone" type="text" value="<?php echo $meta['schema']['content']['organization_contactPoint_telephone'] ?>">
	</div>
	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">organization_contactPoint_contactType : </label>
		<input required="" class="c-input" name="organization_contactPoint_contactType" type="text" value="<?php echo $meta['schema']['content']['organization_contactPoint_contactType'] ?>">
	</div>
	<div class="c-field u-mb-small col-md-12">
		<label class="c-field__label">organization_sameAs : </label>
		<input required="" class="c-input" name="organization_sameAs" type="text" value="<?php echo $meta['schema']['content']['organization_sameAs'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-12">
		<div style="max-width: 250px;margin: auto;text-align: center">
			<label class="c-field__label">Recent organization_logo_url : </label>
			<img style="width: 120px" src="<?php echo base_url('storage/uploads/site/thumbnail/'.$meta['schema']['content']['organization_logo_url']) ?>" alt="organization_logo_url">
			<label class="c-field__label">New organization_logo_url (optional) : </label>
			<input type="hidden" name="organization_logo_url_old" value="<?php echo $meta['schema']['content']['organization_logo_url'] ?>">
			<input class="c-input" name="organization_logo_url" type="file">
			<div class="u-text-mute u-text-small">The image must be 112x112px, at minimum.</div>
		</div>
	</div>
</div>

<div style='<?php echo ($meta['schema']['type'] == 'Person') ? '' : 'display:none'; ?>' class="row type-person">

	<div class="u-mb-medium u-mt-medium col-md-12">
		<label class="c-field__label u-border-bottom">Personal Data : </label>
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_name : </label>
		<input required="" class="c-input" name="person_name" type="text" value="<?php echo $meta['schema']['content']['person_name'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_alternateName : </label>
		<input required="" class="c-input" name="person_alternateName" type="text" value="<?php echo $meta['schema']['content']['person_alternateName'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_gender : </label>
		<input required="" class="c-input" name="person_gender" type="text" value="<?php echo $meta['schema']['content']['person_gender'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_height : </label>
		<input required="" class="c-input" name="person_height" type="text" value="<?php echo $meta['schema']['content']['person_height'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_birthDate : </label>
		<input required="" class="c-input" name="person_birthDate" type="text" value="<?php echo $meta['schema']['content']['person_birthDate'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_birthPlace : </label>
		<input required="" class="c-input" name="person_birthPlace" type="text" value="<?php echo $meta['schema']['content']['person_birthPlace'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_nationality : </label>
		<input required="" class="c-input" name="person_nationality" type="text" value="<?php echo $meta['schema']['content']['person_nationality'] ?>">
	</div>


	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_alumniOf : </label>
		<input required="" class="c-input" name="person_alumniOf" type="text" value="<?php echo $meta['schema']['content']['person_alumniOf'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-12">
		<label class="c-field__label">person_memberOf : </label>
		<input required="" class="c-input" name="person_memberOf" type="text" value="<?php echo $meta['schema']['content']['person_memberOf'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-12">
		<div style="max-width: 250px;margin: auto;text-align: center">
			<label class="c-field__label">Recent person_image : </label>
			<img style="width: 200px" src="<?php echo base_url('storage/uploads/site/thumbnail/'.$meta['schema']['content']['person_image']) ?>" alt="person_image">
			<label class="c-field__label">NeW person_image (optional) : </label>
			<input type="hidden" name="person_image_old" value="<?php echo $meta['schema']['content']['person_image'] ?>">
			<input class="c-input" name="person_image" type="file">
		</div>
	</div>

	<div class="u-mb-medium u-mt-medium col-md-12 u-border-bottom">
		<label class="c-field__label">Address : </label>
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_streetAddress : </label>
		<input required="" class="c-input" name="person_streetAddress" type="text" value="<?php echo $meta['schema']['content']['person_streetAddress'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_addressLocality : </label>
		<input required="" class="c-input" name="person_addressLocality" type="text" value="<?php echo $meta['schema']['content']['person_addressLocality'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_addressRegion : </label>
		<input required="" class="c-input" name="person_addressRegion" type="text" value="<?php echo $meta['schema']['content']['person_addressRegion'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_postalCode : </label>
		<input required="" class="c-input" name="person_postalCode" type="text" value="<?php echo $meta['schema']['content']['person_postalCode'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_email : </label>
		<input required="" class="c-input" name="person_email" type="text" value="<?php echo $meta['schema']['content']['person_email'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_telephone : </label>
		<input required="" class="c-input" name="person_telephone" type="text" value="<?php echo $meta['schema']['content']['person_telephone'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_url : </label>
		<input required="" class="c-input" name="person_url" type="text" value="<?php echo $meta['schema']['content']['person_url'] ?>">
	</div>  

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_sameAs : </label>
		<input required="" class="c-input" name="person_sameAs" type="text" value="<?php echo $meta['schema']['content']['person_sameAs'] ?>">
	</div>

	<div class="u-mb-medium u-mt-medium col-md-12 u-border-bottom">
		<label class="c-field__label">Work On : </label>
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_jobTitle : </label>
		<input required="" class="c-input" name="person_jobTitle" type="text" value="<?php echo $meta['schema']['content']['person_jobTitle'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-6">
		<label class="c-field__label">person_worksFor_name : </label>
		<input required="" class="c-input" name="person_worksFor_name" type="text" value="<?php echo $meta['schema']['content']['person_worksFor_name'] ?>">
	</div>

	<div class="c-field u-mb-small col-md-12">
		<label class="c-field__label">person_worksFor_sameAs : </label>
		<input required="" class="c-input" name="person_worksFor_sameAs" type="text" value="<?php echo $meta['schema']['content']['person_worksFor_sameAs'] ?>">
	</div>          

</div>