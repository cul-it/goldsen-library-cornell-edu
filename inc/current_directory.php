<?php
/* current_directory.php - returns current directory ('htdocs' if in top diorectory of site)
	useage:
		<?php include('../inc/current_directory.php') ?>

		<body id="<?=$current_directory?>">
			would result in
		<body id="htdocs">
*/
function my_dir(){
  $path = $_SERVER['REQUEST_URI'];
  if (empty($path)) {
    $path = $_SERVER['PHP_SELF'];
    if (empty($path)) {
      $path = str_replace('\\','/',__FILE__);
    }
  }
  $each_dir = explode('/', dirname($path));
  $dir = end($each_dir);
  return $dir;
}
$current_directory = my_dir();
?>
