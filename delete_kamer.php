<?php

include 'db.php';
$db = new Database();

$kamernummer = $_GET['kamernummer'];

$sql = "DELETE FROM kamers WHERE kamernummer=:kamernummer";
$placeholders = [
    'kamernummer' => $kamernummer
];
 $db->delete($sql, $placeholders);
 header("Location: medewerker.php")


?>