<?php

/*
	wp_demo.php - display flash video and list of available videos
	wp_demo.php?f=110
	f - film number (1-33) optional
*/


include("inc/functions.php");

$file = 'wen_pulin.xml';
if (!($fp = fopen($file, "r"))) {
   die("could not open XML input");
}
$data = fread($fp, filesize($file));
fclose($fp);

$params = array();
$params = XMLtoArray($data);
//print($params["WEN_PULIN"]["VIDEO"]["ID"]);
$meta = array();
$meta=$params["WEN_PULIN_COLLECTION"]["VIDEO"][$_GET['f']-1];
//foreach($params["WEN_PULIN_COLLECTION"]["VIDEO"][$_GET['f']-1] as $key => $val) {
	//print("$key = $val\n");
//}
//foreach($meta as $key => $val) {
	//print("$key = $val\n");
//}


if (isset($_GET["f"])) $current_film = $_GET["f"];
else $current_film = 0;

/* film array from database */
$film = array();
//require("film_names.txt");

?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title><?php echo($meta["TITLE_EN"]); ?> (Video <?php echo($current_film); ?>) :: Wen Pulin Archive of Chinese Avant-garde Art :: Charles W. Wason Collection :: Cornell University Library</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en-us" />
	<meta name="robots" content="all" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" media="screen" href="styles/screen.css" />
	
	<?php
		if ($current_film > 0) {
		// output embed statement for video
		//skip leading zeros -jgr 1/17/12 $current_film_text = substr(10000 + $current_film, 1);	// leading zeros
		$current_film_text = $current_film;
	?>	
	<script language="JavaScript" type="text/javascript">
		<!--
		// -----------------------------------------------------------------------------
		// Globals
		// Major version of Flash required
		var requiredMajorVersion = 8;
		// Minor version of Flash required
		var requiredMinorVersion = 0;
		// Revision of Flash required
		var requiredRevision = 0;
		// the version of javascript supported
		var jsVersion = 1.0;
		// -----------------------------------------------------------------------------
		// -->
		</script>
		<script language="VBScript" type="text/vbscript">
		<!-- // Visual basic helper required to detect Flash Player ActiveX control version information
		Function VBGetSwfVer(i)
		  on error resume next
		  Dim swControl, swVersion
		  swVersion = 0
		  
		  set swControl = CreateObject("ShockwaveFlash.ShockwaveFlash." + CStr(i))
		  if (IsObject(swControl)) then
			swVersion = swControl.GetVariable("$version")
		  end if
		  VBGetSwfVer = swVersion
		End Function
		// -->
		</script>
		<script language="JavaScript1.1" type="text/javascript">
		<!-- // Detect Client Browser type
		var isIE  = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
		var isWin = (navigator.appVersion.toLowerCase().indexOf("win") != -1) ? true : false;
		var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;
		jsVersion = 1.1;
		// JavaScript helper required to detect Flash Player PlugIn version information
		function JSGetSwfVer(i){
			// NS/Opera version >= 3 check for Flash plugin in plugin array
			if (navigator.plugins != null && navigator.plugins.length > 0) {
				if (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]) {
					var swVer2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
					var flashDescription = navigator.plugins["Shockwave Flash" + swVer2].description;
					descArray = flashDescription.split(" ");
					tempArrayMajor = descArray[2].split(".");
					versionMajor = tempArrayMajor[0];
					versionMinor = tempArrayMajor[1];
					if ( descArray[3] != "" ) {
						tempArrayMinor = descArray[3].split("r");
					} else {
						tempArrayMinor = descArray[4].split("r");
					}
					versionRevision = tempArrayMinor[1] > 0 ? tempArrayMinor[1] : 0;
					flashVer = versionMajor + "." + versionMinor + "." + versionRevision;
				} else {
					flashVer = -1;
				}
			}
			// MSN/WebTV 2.6 supports Flash 4
			else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.6") != -1) flashVer = 4;
			// WebTV 2.5 supports Flash 3
			else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.5") != -1) flashVer = 3;
			// older WebTV supports Flash 2
			else if (navigator.userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 2;
			// Can't detect in all other cases
			else {
				
				flashVer = -1;
			}
			return flashVer;
		} 
		// If called with no parameters this function returns a floating point value 
		// which should be the version of the Flash Player or 0.0 
		// ex: Flash Player 7r14 returns 7.14
		// If called with reqMajorVer, reqMinorVer, reqRevision returns true if that version or greater is available
		function DetectFlashVer(reqMajorVer, reqMinorVer, reqRevision) 
		{
			reqVer = parseFloat(reqMajorVer + "." + reqRevision);
			// loop backwards through the versions until we find the newest version	
			for (i=25;i>0;i--) {	
				if (isIE && isWin && !isOpera) {
					versionStr = VBGetSwfVer(i);
				} else {
					versionStr = JSGetSwfVer(i);		
				}
				if (versionStr == -1 ) { 
					return false;
				} else if (versionStr != 0) {
					if(isIE && isWin && !isOpera) {
						tempArray         = versionStr.split(" ");
						tempString        = tempArray[1];
						versionArray      = tempString .split(",");				
					} else {
						versionArray      = versionStr.split(".");
					}
					versionMajor      = versionArray[0];
					versionMinor      = versionArray[1];
					versionRevision   = versionArray[2];
					
					versionString     = versionMajor + "." + versionRevision;   // 7.0r24 == 7.24
					versionNum        = parseFloat(versionString);
					// is the major.revision >= requested major.revision AND the minor version >= requested minor
					if ( (versionMajor > reqMajorVer) && (versionNum >= reqVer) ) {
						return true;
					} else {
						return ((versionNum >= reqVer && versionMinor >= reqMinorVer) ? true : false );	
					}
				}
			}	
			return (reqVer ? false : 0.0);
		}
		// -->
		</script>
<?php
}
?>
	
