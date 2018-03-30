<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_new_mob.php'; ?>
<?php else : 

	$parent = getGeneralInfo($I['parent']);

	// ссылка на след ..
		$query = "SELECT  url
					FROM _main
				WHERE
					parent = '11'
					AND position > '".$I['position']."'
				ORDER BY position
				LIMIT 1
		";
		$res = DB::query($query);
		if (DB::numRows($res)>0){
			$fl_url = DB::fetchAssoc($res);
			$next_link = "<a href='/".LANG."/".$fl_url['url']."' class='next_article'></a>";
		}
		
	// ссылка на предыдущую ..
		$query = "SELECT  url
					FROM _main
				WHERE
					parent = '11'
					AND position < '".$I['position']."'
					
				ORDER BY position DESC
				LIMIT 1
		";
		$res = DB::query($query);
		if (DB::numRows($res)>0){
			$fl_url = DB::fetchAssoc($res);
			$prev_link = "<a href='/".LANG."/".$fl_url['url']."' class='prev_article'></a>";
		}


?>

	<div class="body_wrapper bg_texture">

		<a href="/<?=LANG?>/<?=$parent['url']?>" class="close_article"></a>
   		<?if($prev_link){ echo $prev_link; }?>
   		<?if($next_link){ echo $next_link; }?>

		<article class="article_wrap">
			<h1 class="article_title"><?=$I['name_'.LANG]?></h1>
			<div class="article_text_container">
			
				<div class="article_text"><?=$I['text_'.LANG]?></div>

			<? if($I['img']){ ?><img src="/<?=$I['img']?>" alt="image" title="image" class="article_img"><? } ?>

			<? if($I['link']){ ?><a href="<?=$I['link']?>" class="article_btn">Переглянути фотозвіт</a><? } ?>
			
		</div>
		</article>
		
	</div>	

	<script>
	    (function($){
	        $(window).on("load",function(){
	            $(".article_text_container").mCustomScrollbar({
	            	scrollInertia: 450
	            });
	        });
	    })(jQuery);
	</script>

<?endif?>