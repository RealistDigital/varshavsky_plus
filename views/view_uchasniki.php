<?php if ($deviceTouch) : ?>
<!--если мобильная версия-->
	<?require_once URL_VIEWS.'view_uchasniki_mob.php'; ?>
<?php else : ?> 

<?
/* UCHASNIKI */   
$query_uch= "SELECT 
			 uchsnik.name_".LANG.",
			 uchsnik.text_".LANG."
			 
			FROM 
				_main as uchsniki,
				_main as uchsnik
			WHERE
				uchsniki.type_tpl = 5
				AND uchsniki.visible_".LANG."='yes'
				AND uchsnik.parent = uchsniki.id
				AND uchsnik.visible_".LANG."='yes'
		";
$uch_rec = DB::query($query_uch);
while($uchasnik = DB::fetchAssoc($uch_rec)){	
	$uchasnik_html .="<div class='dev_info'>
						<div class='dev_name'>".$uchasnik['name_'.LANG]."</div>
						<div class='dev_text'>".$uchasnik['text_'.LANG]."</div>
					</div>";
}
?>
<div class="dev_wrap small_logo">
	<!-- HEADER -->
	<? require_once (URL_BLOCKS . 'header.php');?>
	<!-- END HEADER -->
	
	<div class="dev_wr">
		<div class="dev_content_wr">
			<div class="dev_tittle">Учасники проекту</div>
			<div class="dev_scroll" id="dev_scroll">
				<div class="dev_text_wr">
					<?=$uchasnik_html?>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function ($) {

});
</script>
<?endif?>