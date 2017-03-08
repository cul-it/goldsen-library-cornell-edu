<?php
/*
google_cul.php - google search appliance handler for cornell university library

-jgr25

http://web.search.cornell.edu/search?q=three+blind+mice
&btnG=go&output=xml&sort=date%3AD%3AL%3Ad1&ie=UTF-8
&client=default_frontend&oe=UTF-8
&site=default_collection&sitesearch=cornell.edu

KeyMatch example:
<GM>
<GL>http://www.clal.cornell.edu/</GL>
<GD>Cornell Language Acquisition Laboratory</GD>
</GM>
<GM>
<GL>http://www.arts.cornell.edu/russian/index.html</GL>
<GD>Russian Literature</GD>
</GM>

*/
class cul_gsa_search {
	var $params = array();
	var $results = array();
	var $keymatch_results = array();  // GM (GL, GD)
	var $search_time; // TM
	var $query;
	var $starting;
	var $ending;
	var $total_count;
	var $query_next_page;
	var $query_previous_page;
	var $error;
	// parser context
	var $cur_keymatch = array();
	var $cur = array();
	var $cur_text;
	var $capture;
	
	function cul_gsa_search() {
		//q,btnG,output,sort,ie,gsa_client,oe,site,proxyreload,sitesearch,start
		$this->params = array(
			"q" => "",
			"output" => "xml_no_dtd",
			"sort" => "",
			"ie" => "UTF-8",
			"oe" => "UTF-8",
			"client" => "default_frontend",
			"site" => "default_collection",
			"sitesearch" => "library.cornell.edu"
			);		
		$this->error = false;
		}
		
	function setSite($sitesearch = "library.cornell.edu") {
		$this->params["sitesearch"] = $sitesearch;
		}
		
	function setCollection($collection = "default_collection") {
		$this->params["site"] = $collection;
		}
		
	function setStartingResult($starting_result = 0) {
		$this->params["start"] = $starting_result;
		}
		
	function setResultCount($num_results = 10) {
		$this->params["num"] = $num_results;
		}
		
	function setQueryCharset($charset = "UTF-8") {
		$this->params["ie"] = $num_results;
		}
		
	function setResultCharset($charset = "UTF-8") {
		$this->params["oe"] = $num_results;
		}
		
	function setLanguageFilter($lang = "lang_en") {
		// see http://code.google.com/gsa_apis/xml_reference.html#request_subcollections_auto
		$this->params["lr"] = $lang;
		}
		
	function search($query) {
		$this->query = $query;
		$this->params["q"] = $query;
		$this->error = false;
		$allswell = true;
		
		$url = "http://web.search.cornell.edu/search?" . http_build_query($this->params);

		// Create Expat parser
		$parser = xml_parser_create();
		
		// Set handler functions
		xml_set_element_handler($parser, array(&$this, "start_element"), array(&$this, "stop_element"));
		xml_set_character_data_handler($parser, array(&$this, "char_data"));
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	
		// Parse the file
		$ret = parse_from_url($parser, $url);
		if(!$ret) {
			$allswell = false;
		    $this->error = sprintf("XML error: %s at line %d",
		                    xml_error_string(xml_get_error_code($parser)),
		                    xml_get_current_line_number($parser));
			}
		
		// Free parser
		xml_parser_free($parser);
		
		return $allswell;
		}
		
	function getKeymatchResults() {
		return $this->keymatch_results;
		}
		
	function getResults() {
		return $this->results;
		}
	
	function getTime($format = "%.2f") {
		return sprintf($format, $this->search_time);
		}
		
	function getNextURL() {
		return $this->query_next_page;
		}
		
	function getPreviousURL() {
		return $this->query_previous_page;
		}
		
	function getStartingResultNumber() {
		return $this->starting;
		}
		
	function getEndingResultNumber() {
		return $this->ending;
		}
		
	function getResultsCount() {
		return $this->total_count;
		}
	
	function getError() {
		return $this->error;
		}
	
	function start_element($parser, $name, $attrs) {
		switch ($name) {
			case "RES":
				$this->starting = $attrs["SN"];
				$this->ending = $attrs["EN"];
				$this->cur = array();
				break;
			case "R":
				$this->cur["N"] = $attrs["N"];
				break;
			case "GM":
				$this->cur_keymatch = array();
				break;
			case "GL":
			case "GD":
			case "TM":
			case "NU":
			case "PU":
			case "M":
			case "U":
			case "S":
			case "T":
				$this->capture = true;
				break;
			}
		}
	
