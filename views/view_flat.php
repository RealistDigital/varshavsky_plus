<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_flat_mob.php'; ?>
<?php else : ?> 
<?
/* FILTER LINK */
$query_filter = "SELECT * FROM _main WHERE type_tpl='23'";
$filter_rec = DB::query($query_filter);
$filter = DB::fetchAssoc($filter_rec);
$filter_name = $filter['name_'.LANG];
$filter_link = $filter['url'];

/* FLATS */
$parent = getGeneralSubqueryInfo($I['id'],2,  array('id', 'name_'.LANG, 'url', 'img'));
$flats = getGeneralSubqueryInfo($I['id'],3,  array('id', 'name_'.LANG, 'url', 'compas'));

/* HOUSES */   
$query_dom = "SELECT 
			 dom.id,
			 dom.url,
			 dom.path_svg,
			 dom.coordinates_x,
			 dom.coordinates_y,
			 dom.name_".LANG."
			 
			FROM 
				_main as dom
			WHERE
				dom.type_tpl = 20
				AND dom.visible_".LANG."='yes'
		";
$dom_rec = DB::query($query_dom);
$r = 0;
while($dom = DB::fetchAssoc($dom_rec)){	$r++;
	$gp_top = (($dom['coordinates_y'])/351)*100;
	$gp_left = (($dom['coordinates_x'])/362)*100; 

	$query_dom_child = "SELECT * FROM _main as dom_child WHERE dom_child.parent = ".$dom['id']." AND dom_child.visible_".LANG."='yes' ORDER by dom_child.position LIMIT 1";
	$dom_child_rec = DB::query($query_dom_child);
	while($dom_child = DB::fetchAssoc($dom_child_rec)){
		$another_child = $dom_child['url'];
	}

	$draw_genplan .="$().drawSvg('draw', {
		                path : '".$dom['path_svg']."',
		                idLine : '".$dom['id']."',
		                linesName  : 'line2',
		                raphaelName : 'secondRaphael',
		                fill : '#c2921d',
		                fillOpacity: 1,
		               ";
	if($dom['id'] == $flats['id']){
		$draw_genplan .="opacity : 1,
						houseState : 1";
	}else{
		$draw_genplan .="href :'/".LANG."/".$another_child."',
						opacity : 0,
						houseState : 0";
	}
	$draw_genplan .="});";
	$gp_marker .="<div class='gp_marker' style='top:".$gp_top."%; left: ".$gp_left."%;'>".$dom['name_'.LANG]."</div>";
}
/* FLAT */
$query_flats = "SELECT 
			 flat.name_".LANG." as flat_name,
			 flat.count_rooms,
			 flat.compas,
			 flat.id,
			 flat.img,
			 flat.img_2,
			 flat.files,
			 flat.general_space,
			 flat.living_space
			 
			FROM 
				_main as flat
			WHERE
				flat.id = ".$I['plan']."
				AND flat.visible_".LANG."='yes'
		
		";
		$section_flats = DB::query($query_flats);
		
		while($flat = DB::fetchAssoc($section_flats)){
			$general_space = $flat['general_space'];
			$living_space = $flat['living_space'];
			$flat_img = $flat['img'];
			$flat_img_2 = $flat['img_2'];
			$flat_file = $flat['files'];
			$count_room = $flat['count_rooms'];
			// explication
			$query_rooms = "SELECT * FROM _main as room WHERE room.parent = ".$flat['id']." AND room.visible_".LANG."='yes'";
			$rooms = DB::query($query_rooms);
			$r=0;
			while($room = DB::fetchAssoc($rooms)){$r++;
				$expl.="<div class='expl_tr'>
							    		<div>".$r."</div>
							    		<div class='expl_wr_room'>".$room['name_'.LANG]."</div>
							    		<div>-</div>
							    		<div class='expl_wr_number'>".$room['add_space']." м<sup>2</sup></div>
						    		</div>";
				$top_room_marker = (($room['coordinates_y'])/600)*100;
				$left_room_marker = (($room['coordinates_x'])/600)*100; 
                $expl_marker_html .=" <div class='marker_room' style='top: ".$top_room_marker."%;left: ".$left_room_marker."%;'>".$r."</div>";
			}
			
			/* COUNT ROOM */
			/*if($flat['count_room'] == 1){
				$cout_room = "".$langs[33]."";
			}else if($flat['count_room'] == 2){
				$cout_room = "".$langs[34]."";
			}else if($flat['count_room'] == 3){
				$cout_room = "".$langs[35]."";
			}else if($flat['count_room'] == 4){
				$cout_room = "".$langs[36]."";
			}else if($flat['count_room'] == 5){
				$cout_room = "".$langs[37]."";
			}*/
}
/* WINDOW TO */
/*if($I['window'] == 0){
	$window = "".$langs[41]."";
	$window = "".$langs[41]."";
}else if($I['window'] == 1){
	$window = "".$langs[42]."";
}*/

