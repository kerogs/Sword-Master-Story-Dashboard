<?php

require_once './src/php/session.php';

$couponPath = './data/couponList.json';
if (file_exists($couponPath)) {
    $lastModified = filemtime($couponPath);
    $currentTime = time();
    $difference = $currentTime - $lastModified;
    if ($difference < 900) { // 15 minutes en secondes
        echo "Les informations ont été récupérées il y a moins de 15 minutes. Pas besoin de les récupérer à nouveau.";
    } else {
        require_once './src/php/update/coupons-checker.php';
    }

    $lastCoupon = extractCoupons('./data/couponList.json', 1, true);
    $lastCouponName = $lastCoupon[0]['name'];
    $lastCouponDate = $lastCoupon[0]['expiration'];
    couponExists($lastCouponName, "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json") ? $lastCouponClaimCheck = "claimed" : $lastCouponClaimCheck = "code";
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
            <div class="main-grid">
                <div class="last-couponUsed">
                    <div class="name">
                        Last claim
                    </div>

                    <div class="ccenter">
                        <p><?= getLastCoupon("./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")['name'] ?></p>
                    </div>
                </div>
                <div class="last-coupon imp">
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
                                echo '<li><span data-coupon-name="' . $coupon['name'] . '" class="code">' . $coupon['name'] . '</span> <span class="date">' . $coupon['description'] . '</span></li>';
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
                <div class="last-update" style="background-image: url('./src/img/background/SwordMaster-Story-image.png');">
                    <div class="filter">
                        <div class="img">
                            <img src="./src/img/character/banner_ryu.png" alt="" class="filter">
                        </div>

                        <div class="ccenter">
                            <h3>Last login</h3>
                            <p>19 february 2019</p>
                        </div>
                    </div>
                </div>
                <div class="total-couponUsed">
                    <div class="name">
                        Last coupon
                    </div>

                    <div class="ccenter">
                        <p class="<?= $lastCouponClaimCheck ?>" data-coupon-name="<?= $lastCouponName ?>"><?= $lastCouponName ?></p>
                    </div>

                    <div class="footer">
                        <?= $lastCouponDate ?>
                    </div>
                </div>
                <div class="total-couponNotClaim">
                    <h3>Random Tips</h3>
                    <div class="ccenter">
                        <p>bingo bango bongo bish bash bosh</p>
                    </div>
                    <div class="footer">-A CSGO PRO PLAYER</div>
                </div>
                <div class="total">
                    <div class="name">Total coupon claim</div>
                    <div class="ccenter">
                        <p class="number"><?= countNames(file_get_contents("./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")) ?></p>
                    </div>
                </div>
                <div class="info">
                    <div class="name">Coupon available</div>
                    <div class="ccenter">
                        <p class="number">12</p>
                    </div>
                </div>
            </div>

            <pre style="color:orange;">
<?php
print_r(extractCoupons('./data/couponList.json', 1, false));
?>
            </pre>
            <p style="color:red">
                <?= extractCoupons('./data/couponList.json', 1, true)[0]['name'] ?>
            </p>
        </div>

    </main>

</body>
<!-- script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const codeElements = document.querySelectorAll('.code');

        codeElements.forEach(function(codeElement) {
            codeElement.addEventListener('click', function() {
                if (!this.classList.contains('claimed')) {
                    const couponName = this.getAttribute('data-coupon-name');

                    const xhr = new XMLHttpRequest();
                    const url = `./src/php/update/coupon-claim.php?name=${couponName}`;
                    xhr.open('GET', url, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText);

                            codeElement.classList.add('claimed');

                            codeElement.classList.remove('code');

                        }
                    };
                    xhr.send();
                }
            });
        });
    });
</script>

</html>