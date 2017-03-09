<?php

/*

  Author: Dan Benjamin - http://hivelogic.com/

  Copyright (c) 2004 Automatic, Ltd. All Rights Reserved.

  THIS SOFTWARE IS PROVIDED "AS IS", WITHOUT ANY WARRANTY OR CONDITION OF
  ANY KIND, EXPRESS, IMPLIED OR STATUTORY, INCLUDING WITHOUT LIMITATION ANY
  IMPLIED WARRANTIES OF ACCURACY, MERCHANTABILITY, FITNESS FOR A PARTICULAR
  PURPOSE OR NONINFRINGEMENT.

  IN NO EVENT SHALL DAN BENJAMIN, A LIST APART, OR AUTOMATIC, LTD. BE LIABLE
  FOR ANY DIRECT, INDIRECT, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES OR
  LOST PROFITS ARISING OUT OF OR IN CONNECTION WITH THE SOFTWARE (HOWEVER
  ARISING, INCLUDING NEGLIGENCE), EVEN IF DAN BENJAMIN, A LIST APART, OR
  AUTOMATIC, LTD. IS AWARE OF THE POSSIBILITY OF SUCH DAMAGES.

*/



  # file containg your image descriptions

  $IMG_CONFIG_FILE = 'images.ini';



  # You shouldn't need to change anything below this point

  function showImage( $ini=null ) {
    global $IMG_CONFIG_FILE;
    # if no custom ini file has been specified, use the default
    $ini_file = $ini ? $ini : $IMG_CONFIG_FILE;
    # read the config file into an array or die trying
    $images = @parse_ini_file($ini_file,true);
    if (! $images) {
      die('Unable to read ini file.');
    }
    # pick a random image from the parsed config file
    $img = array_rand($images);
    if (isset($images["$img"])) {
      # get the selected image's css id if one exists
      $id = !empty($images[$img]['id']) ?
        sprintf( ' id="%s" ', $images[$img]['id'] ) :
        '';
      # get the selected image's css class if one exists
      $class = !empty($images[$img]['class']) ?
        sprintf( ' class="%s" ', $images[$img]['class'] ) :
        '';
      # get selected image's dimensions
      $size = @getimagesize( $images[$img]['src'] );
      # if an url was specified, output the opening A HREF tag
      if ( !empty($images[$img]['url']) ) {
        printf(
          '<a href="%s" title="%s">',
          $images[$img]['url'],
          $images[$img]['title']
        );
      }
      # output the IMG tag
      printf(
        '<img src="%s" alt="%s" %s %s%s/>',
        $images[$img]['src'],
        $images[$img]['alt'],
        $size[3],
        $id,
        $class
      );
      # if an url was specified, output the closing A HREF tag
      if ( !empty($images[$img]['url']) ) {
        echo('</a>');
      }
    }
  }


?>
