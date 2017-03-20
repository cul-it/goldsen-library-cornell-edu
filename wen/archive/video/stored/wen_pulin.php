<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Wen Pulin archive</title>
</head>

<body>

<table bordercolor="#000000" cellpadding="1" border="1">
<?php

	$file = 'wen_pulin.xml';

	if (!($fp = fopen($file, "r"))) {
	   die("could not open XML input");
	}
	$data = fread($fp, filesize($file));
	fclose($fp);
	
	$params = array();
	$params = XMLtoArray($data);
	//print($params["WEN_PULIN"]["VIDEO"]["ID"]);
	foreach($params["WEN_PULIN_COLLECTION"]["VIDEO"][$_GET['id']-1] as $key => $val) {
		print("<tr><td>$key</td><td>$val</td><tr>");

?>



<?php
	}
?>
</table>
<?php

	function XMLtoArray($XML) {
	   $xml_parser = xml_parser_create();
	   xml_parse_into_struct($xml_parser, $XML, $vals);
	   xml_parser_free($xml_parser);
	   // wyznaczamy tablice z powtarzajacymi sie tagami na tym samym poziomie 
	   $_tmp='';
	   foreach ($vals as $xml_elem)
	   { 
		   $x_tag=$xml_elem['tag'];
		   $x_level=$xml_elem['level'];
		   $x_type=$xml_elem['type'];
		   if ($x_level!=1 && $x_type == 'close')
		   {
			   if (isset($multi_key[$x_tag][$x_level]))
				   $multi_key[$x_tag][$x_level]=1;
			   else
				   $multi_key[$x_tag][$x_level]=0;
		   }
		   if ($x_level!=1 && $x_type == 'complete')
		   {
			   if ($_tmp==$x_tag) 
				   $multi_key[$x_tag][$x_level]=1;
			   $_tmp=$x_tag;
		   }
	   }
	   // jedziemy po tablicy
	   foreach ($vals as $xml_elem)
	   { 
		   $x_tag=$xml_elem['tag'];
		   $x_level=$xml_elem['level'];
		   $x_type=$xml_elem['type'];
		   if ($x_type == 'open') 
			   $level[$x_level] = $x_tag;
		   $start_level = 1;
		   $php_stmt = '$xml_array';
		   if ($x_type=='close' && $x_level!=1) 
			   $multi_key[$x_tag][$x_level]++;
		   while($start_level < $x_level)
		   {
				 $php_stmt .= '[$level['.$start_level.']]';
				 if (isset($multi_key[$level[$start_level]][$start_level]) && $multi_key[$level[$start_level]][$start_level]) 
					 $php_stmt .= '['.($multi_key[$level[$start_level]][$start_level]-1).']';
				 $start_level++;
		   }
		   $add='';
		   if (isset($multi_key[$x_tag][$x_level]) && $multi_key[$x_tag][$x_level] && ($x_type=='open' || $x_type=='complete'))
		   {
			   if (!isset($multi_key2[$x_tag][$x_level]))
				   $multi_key2[$x_tag][$x_level]=0;
			   else
				   $multi_key2[$x_tag][$x_level]++;
				 $add='['.$multi_key2[$x_tag][$x_level].']'; 
		   }
		   if (isset($xml_elem['value']) && trim($xml_elem['value'])!='' && !array_key_exists('attributes',$xml_elem))
		   {
			   if ($x_type == 'open') 
				   $php_stmt_main=$php_stmt.'[$x_type]'.$add.'[\'content\'] = $xml_elem[\'value\'];';
			   else
				   $php_stmt_main=$php_stmt.'[$x_tag]'.$add.' = $xml_elem[\'value\'];';
			   eval($php_stmt_main);
		   }
		   if (array_key_exists('attributes',$xml_elem))
		   {
			   if (isset($xml_elem['value']))
			   {
				   $php_stmt_main=$php_stmt.'[$x_tag]'.$add.'[\'content\'] = $xml_elem[\'value\'];';
				   eval($php_stmt_main);
			   }
			   foreach ($xml_elem['attributes'] as $key=>$value)
			   {
				   $php_stmt_att=$php_stmt.'[$x_tag]'.$add.'[$key] = $value;';
				   eval($php_stmt_att);
			   }
		   }
	   }
		 return $xml_array;
	}    // END XMLtoArray
?> 
</body>
</html>
