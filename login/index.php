<?php
include('config.php');
include_once('../components/header.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if (isset($_GET["code"])) {
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if (!isset($token['error'])) {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Get user profile data from google
        $data = $google_service->userinfo->get();
        
        $firstName = $data['given_name']; 
        $lastName = $data['family_name'];
        $email = $data['email'];
        $imageUrl = $data['picture'];

        $sql_insertUser = "INSERT into users (email, firstName, lastName, imageUrl) values('$email', '$firstName', '$lastName', '$imageUrl');";
        if(mysqli_query($conn, $sql_insertUser)) {
            echo '';
        }

        //Below you can find Get profile data and store into $_SESSION variable
        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if (!isset($_SESSION['access_token'])) {
    //Create a URL to obtain user authorization
    $login_button = '<a class="btn btn-primary" href="' . $google_client->createAuthUrl() . '"><i class="fab fa-google"></i> Continue with google</a>';
}



?>

<div class="container mt-8 text-light">
    <div class="row justify-content-center">
        <div class="col-6  mt-4 border rounded bgc-primary p-4">
            <h2 class="text-center mb-4">Login using Google Account</h2>
            <?php
            if ($login_button == '') {
                header("Location: ../index.php");
            } else {
                echo '<div align="center">' . $login_button . '</div>';
            }

            ?>

        </div>
    </div>
</div>
</body>

</html>