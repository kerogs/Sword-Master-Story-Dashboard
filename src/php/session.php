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
if (!isset($_COOKIE['sms3_token'])) {

    $date_expiration = time() + (10 * 365 * 24 * 60 * 60);
    $token = uniqid() . '-' . tokenMaker();
    setcookie('sms3_token', $token, $date_expiration);
    mkdir('./data/account/' . $token);

    $data = array(
        "username" => $username,
        "totalcouponClaim" => 0,
        "lastClaim" => "N/A",
        "lastLogin" => $today_date,
        "couponClaim" => array(),
        "theme" => array(
            "style" => "dark",
            "bannerCharacter" => "default.png",
            "bannerBackground" => "default.png"
        )
    );
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents("./data/account/$token/data.json", $json_data);
    file_put_contents("./data/account/$token/couponClaim.json", "[]");

    header('Location: ./');
    exit;
} else {
    setcookie('token', uniqid() . '_' . $_COOKIE['sms3_token'], $date_expiration);
}

$jsonServData = file_get_contents('./data/serverData.json');
$servData = json_decode($jsonServData, true);

// ? Path to the account
$tokenPath = "./data/account/" . $_COOKIE['sms3_token'];





// ? Save last login
$lastLoginDate = date('Y-F-d H:i:s');
$dataToUpdate = array('lastLogin' => $lastLoginDate);
$currentData = file_get_contents($tokenPath."/data.json");
$currentDataArray = json_decode($currentData, true); // ! Used for other code too
$lastLoginBefore = $currentDataArray['lastLogin']; // ! Save before change lastLogin
$newDataArray = array_merge($currentDataArray, $dataToUpdate);
$newDataJson = json_encode($newDataArray, JSON_PRETTY_PRINT);
file_put_contents($tokenPath."/data.json", $newDataJson);








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
            'description' => $coupon['reward']['description'],
            'type' => $coupon['reward']['type'],
            'expiration' => $coupon['expiration']
        );
    }

    return $result;
}








function isDateFuture($dateString) {
    $currentTime = time(); // Timestamp actuel
    $inputTime = strtotime($dateString); // Timestamp de la date fournie
    
    // Comparaison des timestamps
    if ($inputTime > $currentTime) {
        return true; // La date est future
    } else {
        return false; // La date est passée ou égale à la date actuelle
    }
}