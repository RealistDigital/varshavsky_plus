<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_filter_mob.php'; ?>
<?php else : ?> 
<?
/* FLATS LINK */
$flats = getGeneralInfo(array('type_tpl' => 23) , array('url'));
$flats_link = $flats['url'];


/* MIN/MAX GENERAL SPACE */
$query_fil = "SELECT  	
					 MIN(CAST(plan.general_space AS UNSIGNED)) as general_space_from,
					 MAX(CAST(plan.general_space AS UNSIGNED)) as general_space_to
				FROM 
					_main as house,
					_main as floor,
					_main as flat,
					_main as plan
				WHERE
					house.type_tpl = '20'
					AND house.visible_".LANG."='yes'
					AND floor.parent = house.id
					AND floor.visible_".LANG."='yes'
					AND flat.parent = floor.id
					AND flat.visible_".LANG."='yes'
					AND plan.id= flat.plan
					AND plan.visible_".LANG."='yes'
			";
$filters = DB::query($query_fil);
while($fil = DB::fetchAssoc($filters)){
	$general_space_from = $fil['general_space_from'];
	$general_space_to = $fil['general_space_to'];
}
/* FLOORS */
$query_floors = "SELECT  	
				 	MIN(CAST(floor.name_".LANG." AS UNSIGNED)) as floor_from,
					MAX(CAST(floor.name_".LANG." AS UNSIGNED)) as floor_to
				 	
				FROM 
					_main as house,
					_main as floor
				WHERE
					house.type_tpl = '20'
					AND house.visible_".LANG."='yes'
					AND floor.parent = house.id
					AND floor.visible_".LANG."='yes'
					
			";
$floors = DB::query($query_floors);
$f = 0;
$floor_froms;
while($floor = DB::fetchAssoc($floors)){
	$floor_from = $floor['floor_from'];	// минимальный этаж						
	$floor_to = $floor['floor_to'];		// максимальный этаж
}

/* MIN/MAX ROOMS */
$query_fil = "SELECT  	
					 MIN(CAST(plan.count_rooms AS UNSIGNED)) as count_rooms_from,
					 MAX(CAST(plan.count_rooms AS UNSIGNED)) as count_rooms_to
				FROM 
					_main as house,
					_main as floor,
					_main as flat,
					_main as plan
				WHERE
					house.type_tpl = '20'
					AND house.visible_".LANG."='yes'
					AND floor.parent = house.id
					AND floor.visible_".LANG."='yes'
					AND flat.parent = floor.id
					AND flat.visible_".LANG."='yes'
					AND plan.id= flat.plan
					AND plan.visible_".LANG."='yes'
			";
$filters = DB::query($query_fil);
while($fil = DB::fetchAssoc($filters)){
	$count_rooms_from = $fil['count_rooms_from'];
	$count_rooms_to= $fil['count_rooms_to'];
}

/* IF FOLTER LINK WITH PARAMETRS */
$general_space_from_filter = htmlspecialchars($_REQUEST['area_from']);
if($general_space_from_filter ==null){
	$general_space_from_filter = $general_space_from;
}else{
	$general_space_from_filter = $general_space_from_filter;
}
$general_space_to_filter = htmlspecialchars($_REQUEST['area_to']);
if($general_space_to_filter == null){
	$general_space_to_filter = $general_space_to;
}else{
	$general_space_to_filter = $general_space_to_filter;
}
$floor_from_filter = htmlspecialchars($_REQUEST['floor_from']);
if($floor_from_filter == null){
	$floor_from_filter = $floor_from;
}else{
	$floor_from_filter = $floor_from_filter;
}
$floor_to_filter = htmlspecialchars($_REQUEST['floor_to']);
if($floor_to_filter == null){
	$floor_to_filter = $floor_to;
}else{
	$floor_to_filter = $floor_to_filter;
}
$rooms_from_filter = htmlspecialchars($_REQUEST['rooms_from']);
if($rooms_from_filter == null){
	$rooms_from_filter = $count_rooms_from;
}else{
	$rooms_from_filter = $rooms_from_filter;
}

