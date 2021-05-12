<?php
require "libs/rb.php";
R::setup( 'mysql:host=localhost;dbname=mapo',
    'mysql', 'mysql' ); //for both mysql or mariaDB
session_start();
?>