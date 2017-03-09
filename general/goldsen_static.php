<?php

function goldsen_recent() {
  // recent aquisitions
  //goldsen_show_result_set("Recent Acquisition", "Yes");
  echo "<h2>No recent acquistions.</h2>\r";
  }

function goldsen_media($media) {
  // media types
  $coll = goldsen_load_collection("Media", $media);
  goldsen_show_content($coll);
}

function goldsen_content($content) {
  // content types
  $coll = goldsen_load_collection("Content", $content);
  goldsen_show_content($coll);
  }


/*
  data format is
  Export Media & "<:-:>" & Export Content & "<:-:>" & Author & "<:-:>" & Title & "<:-:>" & Year & "<:-:>" & Format

  file must have unix line endings (LF) and be pre-sorted by SortingMashup
 */

function goldsen_load_collection($category = 'Content', $tag = 'exhibitions & artist compilations') {
  $output = array();
  $lines = file('./goldsen-collection-list.txt');
  $tag_index = (strcmp($category,'Content') == 0) ? 1 : 0;
  foreach ($lines as $line) {
    $fields = explode('<:-:>', $line);
    if (empty($fields[$tag_index])) {
      continue;
    }
    $tags = explode('|', $fields[$tag_index]);
    if (in_array($tag, $tags)) {
      $output[] = array(
        'author' => $fields[2],
        'title' => $fields[3],
        'year' => $fields[4],
        'format' => $fields[4],
        'sort' => $fields[5],
        );
    }
  }
  return $output;
  }

function goldsen_show_content($output) {
  echo "<ul>\r";
  foreach ($output as $fields) {
    $outs = array();
    if (!empty($fields["author"])) $outs[] = $fields["author"];
    if (!empty($fields["title"])) $outs[] = "<span class=\"italic\">" . $fields["title"] . "</span>";
    if (!empty($fields["year"])) $outs[] = $fields["year"];
    $format = (!empty($fields["format"])) ? " (" . $fields["format"] . ")" : "";
    echo "<li>" . implode(", ",$outs) . $format . "</li>\r";
  }
  echo "</ul>\r";
}