$rooms_to_filter = htmlspecialchars($_REQUEST['rooms_to']);
if($rooms_to_filter == null){
	$rooms_to_filter = $count_rooms_to;
}else{
	$rooms_to_filter = $rooms_to_filter;
}




$with_terasa = htmlspecialchars($_REQUEST['with_terasa']);
$without_terasa = htmlspecialchars($_REQUEST['without_terasa']);

if($with_terasa==1 && $without_terasa==''){
	$window_sql = "AND plan.window='1'";
} else if ($with_terasa=='' && $without_terasa==2){
	$window_sql = "AND plan.window='2'";
} else {
	$window_sql = "";
}



$noth = (int) $_REQUEST['noth'];
$south = (int) $_REQUEST['south'];
$west = (int) $_REQUEST['west'];
$east = (int) $_REQUEST['east'];

if($noth>0 || $south>0 || $west>0 || $east>0){
	$storona_sql = "AND (";
	$or=0;
	if($noth>0){
		$storona_sql .= "plan.side='".$noth."'";
		$or=1;
	}
	
	if($south>0){
		if($or==1){
			$storona_sql .= "OR ";
		}
		$storona_sql .= "plan.side2='".$south."'";
		$or=1;
	}
	
	if($west>0){
		if($or==1){
			$storona_sql .= "OR ";
		}
		$storona_sql .= "plan.side3='".$west."'";
		$or=1;
	}
	
	if($east>0){
		if($or==1){
			$storona_sql .= "OR ";
		}
		$storona_sql .= "plan.side4='".$east."'";
		$or=1;
	}
	
	$storona_sql .= ")";
}

$rooms_sql = "AND CAST(plan.count_rooms AS UNSIGNED) >= '".$rooms_from_filter."' AND CAST(plan.count_rooms AS UNSIGNED) <= '".$rooms_to_filter.".9999'";
$floor_sql = "AND CAST(floor.name_".LANG." AS UNSIGNED) >= '".$floor_from_filter."' AND CAST(floor.name_".LANG." AS UNSIGNED) <= '".$floor_to_filter.".9999'";
$area_sql = "AND CAST(plan.general_space AS UNSIGNED) >= '".$general_space_from_filter."' AND CAST(plan.general_space AS UNSIGNED) <= '".$general_space_to_filter.".9999'";

/* ALL FLATS */
$query = "SELECT  flat.id as flat_id,
 					house.id as house_id,
 					house.name_ua as house_name_ua,
					flat.name_".LANG.",
					flat.url,
					house.name_".LANG." as house_tittle,
					plan.img as preview_img,
					plan.general_space,
					plan.living_space
		FROM 
			_main as house,
			_main as floor,
			_main as flat,
			_main as plan
		WHERE
			house.type_tpl = '20'
			AND house.visible_".LANG."='yes'
			AND floor.parent = house.id
			AND floor.visible_".LANG."='yes'
			AND flat.parent = floor.id
			AND flat.visible_".LANG."='yes'
			AND plan.id= flat.plan
			AND plan.visible_".LANG."='yes'
			".$rooms_sql."
			".$floor_sql."
			".$area_sql."
			".$window_sql."
			".$storona_sql."
			GROUP BY flat.id
			ORDER BY flat.position
	";
