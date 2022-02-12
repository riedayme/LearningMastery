<?php echo '<?xml version="1.0" encoding="UTF-8" ?><?xml-stylesheet type="text/xsl" href="'.base_url('storage/assets/site/sitemap.xsl').'"?>' ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<sitemap>
		<loc><?= base_url('root.xml');?></loc> 
		<lastmod><?php echo date('c', strtotime($site['updated'])); ?></lastmod>
	</sitemap>

	<?php if ($courses): ?>	
		<?php foreach($courses as $read) { ?>
		<sitemap>
			<loc><?= base_url($read['url']);?></loc> 
			<lastmod><?php echo $read['lastmod'] ?></lastmod>
		</sitemap>    
		<?php } ?>    
	<?php endif ?>	

	<?php if ($blog_post): ?>	
		<?php foreach($blog_post as $read) { ?>
		<sitemap>
			<loc><?= base_url($read['url']);?></loc> 
			<lastmod><?php echo $read['lastmod'] ?></lastmod>
		</sitemap>    
		<?php } ?>    
	<?php endif ?>	

	<?php if ($pages): ?>	
		<?php foreach($pages as $read) { ?>
		<sitemap>
			<loc><?= base_url($read['url']);?></loc> 
			<lastmod><?php echo $read['lastmod'] ?></lastmod>
		</sitemap>    
		<?php } ?>    
	<?php endif ?>			

</sitemapindex>
