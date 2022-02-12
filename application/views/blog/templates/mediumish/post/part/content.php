<!-- Begin Post -->
<div class="col-md-8 col-md-offset-2 col-xs-12">
	<div class="mainheading">

		<h1 class="posttitle"><?php echo $post['title'] ?></h1>

	</div>

	<?php if ($post['image']['original']): ?>
		<!-- Begin Featured Image -->
		<!-- <img class="featured-image img-fluid" src="<?php echo $post['image']['original'] ?>" alt="<?php echo $post['title'] ?>">-->
		<!-- End Featured Image -->
	<?php endif ?>

	<!-- Begin Post Content -->
	<div class="article-post">
		<?php echo $post['content'] ?>
	</div>
	<!-- End Post Content -->

	<!-- Begin Tags -->
	<div class="after-post-tags">
		<ul class="tags">
			<?php  
			if ($post['category']) {
				echo "<li><a title='{$post['category']['name']}' href='{$post['category']['url']}'><i class='fa fa-folder'></i> {$post['category']['name']}</a></li>";
			}
			?>
			<?php
			if ($post['tags']) {
				foreach ($post['tags'] as $tag) {
					echo "<li><a title='{$tag['name']}' href='{$tag['url']}'>{$tag['name']}</a></li>&nbsp;";
				}
			}
			?>
		</ul>
	</div>
	<!-- End Tags -->

</div>
<!-- End Post -->