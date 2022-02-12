<!DOCTYPE html>
<html lang="en">

<head>

    <?php echo $site['meta']; ?>

    <link rel="stylesheet" href="<?php echo base_url('storage/assets/blog/pisen/css/all-modules.css') ?>">    
    <link rel="stylesheet" href="<?php echo base_url('storage/assets/blog/pisen/css/main.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('storage/assets/blog/post.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('storage/assets/blog/pisen/css/custom.css') ?>">
</head>

<body>
    <div id="search-full" class="fadeIn" style="display: none">
        <button id="exit-search-box">
            <i class="fa fa-times">
            </i>
        </button>
        <div class="search-box">
            <form action="<?php echo base_url('blog-search') ?>" method="GET" class="animated fadeInDown">
                <input class="input-form" type="text" name="q" placeholder="<?php echo $this->lang->line('search') ?>">
                <button>
                    <i class="fa fa-arrow-right">
                    </i>
                </button>
            </form>
        </div>
    </div>
    <div id="main">