</head>

<body>

<div id="cu-identity">
	<?php include('inc/cuidentity.php'); ?>
</div>

<hr />

<div id="header">
	<div id="identity">
	    <?php include('inc/banner.php'); ?>		
	</div>	
</div>

<hr />


<div id="wrap">

<div id="content">

	<div id="main">

		<div id="navigation">
			<?php include('inc/navigation.php'); ?>	
		</div>

		
		<div id="main-content">
	
			<div id="main-text-650">
				<div id="breadcrumbs">
					<a href="/Wen/index.php" title="Home"> Chinese Avant-garde Art</a> &gt; 
					<a href="/Wen/archive.php" title="Videos"> Videos</a> &gt; 
					<?php echo($meta["TITLE_EN"]); ?>
				</div>
				
			<div id="video">
				<div id="video-tabs">
					<ul>
						<li><a href="video.php?f=<?php echo($current_film); ?>" title="Video">Video Main</a></li>
						<li><a href="video_large.php?f=<?php echo($current_film); ?>" class="tab-on" title="Expanded Video">Expanded Video</a></li>
					</ul>
				</div>
				
				<div id="video-content" class="large">
					<div id="flash-content">

							
						<div id="column-solo">
						<script language="JavaScript" type="text/javascript">
						<!-- 
						var hasRightVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);
						if(hasRightVersion) {  // if we've detected an acceptable version
							var oeTags = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'
							+ 'width="650" height="600"'
							+ 'codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">'
							+ '<param name="movie" value="wp_player_big.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" />'
							+ '<param name="FlashVars" value="fvFilm=<?php echo $current_film_text; ?>" />'
							+ '<embed src="wp_player_big.swf" FlashVars="fvFilm=<?php echo $current_film_text; ?>" quality="high" bgcolor="#000000" '
							+ 'width="650" height="600" name="wp_player" align="middle"'
							+ 'play="true"'
							+ 'loop="false"'
							+ 'quality="high"'
							+ 'allowScriptAccess="sameDomain"'
							+ 'type="application/x-shockwave-flash"'
							+ 'pluginspage="http://www.macromedia.com/go/getflashplayer">'
							+ '<\/embed>'
							+ '<\/object>';
							document.write(oeTags);   // embed the flash movie
						  } else {  // flash is too old or we can't detect the plugin
							var alternateContent = 'Alternate HTML content should be placed here.'
							+ 'This content requires the Macromedia Flash Player.'
							+ '<a href=http://www.macromedia.com/go/getflash/>Get Flash</a>';
							document.write(alternateContent);  // insert non-flash content
						  }
						// -->
						</script>
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

				

			</div>
			
			
			
		</div>

	
		
	</div>
</div>
</div>

<hr />

<div id="footer">
	<?php include('inc/footer.php'); ?>
</div>

</body>
</html>