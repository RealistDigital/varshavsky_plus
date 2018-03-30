<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_floor_mob.php'; ?>
<?php else : ?>
<?
/* FILTER LINK */
$query_filter = "SELECT * FROM _main WHERE type_tpl='23'";
$filter_rec = DB::query($query_filter);
$filter = DB::fetchAssoc($filter_rec);
$filter_name = $filter['name_'.LANG];
$filter_link = $filter['url'];

$parent = getGeneralSubqueryInfo($I['id'],2,  array('id', 'name_'.LANG, 'url', 'compas'));

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
		if($dom['id'] == $parent['id']){
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
	
/* FLATS */   
	$query_flat = "SELECT 
				 flat.id,
				 flat.url,
				 flat.coordinates_y,
				 flat.coordinates_x,
				 flat.path_svg,
				 flat.status,
				 flat.type_marker,
				 plan.general_space,
				 plan.living_space,
				 flat.name_".LANG."
				 
				FROM 
					_main as flat,
					_main as plan
				WHERE
					flat.parent = ".$I['id']."
					AND flat.visible_".LANG."='yes'
					AND flat.plan = plan.id
			";
	$flat_rec = DB::query($query_flat);
	while($flat = DB::fetchAssoc($flat_rec)){	
		//print_r($flat);
		$draw_flat .="$().drawSvg('draw', {
						path : '".$flat['path_svg']."',
				        idLine : '".$flat['id']."',
						linesName  : 'line1',
		                raphaelName : 'firstRaphael',";
		if($flat['status'] == 0){		// в продаже
			$draw_flat .="href : '/".LANG."/".$flat['url']."',
						fill : '#c2921d',
						fillOpacity:0.58,
		                opacity : 0";
		}else if($flat['status'] == 1){	// продано
			$draw_flat .="fill : '#fff',
						fillOpacity:1,
						houseState:1,
		                opacity : 1";			
		}else{							// бронь
			$draw_flat .="href : '/".LANG."/".$flat['url']."',
						fill : '#303035',
						fillOpacity:0.43,
						houseState:1,
		                opacity : 1";
		}
		                
		$draw_flat .="});";
		
		$top = (($flat['coordinates_y'])*2/720)*100;
		$left = (($flat['coordinates_x'])*2/880)*100; 
		
		if($flat['status'] == 0){		// в продаже
			$flat_marker .="<div class='flat_marker' data-id='".$flat['id']."' style='top:".$top."%; left: ".$left."%'>
			    			<div class='flat_m_left'>".$flat['name_'.LANG]."</div>
			    			<div class='flat_m_right'>
			    				<div class='flat_m_top'>".$flat['general_space']."</div>
			    				<div class='flat_m_bot'>".$flat['living_space']."</div>
			    			</div>
			    		</div>";
		}else if($flat['status'] == 1){	// продано
			$flat_marker .="<div class='flat_marker_sold' style='top:".$top."%; left: ".$left."%'>Продано</div>";
		}else{
			$flat_marker .="<div class='flat_marker_bron' style='top:".$top."%; left: ".$left."%'>заброньовано</div>";
			
		}
	}
 ?>

<div class="floor_wrap small_logo">
	<!-- HEADER -->
	<? require_once (URL_BLOCKS . 'header.php');?>
	<!-- END HEADER -->
	
	<!-- BTN BACK -->
	<a href="/<?=LANG?>/<?=$parent['url']?>" class="btn_back">
		<div class="btn_back_arrow"></div>
		<span>ДО ВИБОРУ будинку</span>
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
    
    <!-- GENPLAN -->
    <div class="gp_wr">
    	<img src="/public/files/genplan/genplan_1.png" class="gp_img" id="genplan_img">
    	<div id="genplan_svg"></div>
    	<?=$gp_marker?>
    	<!--<div class="gp_marker">Дом 1</div>-->
    </div>
    <!-- END GENPLAN -->
    
    <!-- FLOOR IMG -->
    <div class="floor_img_wrap">
    	<div class="floor_img_tittle"><?=$parent['name_'.LANG]?>, поверх <?=$I['name_'.LANG]?></div>
    	<div class="floor_img_wr">
    		<img src="/<?=$I['img']?>" id="floor_img">
    		<div id="floor_svg"></div>
    		
    		<!-- FLAT MARKERS -->
    		<?=$flat_marker?>
    		<?/*<div class="flat_marker" data-id="1">
    			<div class="flat_m_left">3K</div>
    			<div class="flat_m_right">
    				<div class="flat_m_top">49,70</div>
    				<div class="flat_m_bot">102,2</div>
    			</div>
    		</div>
    		
    		<div class="flat_marker_bron">заброньовано</div>
    		
    		<div class="flat_marker_sold">Продано</div>*/?>
    		<!-- END FLAT MARKERS -->
    		
    		<!-- COMPAS -->
	    	<img class="compas" src="/public/img/compas.png" style="transform:rotate(<?=$parent['compas']?>deg) ">
	    	<!-- END COMPAS -->
    		
    	</div>
    	
    	
    </div>
    <!-- END FLOOR IMG -->
    
</div>
<script>
    $(document).ready(function(){
        setTimeout(function() {
            var screenImage = $('#floor_img');
            var theImage = new Image();
            theImage.src = screenImage.attr('src');

            var imageWidth = theImage.width;
            var imageHeight = theImage.height;

            // подставляем реальные размеры изображения
            if(imageWidth==0) {
                imageWidth = 880;
            }
            if(imageHeight==0) {
                imageHeight = 720;
            }

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
                wrapInitName    : "floor_svg",
                linesName       : "line1",
                raphaelName     : "firstRaphael",
                wpDrawSvg       : "svggroup1",
                widthScale      : imageWidth,
                heightScale     : imageHeight
            });
				
			<?=$draw_flat?>
			// flat marker
			/*$().drawSvg('draw', {
				href : 'javascript:void(0)',
				path : 'M196 380,L193 218,L323 218,L323 380Z',
		        idLine : '1',
				linesName  : 'line1',
                raphaelName : 'firstRaphael',
				fill : '#c2921d',
				fillOpacity:0.58,
                opacity : 0
            });

			// flat bron
            $().drawSvg('draw', {
				href : 'javascript:void(0)',
				path : 'M364 380,L364 218,L495 218,L495 380Z',
		        idLine : '2',
				linesName  : 'line1',
                raphaelName : 'firstRaphael',
				fill : '#303035',
				fillOpacity:0.43,
				houseState:1,
                opacity : 1
            });
            
            // flat sold
            $().drawSvg('draw', {
				path : 'M64 80,L64 18,L95 18,L95 80Z',
		        idLine : '2',
				linesName  : 'line1',
                raphaelName : 'firstRaphael',
				fill : '#fff',
				fillOpacity:1,
				houseState:1,
                opacity : 1
            });*/
            
            
            $().drawSvg("init",{
                wrapInitName    : "genplan_svg",
                linesName       : "line2",
                raphaelName     : "secondRaphael",
                wpDrawSvg       : "svggroup2",
                widthScale      : imageWidthGenplan,
                heightScale     : imageHeightGenplan
            });
			
			<?=$draw_genplan?>
            /*$().drawSvg('draw', {
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

                
            function resizePage () {
            	var floor_width = $('#floor_img').width();
            	var floor_height = $('#floor_img').height();
                $().drawSvg('resize', {
                    raphaelName : 'firstRaphael',
                    imgWidth    : floor_width,
                    imgHeight   : floor_height
                });
                $().drawSvg('resize', {
                    raphaelName : 'secondRaphael',
                    imgWidth    : genplanImage.width(),
                    imgHeight   : genplanImage.height()
                });
            }

            $(window).resize(resizePage);
            resizePage ();
        }, 500);
    });
</script>
<?endif?> 