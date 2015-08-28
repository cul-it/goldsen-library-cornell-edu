<?php include('rotator.php'); require_once("cul_web_search.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title>Rose Goldsen Archive of New Media Art | Cornell University Library</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta http-equiv="Content-Language" content="en-us" />
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" media="screen" href="/styles/screen.css" />
<link rel="stylesheet" type="text/css" media="print" href="/styles/print.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/styles/search.css" />
</head>
<body id="results">
<?php include("inc/cu_identity2.php") ?>


<div id="wrap">
  <div id="content-wrapper">
  		
	  	<div id="content">
        	<?php showImage(); ?>
		    
            <?php include("inc/navigation.php") ?>
            
		    <hr />
		
		    <div id="main">
            	
		      	<h1>Search Results</h1>
				<?php cul_web_search_results(); ?> 
                
      	  	</div> <!--close #main -->

            
            
            <?php include("inc/footer.php") ?>
            
			
			
    	</div>  <!--close #content -->
	</div>	<!--close #content-wrapper -->
	
<hr />


</div> <!--close #wrap -->
<?php include("inc/ga.php") ?>
</body>
</html>