/* SIDE */
/*if($I['side'] == 0){
	$side = "".$langs[43]."";
}else if($I['side'] == 1){
	$side = "".$langs[44]."";
}else if($I['side'] == 2){
	$side = "".$langs[45]."";
}else if($I['side'] == 3){
	$side = "".$langs[46]."";
}*/



?>
<div class="floor_wrap small_logo">
	<!-- HEADER -->
	<? require_once (URL_BLOCKS . 'header.php');?>
	<!-- END HEADER -->
	
	<div class="flat_wr">
		<div class="wrap_left">
			<!-- BTN BACK -->
			<a href="/<?=LANG?>/<?=$parent['url']?>" class="btn_back">
				<div class="btn_back_arrow"></div>
				<span>ДО ВИБОРУ поверху</span>
			</a>
			<!-- END BTN BACK -->
			
			 <!-- FILTER BTN -->
		    <a href="/<?=LANG?>/<?=$filter_link?>" class="filt_btn_wr">
		    	<div class="filt_btn_lines">
		    		<div class="filt_line_1"></div>
		    		<div class="filt_line_2"></div>
		    		<div class="filt_line_3"></div>
		    	</div>
		    	<div class="filt_btn_text"><?=$filter_name?></div>
		    </a>
		    <!-- END FILTER BTN -->
		    
		    <!-- FLAT ON FLOOR -->
		    <div class="flat_on_floor_wr">
		    	<img src="/<?=$parent['img']?>" class="flat_on_floor_img" id="flat_on_floor_img">
		    	<div id="flat_on_floor_svg"></div>
		    </div>
		    <!-- FLAT ON FLOOR-->
		    
		    
		    <!-- GENPLAN -->
		    <div class="gp_wr">
		    	<img src="/public/files/genplan/genplan_1.png" class="gp_img" id="genplan_img">
		    	<div id="genplan_svg"></div>
		    	<?=$gp_marker?>
		    </div>
		    <!-- END GENPLAN -->
	    </div>
	    
	    <div class="wrap_middle">
		    <!-- FLAT IMG -->
		     <div class="flat_plan_wr">
			    <div class="flat_tittle"><?=$count_room?>-кімнатна квартира <span>Тип <?=$I['name_'.LANG]?></span></div>
			    
				<div class="flat_plan">
			    	<div class="flat_type flat_type_1 flat_type_active" data-type="1">	
				    	<div class="flat_img_wr">
				    		<img src="/<?=$flat_img?>" class="flat_img">
				    		<?=$expl_marker_html?>
				    		<!--<div class="marker_room" style="top:20%;left:20%;">1</div>-->
				    	</div>
			    	</div>
			    	<?if ($flat_img_2 != ''):?>
			    	<div class="flat_type flat_type_2" data-type="2">	
				    	<div class="flat_img_wr">
				    		<img src="/<?=$flat_img_2?>" class="flat_img">
				    		<?=$expl_marker_html?>
				    		<!--<div class="marker_room" style="top:10%;left:10%;">5</div>-->
				    	</div>
			    	</div>
			    	<?endif?>
		    	</div>
		    	
		    	
		    	<div class="change_view_wr">
		    		<div class="change_view change_view_active" data-view="1"><div class="change_view_bg">Розміри</div></div>
		    		<?if ($flat_img_2 != ''):?>
		    		<div class="change_view " data-view="2"><div class="change_view_bg">з меблями</div></div>
		    		<?endif?>
		    	</div>
		    	
		    	
		    </div>
	    <!-- END FLAT IMG -->
	    </div>
	    
	    <!-- EXPLICATION -->
	    <div class="wrap_right">
	    	<div class="expl_wrap">
		    	<img src="/public/img/compas.png" style="transform:rotate(<?=$flats['compas']?>deg)" class="flat_compas">
		    	
		    	<div class="flat_area">
		    		<div class="flat_area_div">
		    			<div class="flat_area_text	">Загальна пл.</div>
		    			<div class="flat_area_number"><?=$general_space?></div>
		    		</div>
		    		<div class="flat_area_div">
		    			<div class="flat_area_text">Житлова пл.</div>
		    			<div class="flat_area_number"><?=$living_space?></div>
		    		</div>
		    	</div>
		    	
		    	<div class="expl_wr">
			    	<div class="expl_scroll">
			    		<?=$expl?>
			    		<!--<div class="expl_tr">
				    		<div>1</div>
				    		<div class="expl_wr_room">Вітальняю</div>
				    		<div>-</div>
				    		<div class="expl_wr_number">12,69 м<sup>2</sup></div>
			    		</div>-->
		    		</div>
		    	</div>
		    	
		    	<?if($flat_file != ''):?>
		    	<a href="/<?=$flat_file?>" class="download_pdf" target="_blank">
		    		<div class="pdf_icon"></div>
		    		завантажити план квартири
		    	</a>
		    	<?endif?>
	    	</div>
	    </div>
	    <!-- END EXPLICATION -->
	    
    </div>
    
