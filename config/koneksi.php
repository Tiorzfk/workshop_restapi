<?php
# Database Information #
Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=workshop_restapi','root',''), function($db) {
  $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
});
?>
