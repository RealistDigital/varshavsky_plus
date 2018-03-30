<? 
    if((int)$_GET['id']): 
        $width  = 720;
        $height = 540; 
        
        require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php'); 
        require_once($_SERVER['DOCUMENT_ROOT'].'/applications/_general/general.php'); 
?>
    <? $fileVideo = _general_info(trim($_GET['id'])); ?>
    
    <? if (!Lib::checkFlahsDevice()): ?>
        <!-- Iphone, Ipad, Android -->
        <? if(Lib::checkYoutubeLink($fileVideo['files'])): ?>
            <!-- Youtube -->
            <iframe width="<?=$width?>" height="<?=$height?>" src="http://www.youtube.com/embed/0YJCpcDm67M" frameborder="0" allowfullscreen></iframe>
        <? else: ?>
            <video width="<?=$width?>" height="<?=$height?>" poster="" preload="none" controls="controls">
                <source src="<?=SITE_ADDR.'/'.$fileVideo['files']?>" type="video/mp4">
            </video>
        <? endif; ?>
    <? else: ?>
        <!-- PC -->
        <object id="player-1" type="application/x-shockwave-flash" data="<?=SITE_ADDR.URL_PLUGINS?>uppod_player/player/uppod.swf" width="<?=$width?>" height="<?=$height?>">
           <param name="bgcolor" value="#ffffff" />
           <param name="allowFullScreen" value="true" />
           <param name="allowScriptAccess" value="always" />
           <param name="wmode" value="window" />
           <param name="movie" value="<?=SITE_ADDR.URL_PLUGINS?>uppod_player/player/uppod.swf" />
           <param name="flashvars" value="file=<?=SITE_ADDR.'/'.$fileVideo['files']?>" />
        </object>
    <? endif; ?>
<? endif; ?>
