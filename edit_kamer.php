<?php

include 'db.php';
$db = new Database();


$kamernummer = $_GET['kamernummer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $type = $_POST['type'];
    $prijs = $_POST['prijs'];
try {


    $sql = "UPDATE kamers SET type=:type, prijs=:prijs WHERE kamernummer=:kamernummer";

    $placeholders = [
        'kamernummer' => $kamernummer,
        'type' => $type,
        'prijs' => $prijs,
        
    ];

    $db->update($sql, $placeholders);
    header('Location: medewerker.php');
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
    <input type="text" name="type" value="<?php echo $_GET['type'];?>">
    <input type="text" name="prijs" value="<?php echo $_GET['prijs'];?>">
    <input type="submit">

 </form>
 
 </body>
 </html>