$flats = DB::query($query);
$flat_count = 0;
while($fl = DB::fetchAssoc($flats)){$flat_count++;
	$flat_html .="<a href='/".LANG."/".$fl['url']."' class='fil_fl_wr'>
					<div class='fil_fl_top'>
						<div class='fil_fl_type'>".$fl['name_'.LANG]."</div>
						<div class='fil_fl_area'>
							<div class='fil_fl_space'>Загальна пл. - ".$fl['general_space']." м<sup>2</sup></div>
							<div class='fil_fl_space'>Житлова пл. - ".$fl['living_space']." м<sup>2</sup></div>
						</div>
					</div>
					<div class='fil_fl_bot'>
						<img src='/".$fl['preview_img']."' class='fil_fl_img'>
					</div>
				</a>";
}
?>
<div class="fil_wrap small_logo">
	<!-- HEADER -->
	<? require_once (URL_BLOCKS . 'header.php');?>
	<!-- END HEADER -->
	
	<!-- FILTER PARAMETRS -->
	<form class="fil_polz_wrap" name="filter" id="filter" method="GET" action="">
		<div class="fil_par_wr">
			<div class="filter_tittle"><?=$I['name_'.LANG]?></div>
			
			<div class="fil_polz_wr"><!-- COUNT ROOMS -->
	            <div class="fil_polz_tittle">Кількіть кімнат</div>
	            <div id="fil_count_rooms" class="fil_par_polzunok"></div>
	            <div class="fil_polz_values">
	                <div id="value_count_rooms_from" class="fil_polz_val"></div>
	                <div id="value_count_rooms_to" class="fil_polz_val"></div>
	            </div>
	            <input id="rooms_from" type="hidden" name="rooms_from" value="<?=$rooms_from_filter?>">
	            <input id="rooms_to" type="hidden" name="rooms_to" value="<?=$rooms_to_filter?>">
	        </div>
	        
	        <div class="fil_polz_wr"><!-- AREA -->
	            <div class="fil_polz_tittle">Площа (м<sup>2</sup>)</div>
	            <div id="fil_area" class="fil_par_polzunok"></div>
	            <div class="fil_polz_values">
	                <div id="value_area_from" class="fil_polz_val"></div>
	                <div id="value_area_to" class="fil_polz_val"></div>
	            </div>
	            <input id="area_from" type="hidden" name="area_from" value="<?=$general_space_from_filter?>">
	            <input id="area_to" type="hidden" name="area_to" value="<?=$general_space_to_filter?>">
	        </div>
	        
	         <div class="fil_polz_wr"><!-- FLOOR -->
	            <div class="fil_polz_tittle">Поверх</div>
	            <div id="fil_floor" class="fil_par_polzunok"></div>
	            <div class="fil_polz_values">
	                <div id="value_floor_from" class="fil_polz_val"></div>
	                <div id="value_floor_to" class="fil_polz_val"></div>
	            </div>
	            <input id="floor_from" type="hidden" name="floor_from" value="<?=$floor_from_filter?>">
	            <input id="floor_to" type="hidden" name="floor_to" value="<?=$floor_to_filter?>">
	        </div>
	        
	        <div class="fil_polz_tittle_2">Наявність тераси</div><!-- TERASA -->
	        <div class="fil_checkbox ">
	        	<div class="checkbox_wr  <?if($with_terasa != ''){ echo 'checkbox_active';}?> fil_with_terasa" data-type="with_terasa" data-value="1">
	        		<div class="checkbox "></div>
	        		<div class="checkbox_tittle">з терасою</div>
	        		<div class="fil_check_wr">
		 				<div class="check_1"></div>
		 				<div class="check_2"></div>
		 			</div>
		 			 <input id="with_terasa" type="hidden" name="with_terasa" value="<?=$with_terasa?>">
	        	</div>
	        	
	        	
	        	<div class="checkbox_wr <?if($without_terasa != ''){ echo 'checkbox_active';}?> fil_without_terasa" data-type="without_terasa" data-value="2">
	        		<div class="checkbox" ></div>
	        		<div class="checkbox_tittle">без тераси</div>
	        		<div class="fil_check_wr">
		 				<div class="check_1"></div>
		 				<div class="check_2"></div>
		 			</div>
		 			<input id="without_terasa" type="hidden" name="without_terasa" value="<?=$without_terasa?>">
	        	</div>
			</div>
			
			<div class="fil_polz_tittle_2">Сторона світу</div><!-- WORLD SIDE -->
	        <div class="fil_checkbox">
	        	<div class="checkbox_wr <?if($noth != ''){ echo 'checkbox_active';}?>" data-type="noth" data-value="1">
	        		<div class="checkbox" ></div>
	        		<div class="checkbox_tittle">Пн.</div>
	        		<div class="fil_check_wr">
		 				<div class="check_1"></div>
		 				<div class="check_2"></div>
		 			</div>
		 			<input id="noth" type="hidden" name="noth" value="<?=$noth?>">
	        	</div>
	        	<div class="checkbox_wr <?if($south != ''){ echo 'checkbox_active';}?>" data-type="south" data-value="2">
	        		<div class="checkbox" ></div>
	        		<div class="checkbox_tittle">Пд.</div>
	        		<div class="fil_check_wr">
		 				<div class="check_1"></div>
		 				<div class="check_2"></div>
		 			</div>
		 			<input id="south" type="hidden" name="south" value="<?=$south?>">
	        	</div>
	        	<div class="checkbox_wr <?if($west != ''){ echo 'checkbox_active';}?>" data-type="west" data-value="3">
	        		<div class="checkbox" ></div>
	        		<div class="checkbox_tittle">Зх.</div>
	        		<div class="fil_check_wr">
		 				<div class="check_1"></div>
		 				<div class="check_2"></div>
		 			</div>
		 			<input id="west" type="hidden" name="west" value="<?=$west?>">
	        	</div>
	        	<div class="checkbox_wr <?if($east != ''){ echo 'checkbox_active';}?>" data-type="east" data-value="4">
	        		<div class="checkbox"></div>
	        		<div class="checkbox_tittle">Сх.</div>
	        		<div class="fil_check_wr">
		 				<div class="check_1"></div>
		 				<div class="check_2"></div>
		 			</div>
		 			<input id="east" type="hidden" name="east" value="<?=$east?>">
	        	</div>
			</div>
			
			<div class="fil_btn_done">Підібрати</div>    
		</div>
	</form>
	<!-- END FILTER PARAMETRS -->
	
	<!-- FILTER RESULT -->
	<div class="fil_res_wrap">
	
		 <?
		$link_back = 'http://'.$_SERVER['HTTP_HOST'].'/'.LANG.'/'.$I['url'];
		//print_r($_SERVER[HTTP_REFERER]);
		if(!isset($_SERVER[HTTP_REFERER])){
			$_SESSION[link_back] = 'http://'.$_SERVER['HTTP_HOST'].'/'.LANG.'/';
		} else if(!strstr($_SERVER[HTTP_REFERER],$link_back)){
			$_SESSION[link_back] = $_SERVER[HTTP_REFERER];
		} else {
			
		}
    	
    ?>
		<a href="<?=($_SESSION[link_back]?$_SESSION[link_back]:"javascript:void(0)")?>" class="fil_res_close close_hover">
			<div class="close_wr">
				<div class="close_line_1">
					<div class="close_line_1_stroke"></div>
					<div class="close_line_1_hover"></div>
				</div>
				<div class="close_line_2">
					<div class="close_line_2_stroke"></div>
					<div class="close_line_2_hover"></div>
				</div>
			</div>
			
			<div class="close_new_text">Закрити</div>
		</a>
	
		<div class="fil_res_count">Знайдено квартир:<span><?=$flat_count?></span></div>
		<div class="fil_res_wr">
			
			<div class="fil_res_scroll">
				<?=$flat_html?>
				<!--<a href="javascript:void(0)" class="fil_fl_wr">
					<div class="fil_fl_top">
						<div class="fil_fl_type">1a</div>
						<div class="fil_fl_area">
							<div class="fil_fl_space">Загальна пл. - 36,85 м<sup>2</sup></div>
							<div class="fil_fl_space">Житлова пл. - 21,20 м<sup>2</sup></div>
						</div>
					</div>
					<div class="fil_fl_bot">
						<img src="/public/files/filter_flats/filter_flat_test.jpg" class="fil_fl_img">
					</div>
				</a>-->
				
			</div>
		</div>
	</div>
	<!-- END FILTER RESULT -->
	
