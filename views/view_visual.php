<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_visual_mob.php'; ?>
<?php else : 

	$query = "SELECT * FROm _main WHERE parent='134' AND visible_".LANG."='yes' ORDER BY position LIMIT 100";
	$res = DB::query($query);
	
	$v_html .= "<div class='swiper-slide visual_slide'>";
	$i=0;
	while($v = DB::fetchAssoc($res)){$i++;
		
		if($i>5){
			$v_html .= "</div><div class='swiper-slide visual_slide'>";
			$i=1;
		}
		
		$v_html .= "	<div class='visual_outer_wr'>
							<div class='gallery_visual_img' style='background-image: url(/".$v['img'].");'></div>
						</div>";
		
		$pop_html .= "<div class='swiper-slide swiper_pop-up_slide'>
							<img src='/".$v['img']."' alt='".$v['name_'.LANG]."' class='gallery_pop-up_img'>
						</div>";
					
	}
	
	$v_html .= "</div>";

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
			<div class="swiper_gallery_visual">
				<div class="swiper-wrapper">
					<?=$v_html?>
					<?/*<div class="swiper-slide visual_slide">
						<div class="visual_outer_wr">
							<div class="gallery_visual_img" style='background-image: url(/public/img/gallery_img.jpg);'></div>
						</div>
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
						</div>
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
						</div>
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
						</div>
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
						</div>
					</div>
					<div class="swiper-slide visual_slide">
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
						</div>
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
						</div>
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
						</div>
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
						</div>
						<div class="visual_outer_wr">
							<div class="gallery_visual_img"></div>
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
					<div class="swiper-wrapper">
						<?=$pop_html?>
						<?/*<div class="swiper-slide swiper_pop-up_slide">
							<img src="/public/files/gallery/318A9138.jpg" alt="Picture" class="gallery_pop-up_img">
						</div>
						<div class="swiper-slide swiper_pop-up_slide">
							<img src="/public/files/gallery/318A9149.jpg" alt="Picture" class="gallery_pop-up_img">
						</div>
						<div class="swiper-slide swiper_pop-up_slide">
							<img src="/public/files/gallery/318A9152.jpg" alt="Picture" class="gallery_pop-up_img">
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
			var galleryVisualSwiper = new Swiper ('.swiper_gallery_visual', {
				slidesPerView: 1,
				navigation: {
					prevEl: '.gallery_prev_sl',
					nextEl: '.gallery_next_sl'
				}
			});

			// POP-UP SLIDER
			var galleryBuildingPopupSwiper = new Swiper ('.swiper_gallery_pop-up', {
				navigation: {
					prevEl: '.pop-up_gallery_prev_sl',
					nextEl: '.pop-up_gallery_next_sl'
				}
			});

			// SHOW/HIDE POP-UP
			$('.gallery_visual_img').click(function(){
				$('.pop-up_gallery').css({'visibility': 'visible', 'opacity': '1'});
			});
			$('.close_pop-up_gallery').click(function(){
				$('.pop-up_gallery').css({'visibility': 'hidden', 'opacity': '0'});
			});
		})
	</script>
<?endif?>