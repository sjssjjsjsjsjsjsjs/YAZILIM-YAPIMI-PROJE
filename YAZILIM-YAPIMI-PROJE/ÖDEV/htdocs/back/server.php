<?php
session_start();

require_once "database.php";
require_once "helper.php";

if ($_GET["r"] == "register") {
    $db = new Database("db_kullanicilar");

    if (!$db->checkData(["kadi", $_GET["id"]])) {
        $db->addTable([$_GET["id"], createPassword($_GET["pw"])]);
        echo "1:Kayıt Başarılı.";
    } else {
        echo "0:Bu öğrenci numarası kayıtlı.";
    }
} elseif ($_GET["r"] == "login") {
    $db = new Database("db_kullanicilar");

    if ($db->checkData(["kadi", $_GET["id"]]) and checkPassword($_GET["pw"], $db->getTable(["kadi", $_GET["id"]])["sifre"] ) ) {
        $_SESSION["uid"] = $db->getTable(["kadi", $_GET["id"]])["id"];
        echo "1:Giriş Başarılı.";
    } else {
        echo "0:Bu öğrenci numarası bulunamadı.";
    }
} elseif ($_GET["r"] == "forgotpw") {
    $db = new Database("db_kullanicilar");

    if ( $db->checkData(["kadi", $_GET["id"]]) ) {
        echo "1:Şifre sıfırlama isteği başarıyla e-posta adresinize gönderildi.";
    } else {
        echo "0:Bu öğrenci numarası bulunamadı.";
    }
} elseif ($_GET["r"] == "logout") {
    session_destroy();
} elseif ($_GET["r"] == "updateProfile") {
    $db = new Database("db_kullanicilar");
    $update["isim"] = $_GET["isim"];
    if (!empty($_GET["sifre"])) {
        $update["sifre"] = createPassword($_GET["sifre"]);
    }
    $db->updateTable($update, "kadi = ".$_GET["kadi"]);
}
