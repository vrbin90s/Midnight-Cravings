<?php
  function html( $text ) {
    echo $out = htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
  }
 ?>
