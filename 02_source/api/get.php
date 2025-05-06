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
        $stations = $pdo->query("SELECT * FROM `route-station` WHERE `route` = '{$_POST['route']}' ORDER BY `rank`")->fetchAll(PDO::FETCH_ASSOC);


        foreach ($stations as $key => $station) {
            $prev = $pdo->query("SELECT SUM(`need` + `stop`) FROM `route-station` WHERE `rank` < '{$station['rank']}' AND `route` = '{$_POST['route']}'")->fetchColumn();
            $arrive = $prev + $station['need'];
            $leave = $arrive + $station['stop'];
            $bus = $pdo->query("SELECT * FROM `bus` WHERE `time` <= $leave AND `route` = '{$_POST['route']}' ORDER BY `time` DESC")->fetch(PDO::FETCH_ASSOC);
                
            if (!empty($bus)) {
                $station['closest'] = $bus['plate'];
                if ($bus['time'] < $arrive) {
                    $station['bus'] = $bus['plate']."<br>約" . ($arrive - $bus['time']) . "分鐘到站";
                } else {
                    $station['bus'] = "<br>已到站";
                    $station['class'] = "text-danger";
                }
            } else {
                $station['class'] = "text-secondary";
                $station['bus'] = "<br>未發車";
            }

            $stations[$key] = $station;
        }
        echo json_encode($stations);
    break;

    case 'form':
        $form = $pdo->query("SELECT * FROM `form`")->fetch();
        echo $form['form'];
        break;
    case 'basic':
        
        $time = $pdo->query("SELECT * FROM `basic`")->fetchAll();
        echo json_encode($time);
        break;
    case 'participants':
        $participants = $pdo->query("SELECT * FROM `participants`")->fetchAll();
        echo json_encode($participants);
        break;
    
    case 'response':
        $response = $pdo->query("SELECT * FROM `response`")->fetchAll();
        echo json_encode($response);
        break;

    case 'route':
        $route = $pdo->query("SELECT * FROM `route`")->fetchAll();
        echo json_encode($route);
        break;
    case 'status':
        $buses = $pdo->query("SELECT * FROM `bus` WHERE `route` = '{$_POST['route']}' LIMIT 3")->fetchAll();
        $time = $pdo->query("SELECT * FROM `route-station` WHERE `rank` < '{$_POST['rank']}' AND `route` = '{$_POST['route']}'")->fetchColumn();
        foreach ($buses as $bus) {
            $arrive = $time-$bus['time'];
            if ($arrive < 0) {
                echo "<span style='color: grey;'>".$bus['plate']."已過站</span>";
            } else {
                echo "<span style='color: red;'>".$bus['plate'].":".$arrive."分鐘後到站</span>";
            }
        }
        break;
}
?>