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

            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Coupon</th>
                        <th>Expiration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $couponListing = getFirstCoupons("./data/couponList.json", 100);

                    foreach ($couponListing as $coupon) {
                        if (couponExists($coupon['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")) {
                            echo '<tr>';
                            $couponClaimType = "claim"; // Claim
                        } elseif (isDateFuture($coupon['expiration'])) {
                            echo '<tr data-coupon-name="' . $coupon['name'] . '">';
                            $couponClaimType = "available"; // Available
                        } else {
                            echo '<tr>';
                            $couponClaimType = "expiration"; // Expired
                        }

                        $coupon['type'] == 'Ruby' || $coupon['type'] == 'Rubies' ? $couponType = "ruby" : NULL;
                        $coupon['type'] == 'Stamina' ? $couponType = "stamina" : NULL;
                        $coupon['type'] != 'Ruby' && $coupon['type'] != 'Rubies' && $coupon['type'] != 'Stamina' ? $couponType = "other" : NULL;

                        // Type
                        echo '<td class="t-' . $couponClaimType . ' t-' . $couponType . '">';
                        echo $couponType == 'ruby' ? '<svg class="type-ruby" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M16.445 3h-8.89c-.345 0-.666.178-.849.47L3.25 9h17.5l-3.456-5.53a1.003 1.003 0 0 0-.849-.47zM11.26 21.186a1 1 0 0 0 1.48 0L22 11H2l9.26 10.186z"></path></svg>' : NULL;
                        echo $couponType == 'stamina' ? '<svg class="type-stamina" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20.98 11.802a.995.995 0 0 0-.738-.771l-6.86-1.716 2.537-5.921a.998.998 0 0 0-.317-1.192.996.996 0 0 0-1.234.024l-11 9a1 1 0 0 0 .39 1.744l6.719 1.681-3.345 5.854A1.001 1.001 0 0 0 8 22a.995.995 0 0 0 .6-.2l12-9a1 1 0 0 0 .38-.998z"></path></svg>' : NULL;                        // Coupon
                        echo $couponType != 'ruby' && $couponType != 'stamina' ? '<svg class="type-other" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M10 10h4v4h-4zm0-6h4v4h-4zm0 12h4v4h-4z"></path></svg>' : NULL;                        // Expiration
                        echo $coupon['description'];
                        echo '</td>';

                        // Coupon
                        echo '<td class="t-' . $couponClaimType . '">';
                        echo $coupon['name'];
                        echo '</td>';

                        // Expiration
                        echo '<td class="t-' . $couponClaimType . '">';
                        echo $coupon['expiration'];
                        echo '</td>';

                        // end
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>


        </div>

    </main>

</body>
<!-- script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('tr[data-coupon-name]');
        const processedCoupons = new Set(); // Ensemble pour stocker les coupons déjà traités

        tableRows.forEach(function(row) {
            row.addEventListener('click', function() {
                const couponName = this.getAttribute('data-coupon-name');

                // Vérifier si le coupon a déjà été traité
                if (!processedCoupons.has(couponName)) {
                    const tableCells = this.querySelectorAll('td');

                    tableCells.forEach(function(cell) {
                        cell.classList.remove('t-available');
                        cell.classList.add('t-claim');
                    });

                    const xhr = new XMLHttpRequest();
                    const url = `./src/php/update/coupon-claim.php?name=${couponName}`;
                    xhr.open('GET', url, true);
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            console.log(xhr.responseText);
                        }
                    };
                    xhr.send();

                    // Ajouter le coupon traité à l'ensemble
                    processedCoupons.add(couponName);
                }
            });
        });
    });
</script>

</html>