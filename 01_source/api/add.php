<?php
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case 'bus':
        $pdo->query("INSERT INTO `bus`(`plate`, `time`) VALUES ('{$_POST['plate']}','{$_POST['time']}')");
        break;
    
    case 'station':
        $rank = $pdo->query("SELECT MAX(`rank`) FROM `station`")->fetchColumn() + 1;
        $pdo->query("INSERT INTO `station`(`name`, `need`, `stop`,`rank`) VALUES ('{$_POST['name']}','{$_POST['need']}','{$_POST['stop']}','$rank')");
        break;
}
?>