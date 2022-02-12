<?php if ($site['page_type'] =='homepage' AND empty($this->input->get('page'))): ?>
	<div class="mainheading">
		<h1 class="sitetitle"><?php echo $site['title'] ?></h1>
		<p class="lead">
			<?php echo $site['slogan'] ?>
		</p>
	</div>
<?php endif ?>