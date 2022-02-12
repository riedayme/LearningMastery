<?php $this->load->view('blog/templates/mediumish/_layouts/header');?>
<?php $this->load->view('blog/templates/mediumish/_layouts/nav');?>


<div class="container">

	<div class="row">

		<div class="col-md-2 col-xs-12">
		</div>

		<!-- Begin Post -->
		<div class="col-md-8 col-md-offset-2 col-xs-12">
			<div class="mainheading">

				<h1 class="posttitle"><?php echo $post['title'] ?></h1>

			</div>

			<!-- Begin Post Content -->
			<div class="article-post">
				<?php echo $post['content'] ?>
			</div>
			<!-- End Post Content -->

		</div>
		<!-- End Post -->

	</div>

</div>
<!-- /.container -->

<div class="container">
	<?php $this->load->view('blog/templates/mediumish/_layouts/footer-copyright');?>
</div>

<?php $this->load->view('blog/templates/mediumish/_layouts/footer');?>