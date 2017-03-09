<?php include('current_directory.php') ?>
<div id="navigation"> 
  	<ul>
    	<li><a href="/index.php" title="home" id="nav-home">home</a></li>
        <li><a href="/about/index.php" title="about" id="nav-about">about</a>
        	<?php if ($current_directory == 'about') { ?>

        	<div id="subnav-wrapper-about">
            	<div id="sub-navigation">
                    <ul id="subnav-about">
                        <li><a href="/about/news.php" title="news" id="subnav-news">news</a></li>
                        <li><a href="/about/use.php" title="use &amp; access" id="subnav-use">use &amp; access</a></li>
                        <li><a href="/about/staff.php" title="staff" id="subnav-staff">staff</a></li>
                        <li><a href="/about/advisory.php" title="international advisory board" id="subnav-advisory">international advisory board</a></li>
                        <li><a href="/about/contact.php" title="contact" id="subnav-contact">contact</a></li>
                    </ul>
                </div>
            </div>     
            <?php } ?>       
        </li>
        <li><a href="/general/index.php" title="general collection" id="nav-gcollection">general collection</a>
       		<?php if ($current_directory == 'general') { ?>

        	<div id="subnav-wrapper-gcollection">
            	<div id="sub-navigation">
                    <ul id="subnav-gcollection">
                         <li><a href="/general/audio.php" title="by content">by content</a>
                        	<ul id="subnav-content">
                            	<li><a href="/general/audio.php" title="audio/sound art" id="subnav-audio">audio/sound art</a></li>
                                <li><a href="/general/bio.php" title="bio/eco art" id="subnav-bio">bio/eco art</a></li>
                                <li><a href="/general/exhibitions.php" title="exhibitions &amp; artist compilations" id="subnav-exhibitions">exhibitions &amp; artist compilations</a></li>
                                <li><a href="/general/installation.php" title="installation" id="subnav-installation">installation</a></li>
                                <li><a href="/general/interactive.php" title="interactive narrative/poetry" id="subnav-interactive">interactive narrative/poetry</a></li>
                                <li><a href="/general/online.php" title="online listservs, internet art, journals" id="subnav-online">online listservs, internet art, journals</a></li>
                                <li><a href="/general/performance.php" title="performance" id="subnav-performance">performance</a></li>
                                <li><a href="/general/theory.php" title="theory &amp; criticism" id="subnav-theory">theory &amp; criticism</a></li>
                                <li><a href="/general/video.php" title="video/cinema" id="subnav-video">video/cinema</a></li>
                            </ul>
                        </li>
                        <li><a href="/general/books.php" title="by media">by media</a>
                        	<ul id="subnav-media">
                            	<li><a href="/general/books.php" title="artist books and drawings" id="subnav-books">artist books and drawings</a></li>
                                <li><a href="/general/cd.php" title="CD-DVD" id="subnav-cd">CD-DVD</a></li>
                                <li><a href="/general/manuscripts.php" title="manuscripts" id="subnav-manuscripts">manuscripts</a></li>
                                <li><a href="/general/monographs.php" title="monographs" id="subnav-monographs">monographs</a></li>
                                <li><a href="/general/vhs.php" title="VHS/digital video tape" id="subnav-vhs">VHS/digital video tape</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <?php } ?>                   
        </li>
        <li><a href="/special/index.php" title="special collections" id="nav-scollection">special collections</a>
       		<?php if ($current_directory == 'special') { ?>

        	<div id="subnav-wrapper-scollection">
            	<div id="sub-navigation">
                    <ul id="subnav-scollection">
                        <li><a href="/special/renew.php" title="Renew Media/Rockefeller Foundation Fellowships in New Media Art" id="subnav-renew">Renew Media/Rockefeller Foundation Fellowships in New Media Art</a></li>
                        <li><a href="/special/wen.php" title="wen pulin archive of chinese avant-garde art" id="subnav-wen">wen pulin archive of chinese avant-garde art</a></li>
                        <li><a href="/special/yao.php" title="Yao Jui-Chung Archive of Contemporary Taiwanese Art" id="subnav-yao">Yao Jui-Chung Archive of Contemporary Taiwanese Art</a></li>
						<br />
                        <li><a href="/special/zalis.php" title="Elayne Zalis Video Studies Archive" id="subnav-zalis">Elayne Zalis Video Studies Archive</a></li>
                        <li><a href="/special/etc.php" title="ETC: Experimental Television Archives" id="subnav-etc">ETC: Experimental Television Archives</a></li>
                        <li><a href="/special/lynn.php" title="lynn hershman leeson archive" id="subnav-lynn">lynn hershman leeson archive</a></li>
                    </ul>
                </div>
            </div>
            <?php } ?>       
        </li>
        <li><a href="/internet/index.php" title="internet art" id="nav-internet">internet art</a>
       		<?php if ($current_directory == 'internet') { ?>

        	<div id="subnav-wrapper-internet">
            	<div id="sub-navigation">
                    <ul id="subnav-internet">
                        <li><a href="/internet/ctheory.php" title="CTHEORY multimedia" id="subnav-ctheory">CTHEORY multimedia</a></li>
                        <li><a href="/internet/computer.php" title="computerfinearts.com" id="subnav-computer">computerfinearts.com</a></li>
                        <li><a href="/internet/infos.php" title="INFOS 2000" id="subnav-infos">INFOS 2000</a></li>
                        <li><a href="/internet/turbulence.php" title="turbulence" id="subnav-turbulence">turbulence</a></li>
                        <li><a href="/internet/lowfi.php" title="low-fi.org" id="subnav-lowfi">low-fi.org</a></li>
                        <li><a href="/internet/ecopoetics.php" title="low-fi.org" id="subnav-ecopoetics">ecopoetics</a></li>
                    </ul>
                </div>
            </div>
            <?php } ?>       
        </li>
        <li><a href="/video/index.php" title="video art" id="nav-video">video art</a>
		<li><a href="/listservs/index.php" title="listservs" id="nav-listservs">listservs</a></li>
        <li><a href="/seminars/index.php" title="virtual seminars" id="nav-seminars">virtual seminars</a></li>
        <li><a href="/resources/index.php" title="resources" id="nav-resources">resources</a>
       		<?php if ($current_directory == 'resources') { ?>

        	<div id="subnav-wrapper-resources">
            	<div id="sub-navigation">
                    <ul id="subnav-resources">
                        <li><a href="/resources/index.php#asia" title="Asia Art Archive" id="subnav-asia">Asia Art Archive</a></li>
                        <li><a href="/resources/index.php#citu" title="CiTu, Federation of French University Labs in Art Creation and Emerging Media" id="subnav-citu">CiTu</a></li>
                        <li><a href="/resources/index.php#contactzones" title="Contact Zones: The Art of CD-Rom" id="subnav-contactzones">Contact Zones: The Art of CD-Rom</a></li>
                        <li><a href="/resources/index.php#ctheory" title="CTHEORY" id="subnav-ctheory-r">CTHEORY</a></li>
                        <li><a href="/resources/index.php#virtual" title="Database of Virtual Art" id="subnav-virtual">Database of Virtual Art</a></li>
                        <li><a href="/resources/index.php#tv" title="Experimental Television Center" id="subnav-tv">Experimental Television Center</a></li>
                        <li><a href="/resources/index.php#fact" title="FACT Online" id="subnav-fact">FACT Online</a></li>
                        <li><a href="/resources/index.php#icc" title="ICC Online Archive Zone" id="subnav-icc">ICC Online Archive Zone</a></li>
                        <li><a href="/resources/index.php#langlois" title="Langlois Foundation" id="subnav-langlois">Langlois Foundation</a></li>
                        <li><a href="/resources/index.php#media" title="Media Art Net" id="subnav-media">Media Art Net</a></li>
                        <li><a href="/resources/index.php#museum" title="Museum of the Essential and Beyond That" id="subnav-museum">Museum of the Essential and Beyond That</a></li>
                        <li><a href="/resources/index.php#newmedia" title="Newmedia FIX" id="subnav-newmedia">Newmedia FIX</a></li>
                        <li><a href="/resources/index.php#noema" title="NOEMA, Tecnologie e Societ&#224;" id="subnav-noema">NOEMA, Tecnologie e Societ&#224;</a></li>
                        <li><a href="/resources/index.php#palazzo" title="Palazzo delle Arti Napoli" id="subnav-palazzo">Palazzo delle Arti Napoli</a></li>
                        <li><a href="/resources/index.php#rhizome" title="Rhizome" id="subnav-rhizome">Rhizome</a></li>
                        <li><a href="/resources/index.php#v2" title="V2_Archive" id="subnav-v2">V2_Archive</a></li>
                        <li><a href="/resources/index.php#vectors" title="Vectors" id="subnav-vectors">Vectors</a></li>
                        <li><a href="/resources/index.php#zkm" title="ZKM" id="subnav-zkm">ZKM</a></li>
                    </ul>
                </div>
            </div>
            <?php } ?>       
        </li>
    </ul>
</div>