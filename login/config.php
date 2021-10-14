<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once '../vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('396333097416-on4c8d798bln3l6mqeilp20kv13al75n.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/3rd%20year%20project/Online%20Admission%20and%20Learning%20System/login/');

//
$google_client->addScope('email');

$google_client->addScope('profile');


?>
