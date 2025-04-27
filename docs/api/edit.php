<?php
include "db.php";

$action = $_POST['action'];
switch ($action) {
    case 'bus':
        $pdo->query("UPDATE `bus` SET `time`='{$_POST['time']}' WHERE `id` = '{$_POST['id']}'");
        break;
    
    case 'station':
        $pdo->query("UPDATE `station` SET `need`='{$_POST['need']}',`stop`='{$_POST['stop']}' WHERE `id` = '{$_POST['id']}'");
        break;
    case 'form':
        $pdo->query("UPDATE `form` SET `form`='{$_POST['form']}' WHERE 1");
        break;
    case 'basic':
        $pdo->query("UPDATE `basic` SET `start`='{$_POST['start']}',`end`='{$_POST['end']}' WHERE 1");
        if ($_POST['end'] > $_POST['now'] && $_POST['start'] > $_POST['now']) {
            $pdo->query("UPDATE `form` SET `form`= 1");
        }
        
        break;
}
?>