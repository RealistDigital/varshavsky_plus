<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_flats_mob.php'; ?>
<?php else : ?> 
<?
/* FILTER LINK */
$query_filter = "SELECT * FROM _main WHERE type_tpl='23'";
$filter_rec = DB::query($query_filter);
$filter = DB::fetchAssoc($filter_rec);
$filter_name = $filter['name_'.LANG];
$filter_link = $filter['url'];

/* HOUSES */   
	$query_dom = "SELECT 
				 floor.id,
				 floor.url,
				 floor.path_svg,
				 floor.name_".LANG.",
				 floor.coordinates_x,
				 floor.coordinates_y
				 
				FROM 
					_main as dom,
					_main as floor
				WHERE
					dom.parent = ".$I['id']."
					AND dom.visible_".LANG."='yes'
					AND floor.parent = dom.id
					AND floor.visible_".LANG."='yes'
			";
	$dom_rec = DB::query($query_dom);
	while($floor = DB::fetchAssoc($dom_rec)){		
		
		$top = (($floor['coordinates_y'])*2/980)*100;
		$left = (($floor['coordinates_x'])*2/1920)*100; 
		$draw_floor .= "
			$().drawSvg('draw', {
					href : '/".LANG."/".$floor['url']."',
					path : '".$floor['path_svg']."',
			        idLine : '".$floor['id']."',
					linesName  : 'line1',
	                raphaelName : 'firstRaphael',
					fill : '#c2921d',
	                opacity : 0,
	                fillOpacity: 0.78,
	                houseState: 0
	            });
	            
		";
		$floor_marker .="<div class='house_marker' data-id='".$floor['id']."' style='top:".$top."%;left:".$left."%;'>
            <div class='floor_number'>24</div>
            <div class='floor_title'>поверх</div>
        </div>";
				        
	}
?>
<div class="flats_wrap small_logo">
	<!-- HEADER -->
	<? require_once (URL_BLOCKS . 'header.php');?>
	<!-- END HEADER -->
	
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
    
	 <div id="houses_wrap">
        <img id="houses_img" src="/<?=$I['img']?>">
        <div id="houses_svg"></div>
        
        <!-- HOUSE MARKERS -->
        <?=$floor_marker?>
        <!--<div class="js_marker_1 house_marker" style="top:50%;left:50%;">
            <div class="floor_number">24</div>
            <div class="floor_title">поверх</div>
        </div>-->
         <!-- END HOUSE MARKERS -->
         
         <div class="choose_floor">
	        <h4 class="choose_floor_h4_1">Оберіть</h4>
	        <h4 class="choose_floor_h4_2">поверх</h4>
	    </div>
	    
	    <div class="house_tittle" style="top: 8%;left: 36%;">Будинок 1</div>
	    <div class="house_tittle" style="top: 22%;left: 60%;">Будинок 2</div>
	    
    </div>
    
</div>
<script>
$(document).ready(function() {
    
    setTimeout(function() {
        var screenImage = $('#houses_img');
        var theImage = new Image();
        theImage.src = screenImage.attr('src');

        var imageWidth = theImage.width;
        var imageHeight = theImage.height;

        // подставляем реальные размеры изображения
        if(imageWidth==0) {
            imageWidth = 1920;
        }
        if(imageHeight==0) {
            imageHeight = 980;
        }

        $().drawSvg("init",{
                wrapInitName    : "houses_svg",
                linesName       : "line1",
                raphaelName     : "firstRaphael",
                wpDrawSvg       : "svggroup1",
                widthScale      : imageWidth,
                heightScale     : imageHeight
            });
	
		<?=$draw_floor?>
		/*$().drawSvg('draw', {
			href : 'javascript:void(0)',
			path : 'M508 510,L507 173,L591 83,L778 127,L778 514,L594 521Z',
	        idLine : '1',
			linesName  : 'line1',
            raphaelName : 'firstRaphael',
			fill : '#c2921d',
			fillOpacity: 0.78,
            opacity : 0,
            houseState: 0
        });*/
            
        function resizePage () {
            $().drawSvg('resize', {
                raphaelName : 'firstRaphael',
                imgWidth    : screenImage.width(),
                imgHeight   : screenImage.height()
            });
        }

        $(window).resize(resizePage);
        resizePage ();
    }, 500);
});
</script>
<?endif?>