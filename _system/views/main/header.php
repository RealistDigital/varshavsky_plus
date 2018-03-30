<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>Admin Panel</title>
        <!-- CSS -->
        <link href="<?=SYS_PUBLIC?>css/style.css"  rel="stylesheet" type="text/css">
        <!-- Datepicker CSS -->
        <link href="<?=SYS_PLUGINS?>datepicker/css/jquery-ui-1.9.2.css"  rel="stylesheet" type="text/css">
        <!-- Modal window CSS -->
        <link href="<?=SYS_PLUGINS?>modal/css/modal.css"  rel="stylesheet" type="text/css">
        <!-- Planing CSS -->
        <link href="<?=SYS_PLUGINS?>planning/css/planning.css" rel="stylesheet" type="text/css">
        <!-- JS -->
        <script type="text/javascript" src="<?=SYS_PUBLIC?>js/jquery-1.8.1.min.js"></script>
        <script type="text/javascript" src="<?=SYS_PUBLIC?>js/jquery-ui-1.9.2.js"></script>
        <!-- Sort JS -->
        <script type="text/javascript" src="<?=SYS_PLUGINS?>draggable/js/draggable.js"></script>
        <!-- Tiny MCE JS -->
        <script type="text/javascript" src="<?=SYS_PLUGINS?>tiny_mce/tiny_mce.js"></script>
        <script type="text/javascript" src="<?=SYS_PLUGINS?>tiny_mce/init.js"></script>
        <!-- Modal window JS -->
        <script type="text/javascript" src="<?=SYS_PLUGINS?>modal/js/modal.js"></script>
        <!-- Raphael JS -->
        <script src="<?=SYS_PUBLIC?>js/raphael.js"></script>
        <!-- Planing Drag JS -->
        <script type="text/javascript" src="<?=SYS_PLUGINS?>planning/js/planning-drag.js"></script>
        <!-- Planing Draw JS -->
        <script type="text/javascript" src="<?=SYS_PLUGINS?>planning/js/draw/drawing.lib.js"></script>
        <!-- HotKeys JS -->
        <script type="text/javascript" src="<?=SYS_PLUGINS?>hotkeys/js/hotkeys.js"></script>
        
        <!-- Main JS -->
        <script type="text/javascript" src="<?=SYS_PUBLIC?>js/js_admin.js"></script>
    </head>
    <body data-template="<?=$data_info['type_tpl']?>">
        <!-- Main wp -->
        <div id="main-wp">
            <? // require_once(SYS_VIEWS."included/template.php"); ?>
            <!-- Main table -->
            <table id="main-table">
                <tr>
    