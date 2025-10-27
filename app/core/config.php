<?php
    require_once __DIR__.'/../../vendor/autoload.php';
    
    $clientID = '81206704171-otum5ea76gu52cvlm01q90capq22kkhp.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = APP_URL.'/google/callback';
    $client = new Google\Client();
    $client->setClientId($clientID);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope("email");
    $client->addScope("profile");
?>