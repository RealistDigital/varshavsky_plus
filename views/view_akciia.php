<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_akciia_mob.php'; ?>
<?php else : ?>
<?
$query_presscentr = "SELECT * FROM _main as presscentr, _main as presscentr_child
		WHERE presscentr.type_tpl = 13 AND presscentr.visible_".LANG."='yes' AND presscentr_child.parent = presscentr.id AND presscentr_child.visible_".LANG."='yes' ORDER BY presscentr_child.position LIMIT 100";
$res_presscentr = DB::query($query_presscentr);
$p=0;
while($presscentr= DB::fetchAssoc($res_presscentr)){$p++;
	if (strstr($I['url'],$presscentr['url'])){
		$presscentr_html .="<div>
				<a href='javascript:void(0)' class='secod_menu_link secod_menu_active'>".$presscentr['name_'.LANG]."</a>
			</div>";
	}else{
		$presscentr_html .="<div>
				<a href='/".LANG."/".$presscentr['url']."' class='secod_menu_link'>".$presscentr['name_'.LANG]."</a>
			</div>";
	}
}

$query_news = "SELECT * 
		FROM 
			_main as news,
			_main as new
		WHERE 
			news.type_tpl = 17
			AND news.visible_".LANG."='yes' 
			AND new.parent = news.id
			AND new.visible_".LANG."='yes' 
			ORDER BY new.position 
			LIMIT 100";
			
$res_news = DB::query($query_news);
$h=0;
while($new = DB::fetchAssoc($res_news)){$h++;
	$new_date = Lib::convect_date_numbers($new['date']);	// 0 - день, 1 - месяц, 2- год
	$news_html .="<a href='/".LANG."/".$new['url']."' class='one_new_wr'>
					<div class='one_new_dot'></div>
					<div class='one_new_img_wr'>
						<div class='one_new_img' style='background-image: url(/".$new['img'].");'></div>
					</div>
					<div class='one_new_info'>
						<div class='one_new_date'>".$new_date[0]."<span>/".$new_date[1]."</span></div>
						<div class='one_new_tittle'>".$new['name_'.LANG]."</div>
						<div class='one_new_text'>".$new['short_text_'.LANG]."</div>
					</div>
				</a>";
}
?>
<div class="news_wrap small_logo">
	<!-- HEADER -->
	<? require_once (URL_BLOCKS . 'header.php');?>
	<!-- END HEADER -->
	
	<div class="secod_menu_wr">
		<div class="secod_menu">
			<?=$presscentr_html?>
			<!--<div>
				<a href="/<?=LANG?>/<?=$news_link['url']?>" class="secod_menu_link "><?=$news_link['name_'.LANG]?></a>
			</div>
			<div>
				<a href="javascript:void(0)" class="secod_menu_link secod_menu_active"><?=$I['name_'.LANG]?></a>
			</div>		-->
		</div>
	</div>
	
	<!-- CONTENT NEWS -->
	<div class="news_wr">
		<div class="news_line_wr"></div>
		<div class="news_scroll" id="news_scroll">
			<?=$news_html?>
			<!--<a href="javascript:void(0)" class="one_new_wr">
				<div class="one_new_dot"></div>
				<div class="one_new_img_wr">
					<div class="one_new_img" style="background-image: url(/public/files/news/new_test.jpg);"></div>
				</div>
				<div class="one_new_info">
					<div class="one_new_date">21<span>/11</span></div>
					<div class="one_new_tittle">Сучасний житловий комплекс на Деміївці</div>
					<div class="one_new_text">Передавать изменчивость природы путем некоторого смещения элементов вверх-вниз-влево-традиционный для...</div>
				</div>
			</a>-->
			
		</div>
	</div>
	<!-- END CONTENT NEWS -->
</div>
<script>
$(document).ready(function(){
/* ==================================
/* 	SCROLL 
=================================== */	
	$('#news_scroll').mCustomScrollbar({
        scrollInertia: 150
    });
});
</script>
<?endif?>