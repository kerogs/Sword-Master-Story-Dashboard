<?php

require_once './src/php/session.php';

if (isset($_POST['couponMode'])) {
    // ? If you want to use discord webhooks, you can go to this repo :
    // ? https://github.com/kerogs/Discord-webhooks-php

    // ? save $_POST['webhook_url'] in a cookie for 60 days
    setcookie('webhook_url', $_POST['webhook_url'], time() + (60 * 60 * 24 * 60));
    

    $couponMode = $_POST['couponMode'];
    // $webhook_url = $_POST['webhook_url'];
    $webhookList = explode(',', str_replace(" ", "", $_POST['webhook_url']));

    // random background
    $rngimg = 'https://raw.githubusercontent.com/kerogs/Sword-Master-Story---Dashboard/main/src/img/background/'.getRandomFiles('./src/img/background', 1, ['jpg', 'png', 'gif'], false)[0];
    // var_dump($rngimg);
    // random character
    $rngchar = 'https://raw.githubusercontent.com/kerogs/Sword-Master-Story---Dashboard/main/src/img/character/'.getRandomFiles('./src/img/character', 1, ['jpg', 'png', 'gif'], false)[0];
    
    // Initialize $msg with common fields
    $msg = [
        "avatar_url" => "https://github.com/kerogs/Sword-Master-Story---Dashboard/blob/main/src/img/icon.png?raw=true",
        "username" => "SMS3-Dashboard",
        "content" => "",
        "embeds" => [
            [
                "color" => 0xff2017,
                "author" => [
                    "name" => "",
                    "url" => "",
                    "icon_url" => ""
                ],

                "title" => "New coupon available!",
                "url" => "https://github.com/kerogs/Sword-Master-Story---Dashboard",
                "description" => "New coupon available for you! You can pick them up now. *Only displayed coupons are still valid*.",
                "timestamp" => "",

                "footer" => [
                    "text" => "By Kerogs",
                    "icon_url" => "https://avatars.githubusercontent.com/u/43384553",
                ],

                "image" => [
                    "url" => $rngimg
                ],
                "thumbnail" => [
                    "url" => $rngchar
                ],
            ]
        ],
    ];

    // Add available coupon names to respective fields based on coupon mode
    $availableCoupons = "";
    $claimedCoupons = "";

    $couponListing = getFirstCoupons("./data/couponList.json", 100);
    foreach ($couponListing as $coupon) {
        if (couponExists($coupon['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")) {
            $claimedCoupons .= '``' . $coupon['name'] . '``, ';
        } elseif (isDateFuture($coupon['expiration'])) {
            $availableCoupons .= '``' . $coupon['name'] . '``, ';
        }
    }

    if ($couponMode == 'unclaimed') {
        $msg['embeds'][0]['fields'][] = [
            "name" => "Available coupon",
            "value" => $availableCoupons,
            "inline" => true
        ];
    }

    if ($couponMode == 'available') {
        $msg['embeds'][0]['fields'][] = [
            "name" => "Claimed coupon",
            "value" => $claimedCoupons,
            "inline" => true
        ];
    }

    if ($couponMode == 'all') {
        $msg['embeds'][0]['fields'][] = [
            "name" => "Available coupon",
            "value" => $availableCoupons,
            "inline" => true
        ];

        $msg['embeds'][0]['fields'][] = [
            "name" => "Claimed coupon",
            "value" => $claimedCoupons,
            "inline" => true
        ];
    }


    // Sending the message via webhook
    $headers = array('Content-Type: application/json');

    foreach ($webhookList as $webhook) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $webhook);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($msg));
        $response = curl_exec($ch);
        curl_close($ch);
        sleep(1);
    }
}

header('Location: ./settings.php');