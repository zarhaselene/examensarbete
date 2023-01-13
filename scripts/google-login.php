<?php

require_once __DIR__ . "/../classes/UsersDatabase.php";
require_once __DIR__ . "/../classes/User.php";

//Include Google Configuration File
require_once __DIR__ . "/../google-config.php";

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

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
        }

        $user = new User($data["email"], "customer");

        $db_user = new UsersDatabase();

        $user->id = $db_user->get_google_user_id($user);

        var_dump($user);

        $_SESSION["logged_in"] = true;
        $_SESSION["user"] = $user;

        header("Location: /exa/index.php");
    }
}
