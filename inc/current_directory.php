<?php
/* current_directory.php - returns current directory ('htdocs' if in top diorectory of site)
	useage:
		<?php include('../inc/current_directory.php') ?>
		
		<body id="<?=$current_directory?>">
			would result in
		<body id="htdocs">
*/
function my_dir(){
    return end(explode('/', dirname(!empty($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : !empty($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : str_replace('\\','/',__FILE__))));
}
$current_directory = my_dir();
?>