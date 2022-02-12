<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<rss version="2.0"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:atom="http://www.w3.org/2005/Atom"
xmlns:media="http://search.yahoo.com/mrss/"
xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0">
<channel>

	<title><?php echo $site['title']; ?></title>
	<description><?php echo $site['description']; ?></description>
	<link><?php echo base_url(); ?></link>
	<atom:link href="<?php echo base_url('feeds/courses'); ?>" rel="self" type="application/rss+xml" />
	<image>
		<url><?php echo $site['image'] ?></url>
		<title><?php echo $site['title']; ?></title>
		<link><?php echo base_url(); ?></link>
	</image>
	<generator><?php echo strtolower($site['title']) ?></generator>
	<lastBuildDate><?php echo date(DATE_RSS, strtotime($site['updated'])); ?></lastBuildDate> 
	<pubDate><?php echo date(DATE_RSS, strtotime($site['updated'])); ?></pubDate>
	<copyright><![CDATA[Copyright (c) <?php echo date('Y').' '.$site['title'] ?>. All Rights Reserved.]]></copyright>
	<language><![CDATA[<?php echo ($site['language'] == 'indonesia') ? 'id-ID' : 'en-US' ?>]]></language>
	<ttl>10</ttl>
	<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="self" type="application/rss+xml" href="<?php echo base_url('feeds/courses'); ?>" />
	<feedburner:info uri="rss/edition_world" />
	<atom10:link xmlns:atom10="http://www.w3.org/2005/Atom" rel="hub" href="http://pubsubhubbub.appspot.com/" />
	<?php if ($posts): ?>
		<?php foreach($posts as $post): ?>		
			<item>
				<title><![CDATA[<?php echo xml_convert($post['title']); ?>]]>
				</title>
				<description><![CDATA[ <?php echo trim(character_limiter(strip_tags($post['description']), 200)); ?> ]]></description>
				<link><?php echo $post['url']; ?></link>
				<guid><?php echo $post['url']; ?></guid>
				<pubDate><?php echo date(DATE_RSS, strtotime($post['time_original'])); ?></pubDate>
				<feedburner:origLink><?php echo $post['url']; ?></feedburner:origLink>
			</item>
		<?php endforeach; ?>
	<?php endif ?>
</channel>
</rss>