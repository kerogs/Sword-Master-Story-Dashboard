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

        <!-- content -->
        <div class="content">
            <div class="main-grid">
                <div class="last-discountUsed">
                    <div class="name">
                        Last claim
                    </div>

                    <div class="ccenter">
                        <p>KS39G!2014</p>
                    </div>

                    <div class="footer">
                        13 February 2019
                    </div>
                </div>
                <div class="last-discount imp">
                    <div class="name">
                        Last Discount
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            style="fill:green">
                            <path
                                d="m10 10.414 4 4 5.707-5.707L22 11V5h-6l2.293 2.293L14 11.586l-4-4-7.707 7.707 1.414 1.414z">
                            </path>
                        </svg>
                    </div>
                    <ul>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                        <li><span class="code">KS39G!2014</span> <span class="date">13 February 2019</span></li>
                    </ul>
                </div>
                <div class="last-update"
                    style="background-image: url('./src/img/background/SwordMaster-Story-image.png');">
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
                <div class="total-discountUsed">
                    <div class="name">
                        Last Discount
                    </div>

                    <div class="ccenter">
                        <p class="code">KS39G!2014</p>
                    </div>

                    <div class="footer">
                        13 February 2019
                    </div>
                </div>
                <div class="total-discountNotClaim">
                    <h3>Random Tips</h3>
                    <div class="ccenter">
                        <p>bingo bango bongo bish bash bosh</p>
                    </div>
                    <div class="footer">-A CSGO PRO PLAYER</div>
                </div>
                <div class="total">
                    <div class="name">Total discount claim</div>
                    <div class="ccenter">
                        <p class="number">58</p>
                    </div>
                </div>
                <div class="info">
                    <div class="name">Discount available</div>
                    <div class="ccenter">
                        <p class="number">12</p>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>

</html>