	function stop_element($parser, $name) {
		switch ($name) {
			case "R":
				$this->results[] = $this->cur;
				unset($this->cur);
				break;
			case "M":
				$this->total_count = $this->cur_text;
				$this->cur_text = "";
				$this->capture = false;
				break;
			case "NU":
				// comes with 'search' before the query string - chop off
				$this->query_next_page = $_SERVER['PHP_SELF'] . substr($this->cur_text,strpos($this->cur_text, "?"));
				$this->cur_text = "";
				$this->capture = false;
				break;
			case "PU":
				$this->query_previous_page = $_SERVER['PHP_SELF'] . substr($this->cur_text,strpos($this->cur_text, "?"));
				$this->cur_text = "";
				$this->capture = false;
				break;
			case "U":
			case "S":
			case "T":
				$this->cur["$name"] = $this->cur_text;
				$this->cur_text = "";
				$this->capture = false;
				break;
			case "TM":
				$this->search_time = $this->cur_text;
				$this->cur_text = "";
				$this->capture = false;
				break;
			case "GM":
				$this->keymatch_results[] = $this->cur_keymatch;
				break;
			case "GL":
			case "GD":
				$this->cur_keymatch["$name"] = $this->cur_text;
				$this->cur_text = "";
				$this->capture = false;
				break;
			}
		}
	
	function char_data($parser, $data) {
		if ($this->capture)
			$this->cur_text .= $data;
		}
	}	

class google_result_list {
	// for return to caller
	var $list = array();
	var $starting;
	var $ending;
	var $total_count;
	var $query_next_page;
	var $query_previous_page;
	}

class google_parse_context {
	var $cur = array();
	var $cur_text;
	var $capture;
	}
	
$goog_result = new google_result_list();
$goog = new google_parse_context();

function google_cul($query, $sitesearch = "library.cornell.edu", $starting_result = 0, $num_results = 10) {
	global $goog_result;
	
	$url = "http://web.search.cornell.edu/search";
	
	$params = array (
		"q=" . urlencode($query),
		"output=xml_no_dtd",
		"sort=date%3AD%3AL%3Ad1",
		"ie=UTF-8",
		"oe=UTF-8",
		"client=default_frontend",
		"site=default_collection",
		"sitesearch=$sitesearch"
		);
	if ($starting_result > 0) {
		$params[] = "start=$starting_result";
		}
	if ($num_results != 10) {
		$params[] = "num=$num_results";
		}
		
	$url_plus = "$url?" . implode("&", $params);

	// Create Expat parser
	$parser = xml_parser_create();
	
	// Set handler functions
	xml_set_element_handler($parser, "start_element", "stop_element");
	xml_set_character_data_handler($parser, "char_data");
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);

	// Parse the file
	$ret = parse_from_url($parser, $url_plus);
	if(!$ret)
	{
	    die(sprintf("XML error: %s at line %d",
	                    xml_error_string(xml_get_error_code($parser)),
	                    xml_get_current_line_number($parser)));
	}
	
	// Free parser
	xml_parser_free($parser);
	
	return $goog_result;
	}
	
	
function parse_from_url($parser, $url) {
    if(!($fp = @fopen($url, "r"))) 
    {
        die("Can't open \"$url\".");
    }
    
    while($data = fread($fp, 4096))
    {
        if(!xml_parse($parser, $data, feof($fp)))
        {
            return(false);
        }
    }
    
    fclose($fp);
    
    return(true);
	}


function start_element($parser, $name, $attrs) {
	global $goog;
	global $goog_result;
	switch ($name) {
		case "RES":
			$goog_result->starting = $attrs["SN"];
			$goog_result->ending = $attrs["EN"];
			$goog->cur = array();
			break;
		case "R":
			$goog->cur["N"] = $attrs["N"];
			break;
		case "NU":
		case "PU":
		case "M":
		case "U":
		case "S":
		case "T":
			$goog->capture = true;
			break;
		}
	}
	
	
function stop_element($parser, $name) {
	global $goog;
	global $goog_result;
	switch ($name) {
		case "R":
			$goog_result->list[] = $goog->cur;
			unset($goog->cur);
			break;
		case "M":
			$goog_result->total_count = $goog->cur_text;
			$goog->cur_text = "";
			$goog->capture = false;
			break;
		case "NU":
			// comes with 'search' before the query string - chop off
			$goog_result->url_next_page = $_SERVER['PHP_SELF'] . substr($goog->cur_text,strpos($goog->cur_text, "?"));
			$goog->cur_text = "";
			$goog->capture = false;
			break;
		case "PU":
			$goog_result->url_previous_page = $_SERVER['PHP_SELF'] . substr($goog->cur_text,strpos($goog->cur_text, "?"));
			$goog->cur_text = "";
			$goog->capture = false;
			break;
		case "U":
		case "S":
		case "T":
			$goog->cur["$name"] = $goog->cur_text;
			$goog->cur_text = "";
			$goog->capture = false;
			break;
			
		}
	}
	
function char_data($parser, $data) {
	global $goog;
	if ($goog->capture)
		$goog->cur_text .= $data;
	}
		

?>