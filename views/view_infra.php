<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_infra_mob.php'; ?>
<?php else : ?>
 <?
	$type_m = array(1 => 'school',
		2 => 'health',
		3 => 'sport',
		4 => 'shops',
		5 => 'funs');
	$here = getGeneralInfo(array('type_tpl' =>6),array('id'));
	
	$locatio = getGeneralInfoCycle($here['id'],array('id','name_'.LANG,'map_coordinates_x','map_coordinates_y','img', 'img_2','add_space')); 
	
	if(is_array($locatio)){
	$i=0;
	$i2=0;
	foreach($locatio as $mm){$i++;	
		if($i == 1){
			$marker_html .="<div class='map_filt_li  map_filt_li_check'   data-tp='".$mm['add_space']."'>";
		}else{
			$marker_html .="<div class='map_filt_li'   data-tp='".$mm['add_space']."'>";
		}
		$marker_html .="<div class='check_wr'>
			 				<div class='check_1'></div>
			 				<div class='check_2'></div>
			 			</div>
			 			<div class='map_filt_img_wr'>
			 				<img src='/".$mm['img_2']."' class='map_filt_img'>
			 			</div>
			 			<div class='map_filt_text'>- ".$mm['name_'.LANG]."</div>
			 		</div>";
			 			$locatio2 = getGeneralInfoCycle($mm['id'],array('name_'.LANG,'map_coordinates_x','map_coordinates_y','img','add_space','short_text_'.LANG)); 
						if(is_array($locatio2)){
							foreach($locatio2 as $mm2){$i2++;
								
								if($i2==1){
									$l_html .=  '["'.addslashes($mm2['name_'.LANG]).'",'.$mm2['map_coordinates_x'].', '.$mm2['map_coordinates_y'].', "/'.$mm['img'].'", "'.$mm['add_space'].'", "'.$mm2['short_text_'.LANG].'"]';
								} else {
									$l_html .= ', '.addslashes($mm2['name_'.LANG]).'", '.$mm2['map_coordinates_x'].', '.$mm2['map_coordinates_y'].', "/'.$mm['img'].'", "'.$mm['add_space'].'", "'.$mm2['short_text_'.LANG].'"]';
								}
							}
						}			
		$marker_html .= "</ul>";
	}
}
?>
<!-- GOOGLE MAPS -->	
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCByu5g9JAIHG2RNPPK48IgmMaT3hrtsPQ&signed_in=true&libraries=places" ></script>
    <script src="/public/js/libs/custom-google-marker.js"></script>

<div class="map_wrap small_logo ">
    <!-- HEADER -->
	<? require_once (URL_BLOCKS . 'header.php');?>
	<!-- END HEADER -->

	<div id="map_infra"></div>
	       
	<!--<div class="map-marker">
		<div class="map_marker " style="top:40%;left:30%;background-image: url(/public/files/marker/map_marker_book.png);">
		    <div class="marker_tittle">
		        <div class="marker_tittle_text">ТЦ Навигатор</div>
		    </div>
		</div>
	</div>-->
	  
	 <!-- MARKER FILTER -->
	 <div class="map_filt_wrap">
	 	<div class="map_filt_wr map_filt_wr_open">
	 		<div class="map_filt_btn"></div>
	 		<div class="map_filt_info">
	 			<div class="map_filt_tittle">Інфраструктура</div>
	 			<?=$marker_html?>
		 		<!--<div class="map_filt_li">
		 			<div class="check_wr">
		 				<div class="check_1"></div>
		 				<div class="check_2"></div>
		 			</div>
		 			<div class="map_filt_img_wr">
		 				<img src="/public/files/marker/marker_det_sad.png" class="map_filt_img">
		 			</div>
		 			<div class="map_filt_text">- Дитячі садочки</div>
		 		</div>-->
	 		</div>
	 	</div>
	 </div>      
	 <!-- END MARKER FILTER -->
	         <script>
				$(document).ready(function() {
					
				var locations = [ // 0-title , 1-koord1, 2-koord2, 3-point_img, 4-group of markers
					<?=$l_html ?>
				];
					
					$('.hide_filters').click(function(){
							$(this).removeClass('visible');
							$('.filters').removeClass('visible');
							$('.show_filters').addClass('visible');
					});
					$('.show_filters').click(function(){
							$(this).removeClass('visible');
							$('.filters').addClass('visible');
							$('.hide_filters').addClass('visible');
					});
					
					
				    var map;
				    function callMap() {
				        // настройки карты
				        var latlng = new google.maps.LatLng(50.406234, 30.509664);	// map center
				        var settings = {
				            zoom: 14,	
				            disableDefaultUI:true,
				            center: latlng,
				            styles: mapStyle
				        };

				        map = new google.maps.Map(document.getElementById("map_infra"), settings);

				        var image = {
				            url: '/public/img/marker_house.png',
				        };

				        var companyPos = new google.maps.LatLng(50.406234, 30.509664);

				        var companyMarker = new google.maps.Marker({
				            position: companyPos,
				            map: map,
				            icon: image,
				            zIndex: 4
				        });
				        
				        // генерим маркера на карте
						for (var i = 0; i < locations.length; i++) {
					        var location = locations[i];
					        new CustomMarker(
								location[1],
								location[2],
								map,
								{ class : 'map-marker' , type_marker : location[4] }
							);
							console.log('some');
					    }

					    // вставляем в маркера контент
						google.maps.event.addListenerOnce(map,'idle',function(){
							for (var i = 0; i < locations.length; i++) {
								var location = locations[i];
								if(location[4]==1){
									$('.map-marker').eq(i).append(
										'<div class="map_marker" style="background-image: url('+location[3]+');">'
								           +' <div class="marker_tittle">'
								                +'<div class="marker_tittle_text">'+location[5]+'</div>'
								            +'</div>'
								        +'</div>'
									).addClass('show_marker');
								} else {
									$('.map-marker').eq(i).append(
										
										'<div class="map_marker " style="background-image: url('+location[3]+');">'
								           +' <div class="marker_tittle">'
								                +'<div class="marker_tittle_text">'+location[5]+'</div>'
								            +'</div>'
								        +'</div>'
								     );
									//).hide();	
								}
							}
						});
				    }
				   callMap();
				   // google.maps.event.addDomListener(window, 'load', callMap);
				   
						$('.map_filt_li').click(function(){	
							if ($(this).hasClass('map_filt_li_check')){
								var n_infr = $(this).data('tp');
							
								$(this).removeClass('map_filt_li_check');
								$('.map-marker').each(function(){
									if($(this).data('tm')==n_infr){
										//$(this).hide();
										$(this).removeClass('show_marker');
									}
								});
							} else {
								$(this).removeClass('map_filt_li_check');
								$(this).addClass('map_filt_li_check');
								var n_infr = $(this).data('tp');
								$('.map-marker').each(function(){
									if($(this).data('tm')==n_infr){
										//$(this).show();
										$(this).addClass('show_marker');
									} 
								});
							}
						});
				});
				</script>
		<!-- FOOTER -->
		<? //require_once (URL_BLOCKS . 'footer_white.php');?>
		<!-- END FOOTER -->
	</div>

<?php endif; ?>