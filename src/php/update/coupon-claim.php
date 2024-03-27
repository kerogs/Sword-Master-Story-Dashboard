<?php

if(isset($_GET['name'])) {
    $couponName = $_GET['name'];
} else {
    die('Erreur : Paramètre "name" manquant dans la requête.');
}

if(isset($_COOKIE['sms3_token'])) {
    $sms3_token = $_COOKIE['sms3_token'];
} else {
    die('Erreur : Cookie "sms3_token" non défini.');
}

$directoryPath = "../../../data/account/$sms3_token";

if(!is_dir($directoryPath)) {
    die('Erreur : Répertoire inexistant.');
}

$filePath = "$directoryPath/couponClaim.json";

if(file_exists($filePath)) {
    $currentData = json_decode(file_get_contents($filePath), true);
} else {
    $currentData = array();
}

$currentData[] = array("name" => $couponName);

$jsonEncode = json_encode($currentData, JSON_PRETTY_PRINT);

if(file_put_contents($filePath, $jsonEncode) !== false) {
    echo "Données écrites avec succès dans $filePath";
} else {
    echo "Erreur lors de l'écriture dans $filePath";
}



?>
coupon claim : <?= $couponName ?>