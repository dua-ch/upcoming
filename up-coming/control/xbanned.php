<?php
require_once("../system/config_session.php");

$parmakizi = escape($_POST['parmakizi']);
if (isset($parmakizi)) {
    $getip = $mysqli->query("SELECT * FROM ex_dead_ban WHERE fprint = '$parmakizi'");
    if ($getip->num_rows > 0) {
        include('banned.php');
        include('body_end.php');
        die();
    } else {
        echo 0;
        die();
    }
}
?>
