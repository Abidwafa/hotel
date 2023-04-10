<?php

include 'db.php';
$db = new Database();


$reserveringnummer = $_GET['reserveringnummer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $van = $_POST['van'];
    $tot = $_POST['tot'];
try {


    $sql = "UPDATE reservering SET van=:van, tot=:tot WHERE reserveringnummer=:reserveringnummer";

    $placeholders = [
        'reserveringnummer' => $reserveringnummer,
        'van' => $van,
        'tot' => $tot,
        
    ];

    $db->update($sql, $placeholders);
    header('Location: alle_res.php');
} catch (Exception $e) {
    echo "Error: ". $e->getMessage();

}
}

?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>
    
 <form method="POST">
    <input type="date" name="van" value="<?php echo $_GET['van'];?>">
    <input type="date" name="tot" value="<?php echo $_GET['tot'];?>">
    <input type="submit">

 </form>
 
 </body>
 </html>