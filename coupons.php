<?php

require_once './src/php/session.php';

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

    <main>

        <!-- navigation -->
        <?php

        require_once './src/php/header.php';

        ?>
        <div class="content coupon">
            <div class="stats">
                <!-- database coupon -->
                <!-- total claim -->
                <!-- total disponible -->

                <div class="stats__box">
                    Database coupon
                </div>
                <div class="stats__box">
                    Total Claim
                </div>
                <div class="stats__box">
                    Total Available
                </div>
            </div>
            <div class="list">
                <!-- DataBaseCoupon -->
                <ul>
                    <li>
                        <?php

                        $couponListing = getFirstCoupons("./data/couponList.json", 100);

                        foreach ($couponListing as $coupon) {
                            $claimed = couponExists($coupon['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json");

                            if ($claimed) {
                                echo '<li>';
                                if ($coupon['type'] == 'Ruby') {
                                    echo '<svg class="type-ruby" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.445 3h-8.89c-.345 0-.666.178-.849.47L3.25 9h17.5l-3.456-5.53a1.003 1.003 0 0 0-.849-.47zM11.26 21.186a1 1 0 0 0 1.48 0L22 11H2l9.26 10.186z"></path></svg>';
                                } elseif ($coupon['type'] == 'Stamina') {
                                    echo '<svg class="type-stamina" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.98 11.802a.995.995 0 0 0-.738-.771l-6.86-1.716 2.537-5.921a.998.998 0 0 0-.317-1.192.996.996 0 0 0-1.234.024l-11 9a1 1 0 0 0 .39 1.744l6.719 1.681-3.345 5.854A1.001 1.001 0 0 0 8 22a.995.995 0 0 0 .6-.2l12-9a1 1 0 0 0 .38-.998z"></path></svg>';
                                } else {
                                    echo '<svg class="type-other" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm0-6h4v4h-4zm0 12h4v4h-4z"></path></svg>';
                                }
                                echo '<span class="type-' . strtolower($coupon['type']) . '">' . $coupon['description'] . '</span>';
                                echo '<span class="claimed">[ ' . $coupon['name'] . ' ]</span>';
                                echo '<span>' . $coupon['expiration'] . '</span>';
                                echo '</li>';
                            } else {
                                $expired = !isDateFuture($coupon['expiration']);

                                if (!$expired) {
                                    echo '<li>';
                                    if ($coupon['type'] == 'Ruby') {
                                        echo '<svg class="type-ruby" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.445 3h-8.89c-.345 0-.666.178-.849.47L3.25 9h17.5l-3.456-5.53a1.003 1.003 0 0 0-.849-.47zM11.26 21.186a1 1 0 0 0 1.48 0L22 11H2l9.26 10.186z"></path></svg>';
                                    } elseif ($coupon['type'] == 'Stamina') {
                                        echo '<svg class="type-stamina" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.98 11.802a.995.995 0 0 0-.738-.771l-6.86-1.716 2.537-5.921a.998.998 0 0 0-.317-1.192.996.996 0 0 0-1.234.024l-11 9a1 1 0 0 0 .39 1.744l6.719 1.681-3.345 5.854A1.001 1.001 0 0 0 8 22a.995.995 0 0 0 .6-.2l12-9a1 1 0 0 0 .38-.998z"></path></svg>';
                                    } else {
                                        echo '<svg class="type-other" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm0-6h4v4h-4zm0 12h4v4h-4z"></path></svg>';
                                    }
                                    echo '<span class="type-' . strtolower($coupon['type']) . '">' . $coupon['description'] . '</span>';
                                    echo '<span data-coupon-name="' . $coupon['name'] . '" class="code">[ ' . $coupon['name'] . ' ]</span>';
                                    echo '<span>' . $coupon['expiration'] . '</span>';
                                    echo '</li>';
                                } else {
                                    echo '<li>';
                                    if ($coupon['type'] == 'Ruby') {
                                        echo '<svg class="type-ruby" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.445 3h-8.89c-.345 0-.666.178-.849.47L3.25 9h17.5l-3.456-5.53a1.003 1.003 0 0 0-.849-.47zM11.26 21.186a1 1 0 0 0 1.48 0L22 11H2l9.26 10.186z"></path></svg>';
                                    } elseif ($coupon['type'] == 'Stamina') {
                                        echo '<svg class="type-stamina" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.98 11.802a.995.995 0 0 0-.738-.771l-6.86-1.716 2.537-5.921a.998.998 0 0 0-.317-1.192.996.996 0 0 0-1.234.024l-11 9a1 1 0 0 0 .39 1.744l6.719 1.681-3.345 5.854A1.001 1.001 0 0 0 8 22a.995.995 0 0 0 .6-.2l12-9a1 1 0 0 0 .38-.998z"></path></svg>';
                                    } else {
                                        echo '<svg class="type-other" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm0-6h4v4h-4zm0 12h4v4h-4z"></path></svg>';
                                    }
                                    echo '<span class="type-' . strtolower($coupon['type']) . '">' . $coupon['description'] . '</span>';
                                    echo '<span class="expiration">[ ' . $coupon['name'] . ' ]</span>';
                                    echo '<span>' . $coupon['expiration'] . '</span>';
                                    echo '</li>';
                                }
                            }
                        }

                        ?>

                </ul>
                <!-- TotalClaim -->
                <ul>
                    <?php

                    $couponListing = getFirstCoupons("./data/couponList.json", 20);

                    foreach ($couponListing as $coupon) {
                        $claimed = couponExists($coupon['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json");

                        if ($claimed) {
                            echo '<li>';
                            if ($coupon['type'] == 'Ruby') {
                                echo '<svg class="type-ruby" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.445 3h-8.89c-.345 0-.666.178-.849.47L3.25 9h17.5l-3.456-5.53a1.003 1.003 0 0 0-.849-.47zM11.26 21.186a1 1 0 0 0 1.48 0L22 11H2l9.26 10.186z"></path></svg>';
                            } elseif ($coupon['type'] == 'Stamina') {
                                echo '<svg class="type-stamina" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.98 11.802a.995.995 0 0 0-.738-.771l-6.86-1.716 2.537-5.921a.998.998 0 0 0-.317-1.192.996.996 0 0 0-1.234.024l-11 9a1 1 0 0 0 .39 1.744l6.719 1.681-3.345 5.854A1.001 1.001 0 0 0 8 22a.995.995 0 0 0 .6-.2l12-9a1 1 0 0 0 .38-.998z"></path></svg>';
                            } else {
                                echo '<svg class="type-other" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm0-6h4v4h-4zm0 12h4v4h-4z"></path></svg>';
                            }
                            echo '<span class="type-' . strtolower($coupon['type']) . '">' . $coupon['description'] . '</span>';
                            echo '<span class="claimed">[ ' . $coupon['name'] . ' ]</span>';
                            echo '<span>' . $coupon['expiration'] . '</span>';
                            echo '</li>';
                        }
                    }

                    ?>
                </ul>
                <!-- Total Available -->
                <ul>
                    <?php

                    $couponListing = getFirstCoupons("./data/couponList.json", 20);

                    foreach ($couponListing as $coupon) {
                        $claimed = couponExists($coupon['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json");

                        if (!$claimed && isDateFuture($coupon['expiration'])) {
                            echo '<li>';
                            if ($coupon['type'] == 'Ruby') {
                                echo '<svg class="type-ruby" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.445 3h-8.89c-.345 0-.666.178-.849.47L3.25 9h17.5l-3.456-5.53a1.003 1.003 0 0 0-.849-.47zM11.26 21.186a1 1 0 0 0 1.48 0L22 11H2l9.26 10.186z"></path></svg>';
                            } elseif ($coupon['type'] == 'Stamina') {
                                echo '<svg class="type-stamina" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.98 11.802a.995.995 0 0 0-.738-.771l-6.86-1.716 2.537-5.921a.998.998 0 0 0-.317-1.192.996.996 0 0 0-1.234.024l-11 9a1 1 0 0 0 .39 1.744l6.719 1.681-3.345 5.854A1.001 1.001 0 0 0 8 22a.995.995 0 0 0 .6-.2l12-9a1 1 0 0 0 .38-.998z"></path></svg>';
                            } else {
                                echo '<svg class="type-other" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm0-6h4v4h-4zm0 12h4v4h-4z"></path></svg>';
                            }
                            echo '<span class="type-' . strtolower($coupon['type']) . '">' . $coupon['description'] . '</span>';
                            echo '<span class="code">[ ' . $coupon['name'] . ' ]</span>';
                            echo '<span>' . $coupon['expiration'] . '</span>';
                            echo '</li>';
                        }
                    }

                    ?>

                </ul>
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