<?php
// Кодировка
header('Content-type: text/html; charset=UTF-8');

// Config
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

if(!Lib::checkAJAX()) exit(':)');

// Обработка переменных
$id   = (int) $_REQUEST['id'];

if($id>0){

	$query = "SELECT img FROM _main WHERE parent='$id' AND visible_".LANG."='yes' ORDER BY position LIMIT 1000";
	$res    = DB::query($query);
	
    while($f = DB::fetchAssoc($res)){
		$html .= "<div class='swiper-slide'>
					<img src='/".$f['img']."' alt='".$f['name_'.LANG]."' title='".$f['name_'.LANG]."' class='gallery_pop-up_img'>
				</div>";
	}
	
	$response   = array(
		'html' 	=>	$html,
	    'result'    =>  1
	);
	
} else {

	$response   = array(
    	'result'    =>  0
	);
	
}

// response .. 
echo json_encode($response);