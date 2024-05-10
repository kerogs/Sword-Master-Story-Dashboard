<?php

require_once './src/php/session.php';

$couponPath = './data/couponList.json';
if (file_exists($couponPath)) {
    $lastModified = filemtime($couponPath);
    $currentTime = time();
    $difference = $currentTime - $lastModified;
    if ($difference < 1200) {
        // echo "Les informations ont été récupérées il y a moins de 15 minutes. Pas besoin de les récupérer à nouveau.";
    } else {
        require_once './src/php/update/coupons-checker.php';
    }

    $lastCoupon = extractCoupons('./data/couponList.json', 1, true);
    $lastCouponName = $lastCoupon[0]['name'];
    $lastCouponDate = $lastCoupon[0]['expiration'];
    couponExists($lastCouponName, "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json") ? $lastCouponClaimCheck = "claimed" : $lastCouponClaimCheck = "code";

    $couponAvailableNow = 0;
    /**
     * ! You don't need to have more than 20 coupons, as there are usually 
     * ! no more than 10 available at any one time.
     */
    foreach (extractCoupons('./data/couponList.json', 20, true) as $couponAvailable) {
        if (isDateFuture($couponAvailable['expiration']) && !couponExists($couponAvailable['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")) $couponAvailableNow++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sword Master Story</title>
    <link rel="stylesheet" href="./src/css/style.css">

    <?php require_once './src/php/head.php' ?>
</head>

<body>

    <div class="playerToken"><?= $_COOKIE['sms3_token'] ?></div>

    <main>

        <!-- navigation -->
        <?php

        require_once './src/php/header.php';

        ?>

        <!-- content -->
        <div class="content">
            <div class="working_progress">
                <h2>This section is still under construction.</h2>
            </div>
        </div>

    </main>

</body>

</html>