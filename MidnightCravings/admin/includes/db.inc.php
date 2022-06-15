<?php
  try
  {
    //$pdo = new PDO( 'mysql:host=mysql.cms.gre.ac.uk; dbname=mdb_ks3319t', 'ks3319t', 'ks3319t' ); //PDO extension for use in the university.
    $pdo = new PDO( 'mysql:host=localhost; dbname=mdb_ks3319t_sec', 'root', '' ); //PDO extension for use at home.
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $pdo->exec( 'SET NAMES "utf8"' );

  } catch (PDOException $e) {

    //$error = 'Unable to connect to database server:' . $e->getMessage();
    $error = 'Unable to connect to database server';
    include 'error.html.php';
    exit();

  }

  // echo 'Database connection established'; /* comment this line out once the connection is working */


 ?>
