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
    case 'allocate':
        $num = 3;
        $total = $pdo->query("SELECT COUNT(*) FROM `response`")->fetchColumn();
        $count = ceil($total / $num);
        for ($i=0; $i < $count; $i++) { 
            $start = $i * $num;
            $bus = "AUTO-".sprintf("%04d",rand(1,9999));
            $users = $pdo->query("SELECT * FROM `response` LIMIT $start,$num")->fetchAll();
            foreach ($users as $user) {
                $pdo->exec("UPDATE `response` SET `bus` = '$bus' WHERE `id` = '{$user['id']}'");              
            }
        }
        break;
}
?>