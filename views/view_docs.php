<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_docs_mob.php'; ?>
<?php else : 

	$query = "SELECT * FROm _main WHERE parent='139' AND visible_".LANG."='yes' ORDER BY position LIMIT 100";
	$res = DB::query($query);
	while($d = DB::fetchAssoc($res)){
		$d_html .= "<div class='swiper-slide doc_slide'>
						<a class='doc_slide_container' href='/".$d['files']."' target='_blank'>
							<h3 class='documents_slide_title'>".$d['name_'.LANG]."</h3>
							<img class='doc_slide_img' src='/".$d['img']."' alt='".$d['name_'.LANG]."'>
						</a>
					</div>";
	}
		
?> 

	<div class="body_wrapper bg_doc_texture">
		
		<div class="bg_documents"></div>

		<header class="top_header">
			<a href="stolitsagroup.com" class="stolitsa_logo" target="_blank"></a>

			<a href="index.html" class="varshavsky_logo_small"></a>
			
			<div class="tel">
				<p class="tel_num">067 619 49 53</p>
			</div>
					
			<a href="javascript:void(0)" class="fb" target="_blank"><img class="fb_img" src="/public/img/fb.png" alt="Facebook"></a>
		</header>

		<div class="title_line"></div>
		<div class="page_name">
			<h1 class="page_name_h1">Документація</h1>
		</div>
		
		<section class="documents_container">
			<div class="swiper-container-documents">
				<div class="swiper-wrapper">
					<?=$d_html?>
					<?/*<div class="swiper-slide doc_slide">
						<a class="doc_slide_container" href="javascript:void(0)" target="_blank">
							<h3 class="documents_slide_title">Ліцензія</h3>
							<img class="doc_slide_img" src="/public/img/licence.png" alt="Ліцензія">
						</a>
					</div>
					<div class="swiper-slide doc_slide">
						<a class="doc_slide_container" href="javascript:void(0)" target="_blank">
							<h3 class="documents_slide_title">Дозвіл на будівництво</h3>
							<img class="doc_slide_img" src="/public/img/permit.png" alt="Ліцензія">
						</a>
					</div>
					<div class="swiper-slide doc_slide">
						<a class="doc_slide_container" href="javascript:void(0)" target="_blank">
							<h3 class="documents_slide_title">Ліцензія</h3>
							<img class="doc_slide_img" src="/public/img/licence.png" alt="Ліцензія">
						</a>
					</div>
					<div class="swiper-slide doc_slide">
						<a class="doc_slide_container" href="javascript:void(0)" target="_blank">
							<h3 class="documents_slide_title">Дозвіл на будівництво</h3>
							<img class="doc_slide_img" src="/public/img/permit.png" alt="Ліцензія">
						</a>
					</div>
					<div class="swiper-slide doc_slide">
						<a class="doc_slide_container" href="javascript:void(0)" target="_blank">
							<h3 class="documents_slide_title">Ліцензія</h3>
							<img class="doc_slide_img" src="/public/img/licence.png" alt="Ліцензія">
						</a>
					</div>*/?>
				</div>
				<div class="swiper-button-prev doc_prev_sl"></div>
   				<div class="swiper-button-next doc_next_sl"></div>
			</div>
		</section>


<?require_once URL_BLOCKS.'menu.php'; ?>

		
		<script>
			// SLIDER
			var documentsSwiper = new Swiper ('.swiper-container-documents', {
				slidesPerView: 2,
				spaceBetween: 175,
				navigation: {
					prevEl: '.doc_prev_sl',
					nextEl: '.doc_next_sl'
				},
				breakpoints: {
					1440: {
						spaceBetween: 100
					}
				}
			});
		</script>
	</div>	

<?endif?>