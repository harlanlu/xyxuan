<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$mytitle|default="Welcome~"}新意轩摄影</title>
    <link rel="stylesheet" type="text/css" href="banner/welcome/css/demo.css" />
</head>
<body>
<!-- coidea:loader START -->
<div class="loader">
    <div class="lds-ripple">
        <div></div>
        <div></div>
    </div>
</div>
<!-- coidea:loader END -->
<style>
    .mysite{
        font-family: 'Playfair Display', serif;font-size: 50px;
        position: relative;top: 100px;
        font-weight: bold;
        right: 50px;
    }
</style>
<!-- coidea:header START -->
<header>
    <div class="header-inner">
        <div class="logo">
<!--            <a href="/main"><span>新意轩摄影</span></a>-->
        </div>
        <nav class="header-navigation">
            <li>
                <a target="_blank" href="<?php echo APP_URL.'/main' ?>">
                    <span class="mysite"  style="">
                       Go~ 新意轩摄影</span></a>
            </li>

        </nav>
    </div>
</header>
<!-- coidea:header END -->

<!-- slideshow START -->
<section class="slideshow">

    <!-- slideshow:navigation START -->
    <ul class="navigation">
         <!-- slideshow:navigation:item START -->
        <?php
        foreach ($banner as $key => $value) {
        ?>
        <li class="navigation-item  <?php if ($key==0) echo "active"?>">
            <span class="rotate-holder"><?php echo $value['title']?></span>
            <span class="background-holder" style="background-image: url(<?php echo $value['thumb']?>);"></span>
        </li>
        <?php }?>

        <!-- slideshow:navigation:item END -->


    </ul>
    <!-- slideshow:navigation END -->


    <!-- slideshow:details START -->
    <div class="detail">

        <!-- slideshow:details START -->
        <?php
        foreach ($banner as $key => $value) {
        ?>
        <div class="detail-item   <?php if ($key==0) echo "active"?>">
            <a target="_blank" href="<?php echo url('/thread/' . $value['id']) ?>">
                <div class="headline"><?php echo $value['title']?></div>
            </a>
            <div class="background" style="background-image: url(<?php echo $value['thumb']?>)"></div>
        </div>
        <?php }?>
        <!-- slideshow:details END -->


    </div>
    <!-- slideshow:details END -->

</section>
<!-- slideshow END -->
<script src="banner/welcome/js/jquery-1.11.0.min.js"></script>
<script src="banner/welcome/js/TweenMax.min.js"></script>
<script src="banner/welcome/js/imagesloaded.pkgd.min.js"></script>
<script src="banner/welcome/js/CSSPlugin.min.js"></script>
<script src="banner/welcome/js/TextPlugin.min.js"></script>
<script src="banner/welcome/js/demo.js"></script>
</body>
</html>