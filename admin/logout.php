<?php
include_once '../components/header.php';

//Destroy entire session data.
session_destroy();

//redirect to back page
echo "<script>window.history.back();</script>";

?>