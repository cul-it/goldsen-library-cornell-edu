<?php

	if (isset($_GET["size"])) $size=$_GET["size"];
	else $size="small";
	if (isset($_GET["f"])) $f=$_GET["f"];
	else $f="0";
	if (isset($_GET["f"])) $current_film = $_GET["f"];
	else $current_film = 0;
	

		
	include("inc/functions.php");
	
	$file = 'wen_pulin.xml';
	if (!($fp = fopen($file, "r"))) {
	   die("could not open XML input");
	}
	$data = fread($fp, filesize($file));
	fclose($fp);
	
	$params = array();
	$params = XMLtoArray($data);
	$meta = array();
	$meta=$params["WEN_PULIN_COLLECTION"]["VIDEO"][$f-1];
	
	if ($current_film > 0) {
		$current_film_text = substr(10000 + $current_film, 1);
		
		if ($size=="small") {
?>
		
		
			<div id="flash-content">
				<div id="column1">
					<div id="video-title">
						<h5><?php echo($meta["TITLE_CN"]); ?><br /><?php echo($meta["TITLE_EN"]); ?></h5>
						<p class="info">DVD <?php echo($meta["DIRECTORY"]); ?> &raquo; Segment <?php echo($meta["SEGMENT"]); ?> &raquo; <?php echo($meta["INTERVAL"]); ?></p>
						<?php if ($meta["PARTICIPANTS"]!="") { ?> <p class="info">Performers: <?php echo($meta["PARTICIPANTS"]); ?></p><?php } ?>
						<?php if ($meta["GEOGRAPHIC_COVERAGE"]!="" && $meta["TEMPORAL_COVERAGE"]!="") { ?>
						<p class="info"><?php echo($meta["GEOGRAPHIC_COVERAGE"]); ?>, circa.<?php echo($meta["TEMPORAL_COVERAGE"]); ?></p><?php } ?>
					</div>
					<div id="controls-wrapper">
						<div id="controls-content">
						<dl>
						<dt>Related Segment(s)</dt>
						<dd><?php echo($meta["RELATED_SEGMENT"]); ?></dd>
					</dl>
						<dl>
							<dt>Notes</dt>
							<dd><?php echo($meta["NOTES"]); ?></dd>
						</dl>				
						</div>
					</div>
				</div>
					
				<div id="column2">
				
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
					width="340" height="345"
					codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
					<param name="movie" value="wp_player.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" />
					<param name="FlashVars" value="fvFilm=<?=$current_film_text?>" />
					<embed src="wp_player.swf" FlashVars="fvFilm=<?=$current_film_text?>" quality="high" bgcolor="#000000" 
					width="340" height="345" name="wp_player" align="middle"
					play="true"
					loop="false"
					quality="high"
					allowScriptAccess="sameDomain"
					type="application/x-shockwave-flash"
					pluginspage="http://www.macromedia.com/go/getflashplayer">
					</embed>
				</object>
				 
				<noscript>// Provide alternate content for browsers that do not support scripting
					// or for those that have scripting disabled.
					Alternate HTML content should be placed here. This content requires the Macromedia Flash Player.
					<A href="http://www.macromedia.com/go/getflash/">Get Flash</A>
				</noscript>				
				</div>
			</div>
			<div id="metadata">
				<div class="metadata-content">
					<!--dl>
						<dt>Related Segment</dt>
						<dd><?php echo($meta["RELATED_SEGMENT"]); ?></dd>
					</dl-->
				</div>
			</div>
		
		
		
		<?php } elseif($size=="large") { ?>
		
		
			<div id="flash-content">
		
					
				<div id="column-solo">
					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
					width="650" height="600"
					codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
					<param name="movie" value="wp_player_big.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" />
					<param name="FlashVars" value="fvFilm=<?=$current_film_text?>" />
					<embed src="wp_player_big.swf" FlashVars="fvFilm=<?=$current_film_text?>" quality="high" bgcolor="#000000" 
					width="650" height="600" name="wp_player" align="middle"
					play="true"
					loop="false"
					quality="high"
					allowScriptAccess="sameDomain"
					type="application/x-shockwave-flash"
					pluginspage="http://www.macromedia.com/go/getflashplayer">
					</embed>
					</object>
					<noscript>// Provide alternate content for browsers that do not support scripting
						// or for those that have scripting disabled.
						Alternate HTML content should be placed here. This content requires the Macromedia Flash Player.
						<A href="http://www.macromedia.com/go/getflash/">Get Flash</A>
					</noscript>				
				</div>
			</div>
			<div id="metadata">
				<div class="metadata-content">
					<!--dl>
						<dt>Related Segment</dt>
						<dd><?php echo($meta["RELATED_SEGMENT"]); ?></dd>
					</dl-->
				</div>
			</div>
		
					
<?php 
		} 
	} else {
?>
		<p>Please specify a video</p>
<?php
	}
?>