<?php
include_once '../components/header.php';
include('config.php');

//Reset OAuth access token
$google_client->revokeToken();

//Destroy entire session data.
session_destroy();

//redirect to back page
echo "<script>window.history.back();</script>";

?>