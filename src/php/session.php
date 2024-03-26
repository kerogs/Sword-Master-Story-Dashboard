<?php

function tokenMaker($longueur = 18) {
    $caracteres_autorises = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_()';
    $nb_caracteres = strlen($caracteres_autorises);
    $token = '';

    for ($i = 0; $i < $longueur; $i++) {
        $indice = rand(0, $nb_caracteres - 1);
        $token .= $caracteres_autorises[$indice];
    }

    return $token;
}

$today_date = date("Y m d");
if ($_COOKIE['sms3_token'] != true) {

    $date_expiration = time() + (10 * 365 * 24 * 60 * 60);
    $token = uniqid() . '-' . tokenMaker();
    setcookie('sms3_token', $token, $date_expiration);
    mkdir('./data/account/'.$token);

    header('Location: ./');

    $data = array(
        "username" => $username,
        "totalDiscountClaim" => 0,
        "lastClaim" => "N/A",
        "lastLogin" => $today_date,
        "discountClaim" => array(),
        "theme" => array(
            "style" => "dark",
            "bannerCaracter" => "default.png",
            "bannerBackground" => "default.png"
        )
    );
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("./data/account/$token/data.json", $json_data);

    exit;
}else{
    setcookie('token', uniqid() . '_' . $_COOKIE['sms3_token'], $date_expiration);
}

$jsonServData = file_get_contents('./data/serverData.json');
$servData = json_decode($jsonServData, true);

$tokenPath = "./data/account/".$_COOKIE['sms3_token'];
