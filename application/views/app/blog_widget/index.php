<?php $this->load->view('app/_layouts/header'); ?>
<?php $this->load->view('app/_layouts/sidebar'); ?>
<?php $this->load->view('app/_layouts/content'); ?>

<div class="col-12 col-xl-6 col-lg-10 col-md-12 offset-xl-3 offset-lg-1 u-mv-small">

	<?php $this->load->view('app/_layouts/alert'); ?>

	<div class="c-card c-card--responsive u-p-zero">
		<div class="c-card__header o-line">       
			<a href='<?php echo base_url('app/blog_widget/create') ?>' class="c-btn c-btn--info u-mr-small c-btn--custom">
				<i class="fa fa-plus" aria-hidden="true"></i>
			</a>
		</div>
		<div class="c-card__body u-p-zero">   

			<form action="<?php echo base_url('app/blog_widget/process_update_widget') ?>"  method="post" enctype="multipart/form-data">

				<div class="c-stage u-mb-zero" id="accordion">

					<?php if ($widget): foreach ($widget as $data): ?>

						<a class="c-stage__label c-stage__header u-flex u-justify-between collapsed" data-toggle="collapse" href="#stage-<?php echo $data['var'] ?>" aria-expanded="false" aria-controls="stage-<?php echo $data['var'] ?>">
							<div class="o-media">
								<div class="c-stage__icon o-media__img c-stage__label-title">
									<?php  
									if ($data['data']['status'] == 'active') {
										?>
										<i class="fa fa-check u-color-success"></i>
										<?php
									}else{
										?>
										<i class="fa fa-close u-color-danger"></i>
										<?php
									}
									?>
								</div>
								<div class="c-stage__header-title o-media__body">
									<h6 class="u-mb-zero c-stage__label-title">
										<?php echo $data['name'] ?>
										&nbsp;
									</h6>
								</div>
							</div>
							<div>						
								<span class="c-badge c-badge--info c-badge--small">
									<?php echo $data['type'] ?>
								</span>
								&nbsp;
								<!-- <i class="fa fa-angle-down u-color-white"></i> -->					
							</div>
						</a>

						<div data-parent="#accordion" class="c-stage__panel u-p-medium collapse" id="stage-<?php echo $data['var'] ?>">

							<?php  
							if ($data['type'] == 'ads') {

								$this->load->view('app/blog_widget/form/ads', ['widget' => $data]);
							}elseif ($data['type'] == 'ads-content') {

								$this->load->view('app/blog_widget/form/ads-content', ['widget' => $data]);
							}elseif ($data['type'] == 'link'){

								$this->load->view('app/blog_widget/form/link', ['widget' => $data]);
							}elseif ($data['type'] == 'image') {

								$this->load->view('app/blog_widget/form/image', ['widget' => $data]);
							}elseif ($data['type'] == 'text') {

								$this->load->view('app/blog_widget/form/text', ['widget' => $data]);
							}elseif ($data['type'] == 'popular-post') {

								$this->load->view('app/blog_widget/form/popular-post', ['widget' => $data]);
							}elseif ($data['type'] == 'category') {
								$this->load->view('app/blog_widget/form/category', ['widget' => $data,'category' => $categorys]);
							}elseif ($data['type'] == 'tags') {
								$this->load->view('app/blog_widget/form/tags', ['widget' => $data,'tags' => $tags]);
							}elseif ($data['type'] == 'pages') {
								$this->load->view('app/blog_widget/form/pages', ['widget' => $data,'pages' => $pages]);
							}elseif ($data['type'] == 'featured-post') {
								$this->load->view('app/blog_widget/form/featured-post', ['widget' => $data,'post' => $post]);
							}
							?>

							<a class="c-btn--custom c-btn--small c-btn c-btn--info" href="<?php echo base_url('app/blog_widget/update/'.$data['id']) ?>"><i class="fa fa-edit"></i></a>
							<button data-title="are you sure ?" data-text="want to delete <?php echo $data['name'] ?> widget" class="c-btn--custom c-btn--small c-btn c-btn--danger single-action" data-href="<?php echo base_url('app/blog_widget/delete/'.$data['id']) ?>" type="button"><i class="fa fa-trash"></i></button>

						</div>

					<?php endforeach ?>
					<div class="c-stage__panel u-p-medium u-bg-secondary">
						<button type="submit" class="c-btn c-btn--primary c-btn--custom"> 
							Save
						</button>
					</div>
					<?php else: ?>
						<div class="c-stage__panel u-p-medium">
							No Widget Initial.
						</div>
					<?php endif ?>


				</div>
			</form>

		</div>
	</div>
</div>

<?php $this->load->view('app/_layouts/footer'); ?>