<?php
// goldsen_fm.php - Filemaker results for Goldsen archive
require_once("fmresultset.php");

function goldsen_recent() {
	// recent aquisitions
	goldsen_show_result_set("Recent Acquisition", "Yes");
	}
	
function goldsen_media($media) {
	// media types
	goldsen_show_result_set("Media", $media);
	}
	
function goldsen_content($content) {
	// media types
	goldsen_show_result_set("Content", $content);
	}
	
function goldsen_show_result_set($key, $value) {
	$key = rawurlencode($key);
	$value = rawurlencode($value);
	
	$url = "http://lib-filemaker.library.cornell.edu/fmi/xml/fmresultset.xml?-db=general_collection&-lay=Web-Citation-Fields";
	$url .= "&$key=$value&-sortfield.1=SortingMashup&-find";
	echo "\r<!-- $url -->\r";	
	
	$result = fmresultset($url);
	
	// <li>[AUTHOR], <span class="italic">[TITLE]</span>, [YEAR] ([FORMAT]).</li>

	echo "<ul>\r";
			foreach ($result as $recordID => $record) {
				foreach ($record as $portal_file => $fields) {
					if ($portal_file == "0") {
						$outs = array();
						if (!empty($fields["Author"])) $outs[] = $fields["Author"];
						if (!empty($fields["Title"])) $outs[] = "<span class=\"italic\">" . $fields["Title"] . "</span>";
						if (!empty($fields["Year"])) $outs[] = $fields["Year"];
						$format = (!empty($fields["Format"])) ? " (" . $fields["Format"] . ")" : "";
						echo "<li>" . implode(", ",$outs) . $format . "</li>\r";
						break;
						}
					}
				}
	echo "</ul>";
	}
?>
