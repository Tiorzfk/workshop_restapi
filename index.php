<?php
require 'flight/Flight.php';
require 'controllers.php';
require 'config/koneksi.php';

Flight::route('POST /login', 'login');

Flight::route('POST /register', 'register');

Flight::route('GET /user', 'user');

Flight::route('POST /user', 'editUser');

Flight::route('DELETE /user', 'deleteUser');

Flight::start();
?>
