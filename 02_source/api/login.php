<?php
include "db.php";
$login = $pdo->query("SELECT * FROM `admin` WHERE `username` = '{$_POST['username']}' AND `password` = '{$_POST['password']}'")->fetchColumn();
echo $login;
if ($login > 0) {
    $_SESSION['admin'] = true;
}
