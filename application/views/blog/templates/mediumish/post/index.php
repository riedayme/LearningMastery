<?php $this->load->view('blog/templates/mediumish/_layouts/header');?>
<?php $this->load->view('blog/templates/mediumish/_layouts/nav');?>


<div class="container">

	<div class="row">
		<?php $this->load->view('blog/templates/mediumish/post/part/share');?>
		<?php $this->load->view('blog/templates/mediumish/post/part/content');?>
	</div>



</div>
<!-- /.container -->

<?php $this->load->view('blog/templates/mediumish/post/part/related');?>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8 pt-5">	
			<div id="comments">				
				<?php $this->load->view('blog/templates/mediumish/post/part/comment');?>
			</div>		
		</div>
	</div>
</div>

<div class="container">
	<?php $this->load->view('blog/templates/mediumish/_layouts/footer-copyright');?>
</div>

<div class="hideshare"></div>


<?php $this->load->view('blog/templates/mediumish/_layouts/footer');?>