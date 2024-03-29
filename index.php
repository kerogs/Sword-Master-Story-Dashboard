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
    foreach(extractCoupons('./data/couponList.json', 20, true) as $couponAvailable){
        if(isDateFuture($couponAvailable['expiration']) && !couponExists($couponAvailable['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")) $couponAvailableNow++;
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

<body class="animation-background">

    <div class="playerToken"><?= $_COOKIE['sms3_token'] ?></div>

    <main>

        <!-- navigation -->
        <?php

        require_once './src/php/header.php';

        ?>

        <!-- content -->
        <div class="content">
            <div class="main-grid">
                <div class="last-couponUsed animation-popup" style="animation-delay: .4s;">
                    <div class="name">
                        Last claim
                    </div>

                    <div class="ccenter">
                        <p id="lastClaim"><?= getLastCoupon("./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")['name'] ?></p>
                    </div>
                </div>
                <div class="last-coupon imp animation-popup">
                    <div class="name">
                        Last coupon
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:green">
                            <path d="m10 10.414 4 4 5.707-5.707L22 11V5h-6l2.293 2.293L14 11.586l-4-4-7.707 7.707 1.414 1.414z">
                            </path>
                        </svg>
                    </div>
                    <ul>
                        <?php
                        $couponListing = getFirstCoupons("./data/couponList.json", 9);
                        foreach ($couponListing as $coupon) {
                            if (couponExists($coupon['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")) {
                                echo '<li><span class="claimed">' . $coupon['name'] . '</span> <span class="date">' . $coupon['description'] . '</span></li>';
                            } else {
                                if(isDateFuture($coupon['expiration'])){
                                    echo '<li title="'.$coupon['expiration'].'"><span data-coupon-name="' . $coupon['name'] . '" class="code">' . $coupon['name'] . '</span> <span class="date">' . $coupon['description'] . '</span></li>';
                                } else{
                                    echo '<li title="'.$coupon['expiration'].' [expired]"><span class="expiration">' . $coupon['name'] . '</span> <span class="date">' . $coupon['description'] . '</span></li>';
                                }
                            }
                        }

                        ?>
                        <!-- <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li> -->
                    </ul>
                </div>
                <div class="last-update animation-slideFromRight" style="animation-delay: .7s; background-image: url('./src/img/background/<?= $currentDataArray['theme']['bannerBackground'] ?>');">
                    <div class="filter">
                        <div class="img">
                            <img src="./src/img/character/<?= $currentDataArray['theme']['bannerCharacter'] ?>" alt="" class="filter">
                        </div>

                        <div class="ccenter">
                            <h3>Last login</h3>
                            <p><?= $lastLoginBefore ?></p>
                        </div>
                    </div>
                </div>
                <div class="total-couponUsed animation-popup" style="animation-delay: .6s;">
                    <div class="name">
                        Last available
                    </div>

                    <div class="ccenter">
                        <p class="<?= $lastCouponClaimCheck ?>" data-coupon-name="<?= $lastCouponName ?>"><?= $lastCouponName ?></p>
                    </div>

                    <div class="footer">
                        <?= $lastCouponDate ?>
                    </div>
                </div>
                <div class="total-couponNotClaim animation-popup" style="animation-delay: .2s;">
                    <h3>Random Tips</h3>
                    <div class="ccenter">
                        <p>bingo bango bongo bish bash bosh</p>
                    </div>
                    <div class="footer">-A CSGO PRO PLAYER</div>
                </div>
                <div class="total animation-popup" style="animation-delay: 1s;">
                    <div class="name">Total coupon claim</div>
                    <div class="ccenter">
                        <p class="number" id="numberClaim"><?= countNames(file_get_contents("./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")) ?></p>
                    </div>
                </div>
                <div class="info animation-popup" style="animation-delay: .8s;">
                    <div class="name">Coupon available</div>
                    <div class="ccenter">
                        <p class="number" id="numberAvailable"><?= $couponAvailableNow ?></p>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>
<!-- script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const codeElements = document.querySelectorAll('.code');

    const claimedCoupons = new Set();

    codeElements.forEach(function(codeElement) {
        codeElement.addEventListener('click', function() {
            if (!this.classList.contains('claimed')) {
                const couponName = this.getAttribute('data-coupon-name');

                if (!claimedCoupons.has(couponName)) {
                    const xhr = new XMLHttpRequest();
                    const url = `./src/php/update/coupon-claim.php?name=${couponName}`;
                    xhr.open('GET', url, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText);

                            const numberClaimElement = document.getElementById('numberClaim');
                            const numberAvailableElement = document.getElementById('numberAvailable');
                            const lastClaimElement = document.getElementById('lastClaim');

                            if (numberClaimElement && numberAvailableElement && lastClaimElement) {
                                numberClaimElement.textContent = parseInt(numberClaimElement.textContent) + 1;
                                numberAvailableElement.textContent = parseInt(numberAvailableElement.textContent) - 1;
                                lastClaimElement.textContent = couponName;
                            }

                            codeElements.forEach(function(element) {
                                if (element.getAttribute('data-coupon-name') === couponName) {
                                    element.classList.add('claimed');
                                    element.classList.remove('code');
                                }
                            });

                            claimedCoupons.add(couponName);
                        }
                    };
                    xhr.send();
                }
            }
        });
    });
});

</script>

</html>