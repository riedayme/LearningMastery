<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 col-lg-6 offset-lg-3 col-md-8 offset-md-2 u-mv-medium">
	<form action="<?php echo base_url('app/blog_widget/process') ?>"  method="post" enctype="multipart/form-data">

		<?php $this->load->view('app/_layouts/alert'); ?>

		<div class="c-stage u-mb-zero">

			<a class="c-stage__label c-stage__header u-flex u-justify-">
				<div class="o-media">
					<div class="c-stage__header-title o-media__body">
						<h6 class="u-mb-zero c-stage__label-title">
							<?php echo $title ?> Widget
							&nbsp;
						</h6>
					</div>
				</div>
			</a>

			<div class="c-stage__panel u-p-medium" >

				<div class="c-field u-mb-small">
					<label class="c-field__label">Name : </label>
					<input value="<?php echo (!empty($widget) ? $widget['name'] : '') ?>" required="" class="c-input" name="name" type="text" placeholder="Name">
				</div>

				<div class="c-field u-mb-small">
					<label class="c-field__label">Variable : </label>
					<input value="<?php echo (!empty($widget) ? $widget['var'] : '') ?>" required="" class="c-input" name="var" type="text" placeholder="Variable">
				</div>

				<div class="c-field u-mb-small">
					<label class="c-field__label">Type</label>
					<select required="" name="type" class="c-select select2 has-search">
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'text') ? 'selected' : ''; ?> value="text">text</option>
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'link') ? 'selected' : ''; ?> value="link">link</option>
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'pages') ? 'selected' : ''; ?> value="pages">pages</option>
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'ads') ? 'selected' : ''; ?> value="ads">ads</option>
						<?php if (!$ads_content OR $widget['type'] == 'ads-content'): ?>
							<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'ads-content') ? 'selected' : ''; ?> value="ads-content">ads-content</option>
						<?php endif ?>
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'image') ? 'selected' : ''; ?> value="image">image</option>
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'featured-post') ? 'selected' : ''; ?> value="featured-post">featured post</option>
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'popular-post') ? 'selected' : ''; ?> value="popular-post">popular post</option>
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'category') ? 'selected' : ''; ?> value="category">category</option>
						<option <?php echo (!empty($widget['type']) AND $widget['type'] == 'tags') ? 'selected' : ''; ?> value="tags">tags</option>
					</select>
				</div>				

			</div>

			<div class="c-stage__panel u-p-medium">
				<?php if (!empty($widget)): ?>
					<input name="id" type="hidden" value="<?php echo $widget['id'] ?>">
				<?php endif ?>
				<input type="hidden" name="id_template" value="<?php echo $id_template ?>">
				<input type="hidden" name="redirect" value="<?php echo current_url(); ?>">				
				<button type="submit" class="c-btn c-btn--primary c-btn--custom"> 
					Submit
				</button>
			</div>

		</div>

	</form>
</div>
<?php $this->load->view('app/_layouts/footer'); ?>