<?php if ($post['related_post']): ?>
	<div class="graybg">
		<div class="container">
			<div class="row listrecent listrelated">


				<?php foreach ($post['related_post'] as $post): ?>
					<!-- begin post -->
					<div class="col-md-4">
						<div class="card">
							<a title="<?php echo $post['title'] ?>" href="<?php echo $post['url'] ?>">
								<?php if ($post['image']['thumbnail']): ?>								
									<img style="width:100%" class="img-fluid" src="<?php echo $post['image']['thumbnail'] ?>" alt="<?php echo $post['title'] ?>"/><?php else: ?>
									<img style="width:100%" class="img-fluid" src="<?php echo $post['image']['no_image'] ?>" alt="<?php echo $post['title'] ?>"/>
								<?php endif ?>
							</a>
							<div class="card-block">
								<h2 class="card-title"><a title="<?php echo $post['title'] ?>" href="<?php echo $post['url'] ?>">
									<?php echo $post['title'] ?>
								</a></h2>
								<div class="metafooter">
									<div class="wrapfooter">
										<span class="meta-footer-thumb">
											<img class="author-thumb" src="<?php echo base_url('storage/assets/blog/mediumish/img/person.png') ?>" alt="<?php echo $site['title'] ?>">
										</span>
										<span class="author-meta">
											<span class="post-name"><?php echo $site['title'] ?></span><br/>
											<span class="post-date"><?php echo $post['time'] ?></span>
										</span>
										<span class="post-read-more"><a title="<?php echo $post['title'] ?>" href="<?php echo $post['url'] ?>"><svg class="svgIcon-use" width="25" height="25" viewbox="0 0 25 25"><path d="M19 6c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2v14.66h.012c.01.103.045.204.12.285a.5.5 0 0 0 .706.03L12.5 16.85l5.662 4.126a.508.508 0 0 0 .708-.03.5.5 0 0 0 .118-.285H19V6zm-6.838 9.97L7 19.636V6c0-.55.45-1 1-1h9c.55 0 1 .45 1 1v13.637l-5.162-3.668a.49.49 0 0 0-.676 0z" fill-rule="evenodd"></path></svg></a></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end post -->
				<?php endforeach ?>

			</div>
		</div>
	</div>
<?php endif ?>