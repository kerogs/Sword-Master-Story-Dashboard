<?php

// $site = file_get_contents('https://ucngame.com/codes/sword-master-story-coupon-codes/');
$url = 'https://ucngame.com/codes/sword-master-story-coupon-codes/';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

// ! Bypass cloudflare (change user-agent if can't bypass and can't get code.)
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (iPad; CPU OS 12_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148');

$site = curl_exec($curl);

curl_close($curl);

$couponList = array();

$pattern = '/<strong>([A-Z0-9]+)<\/strong><\/td><td>Redeem this coupon code for ([^(]+) \(Valid until ([^\)]+)\)/';

preg_match_all($pattern, $site, $matches, PREG_SET_ORDER);

foreach ($matches as $match) {
    $couponName = $match[1];
    $rewardDescription = trim($match[2]); 
    $expiration = date('Y-m-d', strtotime($match[3]));

    $rewardValue = '';
    $rewardType = '';
    preg_match('/x([0-9,]+)/', $rewardDescription, $rewardValueMatches);
    if (!empty($rewardValueMatches[1])) {
        $rewardValue = str_replace(',', '', $rewardValueMatches[1]);
    }

    if (stripos($rewardDescription, 'Ruby') !== false) {
        $rewardType = 'Ruby';
    } elseif (stripos($rewardDescription, 'Stamina') !== false) {
        $rewardType = 'Stamina';
    } elseif (stripos($rewardDescription, 'Gold Bar') !== false) {
        $rewardType = 'Gold Bar';
    }

    $coupon = array(
        'name' => $couponName,
        'expiration' => $expiration,
        'reward' => array(
            'description' => $rewardDescription,
            'value' => (float)$rewardValue,
            'type' => $rewardType
        )
    );

    $couponList[] = $coupon;
}


$jsonData = json_encode($couponList, JSON_PRETTY_PRINT);


$file = fopen('./data/couponList.json', 'w');
if ($file) {
    fwrite($file, $jsonData);
    fclose($file);
} else {
}

?>
