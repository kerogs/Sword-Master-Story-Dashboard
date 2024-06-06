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

        <div class="settings">
            <h2>Send unused coupon to discord</h2>
            <div class="codelist">
                <p>
                    <?php

                    $claimedBool = false;
                    $unclaimedBool = false;

                    // show all code and compare with used code, and show only unused code
                    $couponListing = getFirstCoupons("./data/couponList.json", 100);

                    foreach ($couponListing as $coupon) {
                        if (couponExists($coupon['name'], "./data/account/" . $_COOKIE['sms3_token'] . "/couponClaim.json")) {
                            echo '<span class="claimed">' . $coupon['name'] . '</span>, ';
                            $claimedBool = true;
                        } elseif (isDateFuture($coupon['expiration'])) {
                            echo '<span class="available">' . $coupon['name'] . '</span>, ';
                            $unclaimedBool = true;
                        }
                    }

                    ?>
                </p>
            </div>
            <form action="settings-send.php" method="post">
                <div class="flex">
                    <select name="couponMode" id="">
                        <!-- <option value="unclaimed">Unclaimed</option> -->
                        <!-- <option value="available">Claimed</option> -->
                        <!-- <option selected value="all">All</option> -->
                        <?php

                        echo $unclaimedBool ? '<option value="unclaimed">Unclaimed</option>' : null;
                        echo $claimedBool ? '<option value="available">Claimed</option>' : null;
                        echo $unclaimedBool && $claimedBool ? '<option selected value="all">All</option>' : null;

                        ?>
                    </select>
                    <input type="url" name="webhook_url" id="" list="webhook" placeholder="Webhook_url, webhook_url, webhook_url" value="<?= $_COOKIE['webhook_url'] ?>" required>
                    <datalist id="webhook">
                        <?php

                        $webhookList = explode(',', str_replace(" ", "", $_COOKIE['webhook_url']));
                        foreach ($webhookList as $webhook) {
                            echo '<option value="' . basename($webhook) . '"></option>';
                        }

                        ?>
                    </datalist>
                    <input type="submit" value="Send">
                </div>
            </form>
            <blockquote>If you want to use several webhooks at the same time, you can separate the links with a ",". Note that a delay of 1s is set for each webhook.</blockquote>
        </div>

    </main>

</body>

</html>