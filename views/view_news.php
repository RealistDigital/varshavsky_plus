<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_news_mob.php'; ?>
<?php else : 


$month_arr = array(
	'01' => "Cічня",
	'02' => "Лютого",
	'03' => "Березня",
	'04' => "Квытня",
	'05' => "Травня",
	'06' => "Червня",
	'07' => "Липня",
	'08' => "Серпня",
	'09' => "Вересня",
	'10' => "Жовтня",
	'11' => "Листопада",
	'12' => "Грудня",
);


	$query = "SELECT * FROM _main WHERE parent='11' AND visible_".LANG."='yes' ORDER BY position LIMIT 100";
	$res = DB::query($query);
	while($n = DB::fetchAssoc($res)){
		list($d,$m,$y) = explode('.',$n['date']);
		$n_html .= "<div class='swiper-slide'>
						<div class='news_item_container'>
							<h3 class='news_date'>".$d." ".$month_arr[$m]." ".$y."</h3>
							<h2 class='news_title'>".$n['name_'.LANG]."</h2>
							".$n['short_text_'.LANG]."
							<a href='/".LANG."/".$n['url']."' class='news_btn'>Читати</a>
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
			<h1 class="page_name_h1">Прес-центр</h1>
			<h2 class="page_name_h2">Новини</h2>
		</div>
		
		<section class="news_container">
			<div class="swiper-container_news">
				<div class="swiper-wrapper">
					<?=$n_html?>
					<?/*<div class="swiper-slide">
						<div class="news_item_container">
							<h3 class="news_date">14 лютого 2018</h3>
							<h2 class="news_title">Старт продажу комор ІІ черги</h2>
							За деталями звертайтесь у відділ продажів
							<a href="javascript:void(0)" class="news_btn">Читати</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="news_item_container">
							<h3 class="news_date">14 лютого 2018</h3>
							<h2 class="news_title">Старт продажу комор ІІ черги</h2>
							За деталями звертайтесь у відділ продажів
							<a href="javascript:void(0)" class="news_btn">Читати</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="news_item_container">
							<h3 class="news_date">14 лютого 2018</h3>
							<h2 class="news_title">Старт продажу комор ІІ черги</h2>
							За деталями звертайтесь у відділ продажів
							<a href="javascript:void(0)" class="news_btn">Читати</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="news_item_container">
							<h3 class="news_date">14 лютого 2018</h3>
							<h2 class="news_title">Старт продажу комор ІІ черги</h2>
							За деталями звертайтесь у відділ продажів
							<a href="javascript:void(0)" class="news_btn">Читати</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="news_item_container">
							<h3 class="news_date">14 лютого 2018</h3>
							<h2 class="news_title">Старт продажу комор ІІ черги</h2>
							За деталями звертайтесь у відділ продажів
							<a href="javascript:void(0)" class="news_btn">Читати</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="news_item_container">
							<h3 class="news_date">14 лютого 2018</h3>
							<h2 class="news_title">Старт продажу комор ІІ черги</h2>
							За деталями звертайтесь у відділ продажів
							<a href="javascript:void(0)" class="news_btn">Читати</a>
						</div>
					</div>
					<div class="swiper-slide">
						<div class="news_item_container">
							<h3 class="news_date">14 лютого 2018</h3>
							<h2 class="news_title">Старт продажу комор ІІ черги</h2>
							За деталями звертайтесь у відділ продажів
							<a href="javascript:void(0)" class="news_btn">Читати</a>
						</div>
					</div>*/?>
				</div>	
				<div class="swiper-button-prev news_prev_sl"></div>
					<div class="swiper-button-next news_next_sl"></div>
					<div class="swiper-pagination news_pagination"></div>
			</div>
		</section>


<?require_once URL_BLOCKS.'menu.php'; ?>

		
		<script>
			// SLIDER
			var documentsSwiper = new Swiper ('.swiper-container_news', {
				slidesPerView: 3,
				spaceBetween: 75,
				navigation: {
					prevEl: '.news_prev_sl',
					nextEl: '.news_next_sl'
				},
				pagination: {
					el: '.swiper-pagination',
					type: 'bullets',
					clickable: true,
					renderBullet: function (index, className) {
					    return '<span class="' + className + '">' + (index + 1) + '</span>';
					}
				},
				breakpoints: {
					1500: {
						spaceBetween: 15
					}
				}
			});
		</script>
	</div>	

<?endif?>