<?php echo '<?xml version="1.0" encoding="UTF-8" ?><?xml-stylesheet type="text/xsl" href="'.base_url('storage/assets/site/sitemap.xsl').'"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <?php foreach($courses as $post) { ?>
    <url>
        <loc><?= base_url('courses-detail/'.$post['permalink']) ?></loc>
        <priority>0.5</priority>
       <?php if (empty($post['updated'])): ?>
       	 <lastmod><?php echo date('c', strtotime($post['time'])); ?></lastmod>
       <?php endif ?>
       <?php if (!empty($post['updated'])): ?>
       	 <lastmod><?php echo date('c', strtotime($post['updated'])); ?></lastmod>
       <?php endif ?>       
    </url>
    <?php } ?>

</urlset>
