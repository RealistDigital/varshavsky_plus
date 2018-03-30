<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_hid_bud_mob.php'; ?>
<?php else : 

	$query = "SELECT * FROM _main WHERE parent='8' AND visible_".LANG."='yes' ORDER BY position LIMIT 100";
	$res = DB::query($query);
	while($h = DB::fetchAssoc($res)){
		
		$query = "SELECT img FROM _main WHERE parent='".$h['id']."' AND visible_".LANG."='yes' ORDER BY position LIMIT 1";
		$f = DB::fetchAssoc(DB::query($query));
	
		$h_html .= "<div class='swiper-slide' data-id='".$h['id']."'>
						<div class='gallery_item_container'>
							<div class='gallery_img_outer_wr'>
								<div class='gallery_img_wr'>
									<div class='gallery_img' style='background-image: url(/".$f['img'].");'></div>
								</div>
							</div>
							<div class='gallery_date'>
								<h2 class='gallery_month'>".$h['name_'.LANG]."</h2>
								<h2 class='gallery_year'>".$h['name_2_'.LANG]."</h2>
							</div>
						</div>
					</div>";
	
	
	}


?>


	<div class="body_wrapper bg_texture">

		<header class="top_header">
			<a href="stolitsagroup.com" class="stolitsa_logo" target="_blank"></a>

			<a href="index.html" class="varshavsky_logo_small"></a>
			
			<div class="tel">
				<p class="tel_num">067 219 49 53</p>
			</div>
					
			<a href="javascript:void(0)" class="fb" target="_blank"><img class="fb_img" src="/public/img/fb.png" alt="Facebook"></a>
		</header>

		<div class="title_line"></div>
		<div class="page_name">
			<h1 class="page_name_h1">Галерея</h1>
			<h2 class="page_name_h2"><?=$I['name_'.LANG]?></h2>
		</div>
		
		<section class="gallery_container">
			<div class="swiper_gallery">
				<div class="swiper-wrapper">
					<?=$h_html?>
					<?/*<div class="swiper-slide">
						<div class="gallery_item_container">
							<div class="gallery_img_outer_wr">
								<div class="gallery_img_wr">
									<div class="gallery_img" style='background-image: url(/public/img/gallery_img.jpg);'></div>
								</div>
							</div>
							<div class="gallery_date">
								<h2 class="gallery_month">Червень</h2>
								<h2 class="gallery_year">2018</h2>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="gallery_item_container">
							<div class="gallery_img_outer_wr">
								<div class="gallery_img_wr">
									<div class="gallery_img"></div>
								</div>
							</div>
							<div class="gallery_date">
								<h2 class="gallery_month">Червень</h2>
								<h2 class="gallery_year">2017</h2>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="gallery_item_container">
							<div class="gallery_img_outer_wr">
								<div class="gallery_img_wr">
									<div class="gallery_img"></div>
								</div>
							</div>
							<div class="gallery_date">
								<h2 class="gallery_month">Червень</h2>
								<h2 class="gallery_year">2016</h2>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="gallery_item_container">
							<div class="gallery_img_outer_wr">
								<div class="gallery_img_wr">
									<div class="gallery_img"></div>
								</div>
							</div>
							<div class="gallery_date">
								<h2 class="gallery_month">Лютий</h2>
								<h2 class="gallery_year">2015</h2>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="gallery_item_container">
							<div class="gallery_img_outer_wr">
								<div class="gallery_img_wr">
									<div class="gallery_img"></div>
								</div>
							</div>
							<div class="gallery_date">
								<h2 class="gallery_month">Лютий</h2>
								<h2 class="gallery_year">2014</h2>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="gallery_item_container">
							<div class="gallery_img_outer_wr">
								<div class="gallery_img_wr">
									<div class="gallery_img"></div>
								</div>
							</div>
							<div class="gallery_date">
								<h2 class="gallery_month">Лютий</h2>
								<h2 class="gallery_year">2013</h2>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="gallery_item_container">
							<div class="gallery_img_outer_wr">
								<div class="gallery_img_wr">
									<div class="gallery_img"></div>
								</div>
							</div>
							<div class="gallery_date">
								<h2 class="gallery_month">Лютий</h2>
								<h2 class="gallery_year">2012</h2>
							</div>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="gallery_item_container">
							<div class="gallery_img_outer_wr">
								<div class="gallery_img_wr">
									<div class="gallery_img"></div>
								</div>
							</div>
							<div class="gallery_date">
								<h2 class="gallery_month">Лютий</h2>
								<h2 class="gallery_year">2011</h2>
							</div>
						</div>
					</div>*/?>
				</div>
				<div class="swiper-button-prev gallery_prev_sl"></div>
   				<div class="swiper-button-next gallery_next_sl"></div>
			</div>
			<!-- POP-UP -->
			<div class="pop-up_gallery">
				<div class="close_pop-up_gallery"></div>
				<div class="swiper_gallery_pop-up">
					<div class="swiper-wrapper" id='gallery_images'>
						<?/*<div class="swiper-slide">
							<img src="/public/files/gallery/318A9138.jpg" alt="Picture" title="" class="gallery_pop-up_img">
						</div>
						<div class="swiper-slide">
							<img src="/public/files/gallery/318A9149.jpg" alt="Picture" title="" class="gallery_pop-up_img">
						</div>
						<div class="swiper-slide">
							<img src="/public/files/gallery/318A9152.jpg" alt="Picture" title="" class="gallery_pop-up_img">
						</div>*/?>
					</div>
					<div class="swiper-button-prev pop-up_gallery_prev_sl"></div>
   					<div class="swiper-button-next pop-up_gallery_next_sl"></div>
				</div>
			</div>

		</section>


<?require_once URL_BLOCKS.'menu.php'; ?>

	</div>

	<script>
		$(document).ready(function(){
			// MAIN SLIDER
			var galleryBuildingSwiper = new Swiper ('.swiper_gallery', {
				slidesPerView: 3,
				slidesPerGroup: 3,
				spaceBetween: 95,
				navigation: {
					prevEl: '.gallery_prev_sl',
					nextEl: '.gallery_next_sl'
				},
				breakpoints: {
					1560: {
						spaceBetween: 25
					}
				}
			});

			// POP-UP SLIDER
			function swiper_gallery_pop_init(){
				var galleryBuildingPopupSwiper = new Swiper ('.swiper_gallery_pop-up', {
					navigation: {
						prevEl: '.pop-up_gallery_prev_sl',
						nextEl: '.pop-up_gallery_next_sl'
					}
				});
			}

			// SHOW/HIDE POP-UP
			$('.swiper_gallery .swiper-slide').click(function(){
				var id = $(this).data('id');
				$.getJSON(
			        '/applications/_ajax/hid_bud.php',
			        {
			            id : id
			        }, function (d) {
			            if(d.result == 1) {
			                $('#gallery_images').html(d.html);
			                swiper_gallery_pop_init();
			            } else {
							alert('Ошибка');
						}
			        }
			    );	    
				$('.pop-up_gallery').css({'visibility': 'visible', 'opacity': '1'});
			});
			$('.close_pop-up_gallery').click(function(){
				$('.pop-up_gallery').css({'visibility': 'hidden', 'opacity': '0'});
			});
		})
	</script>

<?endif?>