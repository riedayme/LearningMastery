<footer>
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<div class="col-sm-6 col-md-3 col-lg-4">
						<div class="footer-links">
							<h5 class="footer-link--title"><?php echo $widget['link1_footer']['title'] ?></h5>
							<ul>
								<?php  
								if ($widget['link1_footer']['content']) {
									foreach ($widget['link1_footer']['content'] as $link) {
										?>

										<li><a class="footer-link" href="<?php echo $link['url'] ?>" title='<?php echo $link['title'] ?>'><?php echo $link['title'] ?></a></li>

										<?php
									}
								}
								?>										
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-4">
						<div class="footer-links">
							<h5 class="footer-link--title"><?php echo $widget['link2_footer']['title'] ?></h5>
							<ul>
								<?php  
								if ($widget['link2_footer']['content']) {
									foreach ($widget['link2_footer']['content'] as $link) {
										?>

										<li><a class="footer-link" href="<?php echo $link['url'] ?>" title='<?php echo $link['text'] ?>'><?php echo $link['text'] ?></a></li>

										<?php
									}
								}
								?>								
							</ul>
						</div>
					</div>
					<div class="col-sm-12 col-md-6 col-lg-4">
						<div class="footer-contact">
							<h5 class="footer-link--title"><?php echo $widget['contact_footer']['title'] ?></h5>
							<div class="contact-method">
								<?php echo $widget['contact_footer']['content'] ?>
							</div>							
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<a title="<?php echo $site['title'] ?>" class="logo" href="<?php echo base_url() ?>">
					<img style="max-width: 180px" src="<?php echo $widget['logo']['content'] ?>" alt="<?php echo $site['title'] ?>" title='<?php echo $site['title'] ?>'>
				</a>
				<p class="copyright"><?php echo $this->lang->line('copyright') ?> <?php echo "©".date('Y '); echo $site['title']; ?>.</p>
				<?php echo $this->lang->line('rendered_in') ?> {elapsed_time} <?php echo $this->lang->line('seconds') ?>
			</div>
		</div>
	</div>
</footer><!--End footer-->
