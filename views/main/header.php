<!DOCTYPE html>
<!--(c) All rights reserved. Developed by Realist Digital (https://realist.digital/)-->
<html lang="uk">
  <head>
    <meta charset='utf-8'>
    <meta name="keywords" content="<?=$I['meta_k_'.LANG];?>">
    <meta name="description" content="<?=$I['meta_d_'.LANG];?>">
    <link rel="icon" type="image/png" href="<?=URL_PUBLIC?>/img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title = $I['title_'.LANG] == "" ? $I['name_'.LANG] : $I['title_'.LANG];?></title>
 
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?=URL_PUBLIC?>css/fonts.css?<?=rand(0,999)?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=URL_PUBLIC?>css/style.css?<?=rand(0,999)?>">
    <link rel="stylesheet" href="<?=URL_PUBLIC?>css/jquery.mCustomScrollbar.min.css">
 
    <!-- JQuery JS -->
    <script src="<?=URL_PUBLIC?>js/libs/jquery-3.3.1.min.js"></script>
    <script src="<?=URL_PUBLIC?>js/libs/jquery-3.3.1.js"></script>
    <script src="<?=URL_PLUGINS?>hotkeys/js.js"></script>
    
    <!-- MASK FOR TELEPHON -->
    <script src="<?=URL_PUBLIC?>js/libs/jquery.maskedinput.js"></script>
    
    <!-- JQuery UI -->
    <script src="<?=URL_PUBLIC?>js/libs/jquery-ui.min.js"></script>
    <script src="<?=URL_PUBLIC?>js/libs/jquery.ui.touch-punch.min.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?=URL_PUBLIC?>css/jquery-ui.css?<?=rand(0,999)?>">
    
    <!-- MOFI SCROLLBAR -->
    <script src="<?=URL_PUBLIC?>js/libs/scroll_bar.mini.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?=URL_PUBLIC?>css/mofi_scroll_bar.css?<?=rand(0,999)?>">
   
    
    <!-- JS -->	
    <script src="<?=URL_PUBLIC?>js/script.js?<?=rand(0,999)?>"></script>
    
    <!-- SLIDER (swiper) -->
    <script src="<?=URL_PUBLIC?>js/libs/swiper.min.js?<?=rand(0,999)?>"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?=URL_PUBLIC?>css/swiper.min.css?<?=rand(0,999)?>">
    
    <!-- MAP -->
    <script src="<?=URL_PUBLIC?>js/map_style.js?<?=rand(0,999)?>"></script>
    
    <!-- SCROLLBAR -->
    <script src="<?=URL_PUBLIC?>js/libs/jquery.mCustomScrollbar.js?<?=rand(0,999)?>"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="<?=URL_PUBLIC?>css/jquery.mCustomScrollbar.css?<?=rand(0,999)?>">
    
    <!-- RAPHAEL -->
	<script src="<?=URL_PUBLIC?>js/libs/raphael-min.js?<?=rand(0,999)?>"></script>
	<script src="<?=URL_PUBLIC?>js/libs/scale.raphael.js?<?=rand(0,999)?>"></script>
	<script src="<?=URL_PUBLIC?>js/draw_svg.js?<?=rand(0,999)?>"></script>

    <!-- MOBILE -->
    <script src="<?=URL_PUBLIC?>js/libs/device.min.js?<?=rand(0,999)?>"></script>
	<? if($deviceTouch){?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?=URL_PUBLIC?>css/mobile_style.css?<?=rand(0,999)?>">
 	<?}?>
    
</head>
<body data-template="<?=$I['type_tpl']?>" data-lang="<?=LANG?>" data-domain="<?=$_SERVER['HTTP_HOST']?>" data-id="<?=$I['id']?>">
