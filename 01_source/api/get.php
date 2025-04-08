<?php
include "db.php";
$action = $_POST['action'];

switch ($action) {
    case 'bus':
        $bus = $pdo->query("SELECT * FROM `bus`")->fetchAll();
        echo json_encode($bus);
        break;

    case 'station':
        $station = $pdo->query("SELECT * FROM `station`")->fetchAll();
        echo json_encode($station);
        break;

    case 'map':
        $stations = $pdo->query("SELECT * FROM `station` ORDER BY `rank`")->fetchAll(PDO::FETCH_ASSOC);


        foreach ($stations as $key => $station) {
            $prev = $pdo->query("SELECT SUM(`need` + `stop`) FROM `station` WHERE `rank` < {$station['rank']}")->fetchColumn();
            $arrive = $prev + $station['need'];
            $leave = $arrive + $station['stop'];
            $bus = $pdo->query("SELECT * FROM `bus` WHERE `time` <= $leave ORDER BY `time` DESC")->fetch(PDO::FETCH_ASSOC);
                
            if (!empty($bus)) {
                $station['closest'] = $bus['plate'];
                if ($bus['time'] < $arrive) {
                    $station['bus'] = $bus['plate']."<br>約" . ($arrive - $bus['time']) . "分鐘到站";
                } else {
                    $station['bus'] = "<br>已到站";
                    $station['class'] = "text-danger";
                }
            } else {
                $station['bus'] = "<br>未發車";
            }

            $stations[$key] = $station;
        }
        echo json_encode($stations);
    break;

    case 'basic':
        $time = $pdo->query("SELECT * FROM `basic`")->fetchAll();
        echo json_encode($time);
        break;
    case 'participants':
        $participants = $pdo->query("SELECT * FROM `participants`")->fetchAll();
        echo json_encode($participants);
        break;
}
?>