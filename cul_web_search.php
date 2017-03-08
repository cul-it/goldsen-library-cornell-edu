<?php
/* 
cul_web_search.php - functions supporting search of 
	Cornell University Library websites 
	using the Google Search Appliance
	
	At the top of the .php page with the search:
		require_once("cul_web_search.php");
		
	at the place where you want the search box:
		cul_web_search_form();
		
	at the place where you want the search results:
		cul_web_search_results();
	
-JGReidy 
cornell netid: jgr25
*/
include_once('cul_gsa_search.php');

function cul_web_search_form() {
	$action = $_SERVER['PHP_SELF'];
	$search_query = isset($_GET['q']) ? htmlspecialchars($_GET['q']) : "";
	$search_label = "Search Cornell University Library Websites:";
	cul_web_search_form_template($action, $search_query, $search_label);
	}
	
function cul_web_search_form_template($action, $search_query, $search_label) {
	$output = <<<EOT
	<div id="search-form">
	
		<form action="$action" method="get" enctype="application/x-www-form-urlencoded">
			<div id="search-input">
				<label for="search-form-query">$search_label</label><br />
				<input type="text" id="search-form-query" name="q" value="$search_query" size="50" maxlength="256" />
				<input type="submit" id="search-form-submit" name="submit" value="go" />
				<input type="hidden" name="output" value="xml_no_dtd" />
				<input type="hidden" name="sort" value="" />
				<input type="hidden" name="ie" value="UTF-8" />
				<input type="hidden" name="client" value="default_frontend" />
				<input type="hidden" name="oe" value="UTF-8" />
				<input type="hidden" name="site" value="libraries" />
			</div>	
		</form>

	</div>
EOT;
	print $output;
	}
	
function cul_web_search_results() {
	if (!empty($_GET['q'])) {
		// search results to display
		$sitesearch = isset($_GET['sitesearch']) ? htmlspecialchars($_GET['sitesearch']) : '';		
		$starting_page = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
		$num_per_page = isset($_GET['num']) ? htmlspecialchars($_GET['num']) : RESULTS_PER_PAGE;
		
		$q = htmlspecialchars($_GET['q']);
		
		$searcher = new cul_gsa_search();
		$searcher->setSite($sitesearch);
		$searcher->setCollection("libraries");
		$searcher->setStartingResult($starting_page);
		$searcher->setResultCount($num_per_page);
		$output = "";
		if ($searcher->search($q)) {
			$output .= "<div id=\"top_sep_bar\">";
			$total_count = $searcher->getResultsCount();			
			if ($total_count < 1) {
				$output .= "Your search for '$q' returned 0 results.\r";
				$output .= "</div>\r";
				}
			else {
				$result = $searcher->getResults();
				$search_time = $searcher->getTime();
				
				$output .= "Your search for '$q' took $search_time seconds.\r";
	
				$starting = $searcher->getStartingResultNumber();
				$ending = $searcher->getEndingResultNumber();
				
				$output .= "Results $starting - $ending:\r";
			
				// note: look at NB tag for next/ previous pages
				$url_next_page = $searcher->getNextURL();
				$url_previous_page = $searcher->getPreviousURL();
				
				if (!empty($url_previous_page)) {
					$output .= "<a href=\"$url_previous_page\">&lt; Previous</a>\r";
					}
				if (!empty($url_next_page)) {
					$output .= "<a href=\"$url_next_page\">Next &gt;</a>\r";
					}
					
				$output .= "</div>\r";
				
				$output .= "<div id=\"searchresults\">\r";
				$output .= "<div id=\"googleresults\">\r";
				
				$keymatch = $searcher->getKeymatchResults();
				
				foreach($keymatch as $kmat) {
					$output .= '<p class="keymatch">';
					$output .= '<span class="lk"><a href="' . $kmat['GL'] . '">' . $kmat['GD'] . '</a></span>';
					$output .= '<span class="kk"> - Key Match</span><br />';
					$output .= '<span class="a">' . $kmat['GL'] . '</span>';
					$output .= "</p>\r";
					}

					
				$return_name = array (
					"N" => "result_number",
					"U" => "url",
					"T" => "title",
					"S" => "description"
					);
					
				$named_result = array();
				foreach ($result as $it) {
					$new_it = array();
					foreach ($return_name as $internal => $external) {
						$new_it[$external] = $it[$internal];
						}
					$named_result[] = $new_it;
					}
				$results = $named_result;
				
				foreach ($results as $result) {
					$output .= "<p>";
					$output .= '<span class="gray">' . $result['result_number'] . ".</span> ";
					$output .= '<a href="' . $result['url'] . '" class="bold">' . $result['title'] . '</a><br />';
					$output .= $result['description'] . "<br />";
					$output .= '<span class="url"><a href="' . $result['url'] . '">' . $result['url'] . '</a></span>';
					$output .= "</li>\r";
					}
				
				$output .= "</div>\r";
				$output .= "</div>\r";
				}
			}
		else {
			$output .= $searcher->getError();
			}
		}
	print $output;
	}
?>