</div>
<script>
    $(document).ready(function(){
        setTimeout(function() {

            var genplanImage = $('#genplan_img');
            var theImageGenplan = new Image();
            theImageGenplan.src = genplanImage.attr('src');

            var imageWidthGenplan = theImageGenplan.width;
            var imageHeightGenplan = theImageGenplan.height;

            if(imageWidthGenplan==0) {
                imageWidthGenplan = 362;
            }
            if(imageHeightGenplan==0) {
                imageHeightGenplan = 351;
            }
            
            $().drawSvg("init",{
                wrapInitName    : "genplan_svg",
                linesName       : "line2",
                raphaelName     : "secondRaphael",
                wpDrawSvg       : "svggroup2",
                widthScale      : imageWidthGenplan,
                heightScale     : imageHeightGenplan
            });
			
			<?=$draw_genplan?>
           /* $().drawSvg('draw', {
                href : 'javascript:void(0)',
                path : 'M57 264,L70 112,L127 112,L137 264Z',
                idLine : '20',
                linesName  : 'line2',
                raphaelName : 'secondRaphael',
                fill : '#c2921d',
                fillOpacity: 1,
                opacity : 1,
                houseState : 0            
            });*/
            
			// FLAT ON FLOOR
			var flatImage = $('#flat_on_floor_img');
            var theImageFlat = new Image();
            theImageFlat.src = flatImage.attr('src');

            var imageWidthFlat = theImageFlat.width;
            var imageHeightFlat = theImageFlat.height;

            if(imageWidthFlat==0) {
                imageWidthFlat = 167;
            }
            if(imageHeightFlat==0) {
                imageHeightFlat = 135;
            }
            $().drawSvg("init",{
                wrapInitName    : "flat_on_floor_svg",
                linesName       : "line3",
                raphaelName     : "thirdRaphael",
                wpDrawSvg       : "svggroup1",
                widthScale      : imageWidthFlat,
                heightScale     : imageHeightFlat
            });
            
			// flat on floor
			$().drawSvg('draw', {
				path : '<?=$I['path_svg']?>',
		        idLine : '10',
				linesName  : 'line3',
                raphaelName : 'thirdRaphael',
				fill : '#c2921d',
				fillOpacity:1,
                opacity : 1
            }); 
                
                
            function resizePage () {
                $().drawSvg('resize', {
                    raphaelName : 'secondRaphael',
                    imgWidth    : genplanImage.width(),
                    imgHeight   : genplanImage.height()
                });
                $().drawSvg('resize', {
                    raphaelName : 'thirdRaphael',
                    imgWidth    : flatImage.width(),
                    imgHeight   : flatImage.height()
                });
            }

            $(window).resize(resizePage);
            resizePage ();
        }, 500);
    });
</script> 
<?endif?>