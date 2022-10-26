<?php
session_start();
require('connexion/connect.php');
require('loader.php');
include('instance.php');

if(!isset($_GET['id']) || !(Client::isconnected()) || !($user instanceof Admin)) echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

    Client::supprimer_clientbyid($_GET['id']);
    echo "<script>alert('Opération réussi')</script>";
    echo "<script type='text/javascript'>document.location.replace('g_clients.php');</script>";
    

$conn=null;





?>