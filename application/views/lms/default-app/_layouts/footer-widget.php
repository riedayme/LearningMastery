<section class="u-bg-white footer" style="border-top: 1px solid #e6eaee;border-bottom: 1px solid #e6eaee">
	<div class="container">                   
		<div class="row u-pv-large">

			<div class="col-12 col-lg-4 col-md-4 col-sm-6">	
				<div class="c-panel__widget">

					<div class="mobile-collapse">
						<h4 class="c-panel__title u-text-bold u-h3">Navigasi</h4>
					</div>

					<ul class="list-inline">
						<li class="u-mb-xsmall">
							<a class="u-text-large" href="<?php echo base_url('blog') ?>" title='Blog'>Blog</a>
						</li>
						<li class="u-mb-xsmall">
							<a class="u-text-large" href="<?php echo base_url('p/help') ?>" title='Bantuan'>Bantuan</a>
						</li>
						<li class="u-mb-xsmall">
							<a class="u-text-large" href="<?php echo base_url('p/contact') ?>" title='Kontak'>Kontak</a>
						</li>
					</ul>
				</div>				
			</div>


			<div class="col-12 col-lg-4 col-md-4 col-sm-6">	
				<div class="c-panel__widget">

					<div class="mobile-collapse">
						<h4 class="c-panel__title u-text-bold u-h3">Informasi</h4>
					</div>

					<ul class="list-inline">
						<li class="u-mb-xsmall">
							<a class="u-text-large" href="<?php echo base_url('p/about') ?>" title='Tentang Kami'>Tentang Kami</a>
						</li>
						<li class="u-mb-xsmall">
							<a class="u-text-large" href="<?php echo base_url('p/term-and-condition') ?>" title='Syarat dan Ketentuan'>Syarat dan Ketentuan</a>
						</li>
						<li class="u-mb-xsmall">
							<a class="u-text-large" href="<?php echo base_url('p/privacy-policy') ?>" title='Kebijakan Privasi'>Kebijakan Privasi</a>
						</li>
					</ul>

				</div>				
			</div>

			<div class="col-12 col-lg-4 col-md-4 col-sm-12">	
				<div class="c-panel__widget">
					<img style="width: 150px" src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 3 2'%3E%3C/svg%3E" data-src="<?php echo base_url('storage/assets/lms/default-app/img/undraw_through_the_park_lxnl.svg') ?>" alt="footer-intro"> 
					<ul class="c-profile-card__social u-justify-start u-border-zero u-p-zero u-mv-small">
						<li class="u-mr-xsmall"><a target="_blank" title="facebook" class="c-profile-card__social-icon u-bg-facebook" href="https://facebook.com/kurteyki">
							<i class="fa fa-facebook"></i>
						</a></li>
						<li class="u-mr-xsmall"><a target="_blank" title="twitter" class="c-profile-card__social-icon u-bg-twitter" href="https://twitter.com/kurteyki">
							<i class="fa fa-twitter"></i>
						</a></li>
						<li class="u-mr-xsmall"><a target="_blank" title="instagram" class="c-profile-card__social-icon u-bg-dribbble" href="https://instagram.com/kurteyki">
							<i class="fa fa-instagram"></i>
						</a></li>
					</ul>
				</div>				
			</div>			

		</div>
	</div>
</section> 

<section class="u-bg-white">
	<div class="container">                   
		<div class="row u-pv-medium">

			<div class="col-12 col-lg-12">	
				<div class="c-panel__widget">
					<p class="u-text-center u-text-mute u-text-large u-text-bold">
						<?php echo $this->lang->line('copyright') ?> &#169; <?php echo $site['title'].date(' 2019 -  Y').'.All rights reserved.'; ?>
					</p>
				</div>				
			</div>			

		</div>
	</div>
</section> 

<a title="back to top" href='javascript:;' id='toTop' class="u-hidden-down@desktop">
	<i class="fa fa-arrow-up"></i>
</a>