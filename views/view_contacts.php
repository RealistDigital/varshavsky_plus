<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_news_mob.php'; ?>
<?php else : ?>

	<div class="body_wrapper">

		<header class="top_header">
			<a href="stolitsagroup.com" class="stolitsa_logo" target="_blank"></a>

			<a href="index.html" class="varshavsky_logo_small"></a>
			
			<div class="tel">
				<p class="tel_num">067 219 49 53</p>
			</div>
					
			<a href="javascript:void(0)" class="fb" target="_blank"><img class="fb_img" src="/public/img/fb.png" alt="Facebook"></a>
		</header>
		
		<div class="contacts_info_wr">
			<div class="contacts_info">
				<h2 class="contacts_text_title"><?=$I['name_'.LANG]?></h2>
				<div class="contacts_text">
					<?=$I['text_'.LANG]?>
					<?/*<div class="contacts_sub_info_wr">
						<h3 class="contacts_text_sub_title">Відділ продажу</h3>
						<div class="contacts_sub_info">
							по вул. Маршала Гречка<br>та просп. Правди, м. Київ<br><a href="tel:+380672195325" class="contacts_tel">+38 067 219 53 25</a><a class="contacts_mail" href="mailto:info@varshavsky.com.ua">info@varshavsky.com.ua</a>
						</div>
					</div>
					<div class="contacts_sub_info_wr">
						<h3 class="contacts_text_sub_title">Головний офіс</h3>
						<div class="contacts_sub_info">
							вул. Б. Хмельницького, 12а
							<a href="tel:+380443343126" class="contacts_tel">+38 044 334 31 26</a>
						</div>
					</div>
					<div class="contacts_sub_info_wr contacts_shedule">
						<h3 class="contacts_text_sub_title">Ми чекаємо Вас</h3>
						<div class="contacts_sub_info">
							<span class="contacts_shedule_item">Пн-Пт: 9.00 - 19.00</span> <span class="contacts_shedule_item">Сб: 10.00 - 18.00</span><br><span class="contacts_shedule_item">Нд: 10.00 - 17.00</span>
						</div>
					</div>*/?>
				</div>
			</div>
		</div>


<?require_once URL_BLOCKS.'menu.php'; ?>


	</div>	
	
	<!-- MAP -->
	<div id="map"></div>

	<script src="http://maps.googleapis.com/maps/api/js"></script>
	<script>
		//var coordinatesContact = new google.maps.LatLng(50.505235, 30.419074);
		var coordinatesContact = new google.maps.LatLng(<?=$I['map_coordinates_x']?>, <?=$I['map_coordinates_y']?>);
	    //var coordinatesCenter  = new google.maps.LatLng(50.505235, 30.419074);
	    var coordinatesCenter  = new google.maps.LatLng(<?=$I['map_coordinates_x_center']?>, <?=$I['map_coordinates_y_center']?>);

	    function initializeContact() {
	        var mapOptionsContact = {
	            center: coordinatesCenter,
	            zoom: 15,
	            disableDefaultUI: true,
				scrollwheel: true,
	            styles: [
					    // {
					    //     "featureType": "landscape",
					    //     "elementType": "labels.text",
					    //     "stylers": [
					    //         {
					    //             "visibility": "off"
					    //         }
					    //     ]
					    // },
					    
					    {
					        "featureType": "poi",
					        "elementType": "labels",
					        "stylers": [
					            {
					                "visibility": "off"
					            }
					        ]
					    },
					    {
					        "featureType": "road",
					        "elementType": "geometry.fill",
					        "stylers": [
					            {
					                "color": "#dfd4c7"
					            }
					        ]
					    },
					    {
					        "featureType": "road",
					        "elementType": "geometry.stroke",
					        "stylers": [
					            {
					                "visibility": "off"
					            },
					            {
					                "color": "#dfd4c7"
					            }
					        ]
					    },
					    {
					        "featureType": "road",
					        "elementType": "labels.text.fill",
					        "stylers": [
					            {
					                "color": "#604c37"
					            }
					        ]
					    },
					    {
					        "featureType": "road",
					        "elementType": "labels.text.stroke",
					        "stylers": [
					            {
					                "visibility": "on"
					            },
					            {
					                "color": "#ffffff"
					            }
					        ]
					    },
					    
					]
	        };

	        var pointerContact = new google.maps.Marker({
	            position: coordinatesContact,
	            //icon: '/public/files/map_marker.png',
	            icon: '/<?=$I['img']?>',
	        });

	        var mapContact = new google.maps.Map(document.getElementById("map"), mapOptionsContact);

	        pointerContact.setMap(mapContact);
	    }

	    google.maps.event.addDomListener(window, 'load', initializeContact);
	</script>

<?endif?>