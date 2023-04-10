<?php
include 'db.php';
$db = new Database();

$kamernummer = $_GET['kamernummer'];
$van = $_GET['van'];
$tot = $_GET['tot'];

// Selecteerd Alle Emails from klant Table
$sqlKlant = "SELECT email FROM klanten";
$resultKlant = $db->select($sqlKlant);

if(!is_null($resultKlant)) {
    foreach ($resultKlant as $rowsKlant) {
    }
}else {
    $rowsKlant = array();

}

// KIJK EERST OF DE FROM WORLD VERSTUURD
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!in_array($_POST['email'], $rowsKlant)) {
$sql = "INSERT INTO klanten VALUES (:klant_id, :voornaam, :achternaam, :telefoon, :email) ";
    $placeholders = [
                'klant_id' => null,
                'voornaam' => $_POST['voornaam'],
                'achternaam' => $_POST['achternaam'],
                'telefoon' => $_POST['telefoon'],
                'email' => $_POST['email']
            ];
            $db->insert($sql,$placeholders);
            $klant_id = $db->lastInsertId();
} else {
    $email = $_POST['email'];
    $sqlKlant = "SELECT klant_id FROM klanten WHERE email='$email'";
    $resultKlant = $db->select($sqlKlant);

    foreach ($resultKlant as $rowsKlant) {
        foreach ($rowsKlant as $rowKlant) {

        }
    }

    $klant_id = $rowKlant;

}

$sqlRes = "INSERT INTO  reservering VALUES (:reserveringnummer, :van, :tot, :kamernummer, :klant_id) ";
    $placeholders = [
               'reserveringnummer' => $reserveringnummer,
                'van' => $van,
                'tot' => $tot,
                'kamernummer' => $kamernummer,
                'klant_id' => $klant_id,

    ];

    $db->insert($sqlRes,$placeholders);
    $resNo = $db->lastInsertId();

    header("Location:factuur.php?reserveringnummer=" .$resNo. "&kamernummer=" .$kamernummer. "&van=".$van. "&tot=".$tot. "&klant_id=".$klant_id.
    "&voornaam=".$_POST['voornaam'].
    "&achternaam=".$_POST['achternaam'].
    "&telefoon=".$_POST['telefoon'].
    "&email=".$_POST['email']."");


}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reserveren</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<form method="POST"><br>
        <input type="text" name="voornaam" placeholder="voornaam" required><br><br>
        <input type="text" name="achternaam" placeholder="achternaam"><br><br>
        <input type="text" name="telefoon" placeholder="telefoon" required><br><br>
        <input type="email" name="email" placeholder="email" required><br><br>
        <input type="submit">
    </form>
    
</body>
</html>