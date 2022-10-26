<?php
session_start();
require('loader.php');

if(Client::isconnected()){
unset($_SESSION['username']);
unset($_SESSION['password']);

}

echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

?>