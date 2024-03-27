<?php

$site = file_get_contents('https://ucngame.com/codes/sword-master-story-coupon-codes/');

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
