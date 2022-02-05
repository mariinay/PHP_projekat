<?php



require "../dbBroker.php";
require "../model/prijava.php";

if (
    isset($_POST['teretana']) && isset($_POST['lokacija'])
    && isset($_POST['datum']) && isset($_POST['vreme'])
) {
    $prijava = new Prijava(null, $_POST['teretana'], $_POST['lokacija'], $_POST['datum'], $_POST['vreme']);
    $status = Prijava::update($prijava, $conn);

    if ($status) {
        echo "Success";
    } else {
        echo $status;
        echo "Failed";
    }
}
