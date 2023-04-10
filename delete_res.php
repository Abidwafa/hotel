<?php

include 'db.php';
$db = new Database();

$reserveringnummer = $_GET['reserveringnummer'];

$sql = "DELETE FROM reservering WHERE reserveringnummer=:reserveringnummer";
$placeholders = [
    'reserveringnummer' => $reserveringnummer
];
 $db->delete($sql, $placeholders);
 header("Location: alle_res.php")


?>