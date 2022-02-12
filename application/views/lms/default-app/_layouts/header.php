<!DOCTYPE html>
<html lang="en-us">
<head>

	<?php echo $site['meta']; ?>

	<!-- CSS template -->
	<link rel="stylesheet" href="<?php echo base_url('storage/assets/app/css/all-modules.css') ?>"/> 
	<link rel="stylesheet" href="<?php echo base_url('storage/assets/app/css/main.min.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('storage/assets/app/css/custom.css') ?>"/>
	<link rel="stylesheet" href="<?php echo base_url('storage/assets/lms/default-app/css/custom.css') ?>"/>	

</head>
<body class="o-page <?php if(!empty($classbody)) echo $classbody;?>">

<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
