<?php

function load_header_template($file){
  ob_start();
  require $file;
  $html = ob_get_contents();
  ob_end_clean();

  echo $html;
}