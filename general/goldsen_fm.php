<?php
// goldsen_fm.php - Filemaker results for Goldsen archive
//require_once("fmresultset.php");
require_once("goldsen_static.php");

function goldsen_recent() {
	// recent aquisitions
	//goldsen_show_result_set("Recent Acquisition", "Yes");
	echo "<h2>No recent acquistions.</h2>\r";
	}

function old_fm_goldsen_media($media) {
	// media types
	//goldsen_show_result_set("Media", $media);
	$coll = goldsen_load_collection("Media", $media);
	goldsen_show_content($coll);
}

function old_fm_goldsen_content($content) {
	// media types
	//goldsen_show_result_set("Content", $content);
	$coll = goldsen_load_collection("Content", $content);
	goldsen_show_content($coll);
	}

// function goldsen_show_result_set($key, $value) {
// 	$key = rawurlencode($key);
// 	$value = rawurlencode($value);

// 	$url = "http://lib-filemaker.library.cornell.edu/fmi/xml/fmresultset.xml?-db=general_collection&-lay=Web-Citation-Fields";
// 	$url .= "&$key=$value&-sortfield.1=SortingMashup&-find";
// 	echo "\r<!-- $url -->\r";

// 	$result = fmresultset($url);

// 	// <li>[AUTHOR], <span class="italic">[TITLE]</span>, [YEAR] ([FORMAT]).</li>

// 	echo "<ul>\r";
// 			foreach ($result as $recordID => $record) {
// 				foreach ($record as $portal_file => $fields) {
// 					if ($portal_file == "0") {
// 						$outs = array();
// 						if (!empty($fields["Author"])) $outs[] = $fields["Author"];
// 						if (!empty($fields["Title"])) $outs[] = "<span class=\"italic\">" . $fields["Title"] . "</span>";
// 						if (!empty($fields["Year"])) $outs[] = $fields["Year"];
// 						$format = (!empty($fields["Format"])) ? " (" . $fields["Format"] . ")" : "";
// 						echo "<li>" . implode(", ",$outs) . $format . "</li>\r";
// 						break;
// 						}
// 					}
// 				}
// 	echo "</ul>";
// 	}
?>
