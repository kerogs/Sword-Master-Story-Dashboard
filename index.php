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
</head>

<body>

    <main>

        <!-- navigation -->
        <div class="nav">
            <nav>
                <ul>
                    <a href="./">
                        <li>Sword Master Story</li>
                    </a>
                    <hr>
                    <a href="">
                        <li class="list active">
                            <svg style="fill:#5650ca;" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path
                                    d="M4 13h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1zm-1 7a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-4a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v4zm10 0a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v7zm1-10h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1h-6a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1z">
                                </path>
                            </svg>
                            Dashboard
                        </li>
                    </a>
                    <!-- Settings -->
                    <a href="./settings.php">
                        <li class="list">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                style="fill:#5650ca;">
                                <path
                                    d="m2.344 15.271 2 3.46a1 1 0 0 0 1.366.365l1.396-.806c.58.457 1.221.832 1.895 1.112V21a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-1.598a8.094 8.094 0 0 0 1.895-1.112l1.396.806c.477.275 1.091.11 1.366-.365l2-3.46a1.004 1.004 0 0 0-.365-1.366l-1.372-.793a7.683 7.683 0 0 0-.002-2.224l1.372-.793c.476-.275.641-.89.365-1.366l-2-3.46a1 1 0 0 0-1.366-.365l-1.396.806A8.034 8.034 0 0 0 15 4.598V3a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v1.598A8.094 8.094 0 0 0 7.105 5.71L5.71 4.904a.999.999 0 0 0-1.366.365l-2 3.46a1.004 1.004 0 0 0 .365 1.366l1.372.793a7.683 7.683 0 0 0 0 2.224l-1.372.793c-.476.275-.641.89-.365 1.366zM12 8c2.206 0 4 1.794 4 4s-1.794 4-4 4-4-1.794-4-4 1.794-4 4-4z">
                                </path>
                            </svg>
                            Settings
                        </li>
                    </a>
                    <a href="https://www.reddit.com/r/SwordMaster_Story/" target="_blank">
                        <li class="list">
                            <svg style="fill:#5650ca;" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <circle cx="9.67" cy="13" r="1.001"></circle>
                                <path
                                    d="M14.09 15.391A3.28 3.28 0 0 1 12 16a3.271 3.271 0 0 1-2.081-.63.27.27 0 0 0-.379.38c.71.535 1.582.809 2.471.77a3.811 3.811 0 0 0 2.469-.77v.04a.284.284 0 0 0 .006-.396.28.28 0 0 0-.396-.003zm.209-3.351a1 1 0 0 0 0 2l-.008.039c.016.002.033 0 .051 0a1 1 0 0 0 .958-1.038 1 1 0 0 0-1.001-1.001z">
                                </path>
                                <path
                                    d="M12 2C6.479 2 2 6.477 2 12c0 5.521 4.479 10 10 10s10-4.479 10-10c0-5.523-4.479-10-10-10zm5.859 11.33c.012.146.012.293 0 .439 0 2.24-2.609 4.062-5.83 4.062s-5.83-1.82-5.83-4.062a2.681 2.681 0 0 1 0-.439 1.46 1.46 0 0 1-.455-2.327 1.458 1.458 0 0 1 2.063-.063 7.145 7.145 0 0 1 3.899-1.23l.743-3.47v-.004A.313.313 0 0 1 12.82 6l2.449.49a1.001 1.001 0 1 1-.131.61L13 6.65l-.649 3.12a7.123 7.123 0 0 1 3.85 1.23 1.46 1.46 0 0 1 2.469 1c.01.563-.307 1.08-.811 1.33z">
                                </path>
                            </svg>
                            Reddit
                            <svg class="linkext" style="fill:#5650ca;" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3z"></path>
                                <path
                                    d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7z">
                                </path>
                            </svg>
                        </li>
                    </a>
                    <a href="" target="_blank">
                        <li class="list">
                            <svg style="fill:#5650ca;" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.026 2c-5.509 0-9.974 4.465-9.974 9.974 0 4.406 2.857 8.145 6.821 9.465.499.09.679-.217.679-.481 0-.237-.008-.865-.011-1.696-2.775.602-3.361-1.338-3.361-1.338-.452-1.152-1.107-1.459-1.107-1.459-.905-.619.069-.605.069-.605 1.002.07 1.527 1.028 1.527 1.028.89 1.524 2.336 1.084 2.902.829.091-.645.351-1.085.635-1.334-2.214-.251-4.542-1.107-4.542-4.93 0-1.087.389-1.979 1.024-2.675-.101-.253-.446-1.268.099-2.64 0 0 .837-.269 2.742 1.021a9.582 9.582 0 0 1 2.496-.336 9.554 9.554 0 0 1 2.496.336c1.906-1.291 2.742-1.021 2.742-1.021.545 1.372.203 2.387.099 2.64.64.696 1.024 1.587 1.024 2.675 0 3.833-2.33 4.675-4.552 4.922.355.308.675.916.675 1.846 0 1.334-.012 2.41-.012 2.737 0 .267.178.577.687.479C19.146 20.115 22 16.379 22 11.974 22 6.465 17.535 2 12.026 2z">
                                </path>
                            </svg>
                            Github
                            <svg class="linkext" style="fill:#5650ca;" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path d="m13 3 3.293 3.293-7 7 1.414 1.414 7-7L21 11V3z"></path>
                                <path
                                    d="M19 19H5V5h7l-2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-5l-2-2v7z">
                                </path>
                            </svg>
                        </li>
                    </a>
                    <div class="creator">
                        By <span class="blue">Kerogs</span>, with <span class="red">love</span>
                        <br>
                        <a href="">Github : <?= $servData['version'] ?></a>
                    </div>
                </ul>
            </nav>
        </div>

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