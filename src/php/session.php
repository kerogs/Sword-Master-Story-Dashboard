<?php

function tokenMaker($longueur = 18)
{
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
    mkdir('./data/account/' . $token);

    header('Location: ./');

    $data = array(
        "username" => $username,
        "totalcouponClaim" => 0,
        "lastClaim" => "N/A",
        "lastLogin" => $today_date,
        "couponClaim" => array(),
        "theme" => array(
            "style" => "dark",
            "bannerCaracter" => "default.png",
            "bannerBackground" => "default.png"
        )
    );
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("./data/account/$token/data.json", $json_data);
    file_put_contents("./data/account/$token/couponClaim.json", "[]");

    exit;
} else {
    setcookie('token', uniqid() . '_' . $_COOKIE['sms3_token'], $date_expiration);
}

$jsonServData = file_get_contents('./data/serverData.json');
$servData = json_decode($jsonServData, true);

$tokenPath = "./data/account/" . $_COOKIE['sms3_token'];

function compareExpiration($a, $b)
{
    return strtotime($a['expiration']) <=> strtotime($b['expiration']);
}

function extractCoupons($filePath, $count, $latest = true)
{
    if (!file_exists($filePath)) {
        return null;
    }

    $jsonContent = file_get_contents($filePath);
    $coupons = json_decode($jsonContent, true);
    usort($coupons, 'compareExpiration');

    if ($latest) {
        $selectedCoupons = array_slice($coupons, -$count, $count);
    } else {
        $selectedCoupons = array_slice($coupons, 0, $count);
    }

    return $selectedCoupons;
}

function countNames($jsonData) {
    $coupons = json_decode($jsonData, true);
    $nameCount = 0;
    foreach ($coupons as $coupon) {
        if (isset($coupon['name'])) {
            $nameCount++;
        }
    }
    return $nameCount;
}










function couponExists($couponName, $jsonFilePath) {
    if (!file_exists($jsonFilePath)) {
        return false;
    }

    $jsonData = file_get_contents($jsonFilePath);
    $coupons = json_decode($jsonData, true);

    foreach ($coupons as $coupon) {
        if (isset($coupon['name']) && $coupon['name'] === $couponName) {
            return true;
        }
    }

    return false;
}

function getLastCoupon($jsonFilePath) {
    if (!file_exists($jsonFilePath)) {
        return null;
    }

    $jsonData = file_get_contents($jsonFilePath);
    $coupons = json_decode($jsonData, true);

    if (empty($coupons)) {
        return null;
    }

    $lastCoupon = end($coupons);

    return $lastCoupon;
}




















function getFirstCoupons($jsonFilePath, $number) {
    if (!file_exists($jsonFilePath)) {
        return null;
    }

    $jsonData = file_get_contents($jsonFilePath);
    $coupons = json_decode($jsonData, true);

    if (empty($coupons)) {
        return null;
    }

    $result = array();

    for ($i = 0; $i < min($number, count($coupons)); $i++) {
        $coupon = $coupons[$i];
        $result[] = array(
            'name' => $coupon['name'],
            'description' => $coupon['reward']['description']
        );
    }

    return $result;
}
