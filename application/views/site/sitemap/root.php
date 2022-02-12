<?php echo '<?xml version="1.0" encoding="UTF-8" ?><?xml-stylesheet type="text/xsl" href="'.base_url('storage/assets/site/sitemap.xsl').'"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	<url>
		<loc><?= base_url() ?></loc>
        <priority>1.0</priority>
        <changefreq>daily</changefreq>
        <lastmod><?php echo date('c', strtotime($site['updated'])); ?></lastmod>
	</url>

</urlset>
