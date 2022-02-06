<?php

require "../dbBroker.php";
require "../model/prijava.php";

session_start();

if (
    isset($_POST['naziv']) && isset($_POST['lokacija'])
    && isset($_POST['datum']) && isset($_POST['vreme'])
) {
    $prijava = new Prijava(null, $_POST['naziv'], $_POST['lokacija'], $_POST['datum'], $_POST['vreme'], $_SESSION['user_id']);
    $status = Prijava::add($prijava, $conn);

    if ($status) {
        echo "Success";
    } else {
        echo $status;
        echo "Failed";
    }
}
