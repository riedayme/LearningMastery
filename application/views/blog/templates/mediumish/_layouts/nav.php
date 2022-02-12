<!-- Begin Nav
	================================================== -->
	<nav class="navbar navbar-toggleable-md navbar-light bg-white fixed-top mediumnavigation">
		<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="container">
			<!-- Begin Logo -->
			<a class="navbar-brand" title="<?php echo $site['title'] ?>" href="<?php echo base_url() ?>">
				<?php if ($widget['logo_header']['status'] == 'active'): ?>
					<img src="<?php echo $widget['logo_header']['content'] ?>" alt="<?php echo $site['title'] ?>">
					<?php else: ?>						
						<?php echo $site['title']; ?>
					<?php endif ?>
				</a>
				<!-- End Logo -->
				<div class="collapse navbar-collapse" id="navbarsExampleDefault">
					<!-- Begin Menu -->
					<ul class="navbar-nav ml-auto">
						<li class="nav-item <?php if($this->uri->segment(1)==""){echo "active";}?>">
							<a title="<?php echo $this->lang->line('home') ?>" class="nav-link" href="<?php echo base_url() ?>">
								<?php echo $this->lang->line('home') ?>
							</a>
						</li>
						<li class="nav-item <?php if($this->uri->segment(1)==""){echo "active";}?>">
							<a title="<?php echo $this->lang->line('home') ?>" class="nav-link" href="<?php echo base_url('blog') ?>">
								<?php echo $this->lang->line('blog') ?>
							</a>
						</li>
						<?php if (!empty($widget['navigation_header'])): ?>
							<?php if ($widget['navigation_header']['status'] == 'active'): ?>
								<?php foreach ($widget['navigation_header']['content'] as $category): ?>
									<li class="nav-item <?php if(current_url()==$category['url']){echo "active";}?>">
										<a title="<?php echo $category['title'] ?>" class="nav-link" href="<?php echo $category['url'] ?>">
											<?php echo $category['title'] ?>
										</a>
									</li>
								<?php endforeach ?>							
							<?php endif ?>
						<?php endif ?>
					</ul>
					<!-- End Menu -->
					<!-- Begin Search -->
					<form class="form-inline my-2 my-lg-0" action="<?php echo base_url('blog-search') ?>" method="GET">
						<input class="form-control mr-sm-2" name="q" type="text" placeholder="<?php echo $this->lang->line('search') ?>">
						<span class="search-icon"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M20.067 18.933l-4.157-4.157a6 6 0 1 0-.884.884l4.157 4.157a.624.624 0 1 0 .884-.884zM6.5 11c0-2.62 2.13-4.75 4.75-4.75S16 8.38 16 11s-2.13 4.75-4.75 4.75S6.5 13.62 6.5 11z"></path></svg></span>
					</form>
					<!-- End Search -->
				</div>
			</div>
		</nav>
<!-- End Nav
================================================== -->