</div>
<script>
$(document).ready(function(){
/* ==================================
/* 	SCROLL 
=================================== */	
	$('.fil_res_scroll').mCustomScrollbar({
        scrollInertia: 150
    });
/* ===================================
/* POLZUNKI 
=================================== */
	// COUNT ROOMS
    $( "#fil_count_rooms" ).slider({
        range: true,
        min: <?=$count_rooms_from?>,
        max: <?=$count_rooms_to?>,
        values: [ <?=$rooms_from_filter?>, <?=$rooms_to_filter?> ],
        slide: function( event, ui ) {
            $( "#value_count_rooms_from" ).html(ui.values[ 0 ]);
            $( "#value_count_rooms_to" ).html(ui.values[ 1 ]);
            $( "#rooms_from" ).val(ui.values[ 0 ]);
            $( "#rooms_to" ).val(ui.values[ 1 ]);
        }
    });

    $( "#value_count_rooms_from" ).html($( "#fil_count_rooms" ).slider( "values", 0 ));
    $( "#value_count_rooms_to" ).html($( "#fil_count_rooms" ).slider( "values", 1 ));
	
	// AREA
    $( "#fil_area" ).slider({
        range: true,
        min: <?=$general_space_from?>,
        max: <?=$general_space_to?>,
        values: [<?=$general_space_from_filter?>, <?=$general_space_to_filter?> ],
        slide: function( event, ui ) {
            $( "#value_area_from" ).html(ui.values[ 0 ]);
            $( "#value_area_to" ).html(ui.values[ 1 ]);
            $( "#area_from" ).val(ui.values[ 0 ]);
            $( "#area_to" ).val(ui.values[ 1 ]);
        }
    });

    $( "#value_area_from" ).html($( "#fil_area" ).slider( "values", 0 ));
    $( "#value_area_to" ).html($( "#fil_area" ).slider( "values", 1 ));
    
    // FLOOR
    $( "#fil_floor" ).slider({
        range: true,
        min: <?=$floor_from?>,
        max: <?=$floor_to?>,
        values: [ <?=$floor_from_filter?>, <?=$floor_to_filter?> ],
        slide: function( event, ui ) {
            $( "#value_floor_from" ).html(ui.values[ 0 ]);
            $( "#value_floor_to" ).html(ui.values[ 1 ]);
            $( "#floor_from" ).val(ui.values[ 0 ]);
            $( "#floor_to" ).val(ui.values[ 1 ]);
        }
    });

    $( "#value_floor_from" ).html($( "#fil_floor" ).slider( "values", 0 ));
    $( "#value_floor_to" ).html($( "#fil_floor" ).slider( "values", 1 ));	
    
/* ==================================
/* 	CHECKBOX	
=================================== */

	$('body').on('click', '.checkbox_wr', function(){
		$(this).toggleClass('checkbox_active'); 
		var type = $(this).data('type');	
		var value = $(this).data('value');	
		if($(this).hasClass('checkbox_active')){
			$('#'+type).val(value);		
		}else{
			$('#'+type).val('');		
		}
	});    
/* ===================================
/* FILTER	 
=================================== */   
     $('body').on('click', '.fil_btn_done', function(){
   		/*var general_space_from = $('#value_area_from').html();			// space
		var general_space_to = $('#value_area_to').html();	
			
		var floor_from = $('#value_floor_from').html();				// floors
		var floor_to = $('#value_floor_to').html();		
		
		var rooms_from = $('#value_count_rooms_from').html();				// floors
		var rooms_to = $('#value_count_rooms_to').html();								
		
		var windows = '';											// terasa
		var win_number = 0;
		$('[data-type="terasa"]').each(function(i){
			var window = $(this).data('value');
			if($('[data-type="terasa"]').eq(i).hasClass('checkbox_active')){
				if(win_number == 0){
					windows = window;
					win_number++;
				}else{
					windows = windows + ',' + window;
				}
			}
		});
		var spaces = '';											// space
		var number_2 = 0;
		$('[data-type="side"]').each(function(i){
			var space = $(this).data('value');
			if($('[data-type="side"]').eq(i).hasClass('checkbox_active')){
				if(number_2 == 0){
					spaces = space;
					number_2++;
				}else{
					spaces = spaces + ',' + space;
				}
			}
		});*/
		
		$('#filter').submit();
		//console.log(spaces+' spaces');
		
		/*var filter_hash = '?general_space_from='+general_space_from+'&general_space_to='+general_space_to+'&floor_from='+floor_from+'&floor_to='+floor_to+'&rooms_from='+rooms_from+'&rooms_to='+rooms_to+'&spaces='+spaces+'&windows='+windows;
		
		window.location.assign('/<?=LANG?>/<?=$I["url"]?>'+filter_hash);*/
		
	});
});
</script>
<?endif?>