<?php
include 'db.php';
$db = new Database();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $sql = "INSERT INTO kamers VALUES (:kamernummer, :type, :prijs)";
        $placeholders = [
            'kamernummer' => null,
            'type' => $_POST['type'],
            'prijs' => $_POST['prijs'],
        
        ];
        $db->insert($sql,$placeholders);
        echo "<script>alert('Inserted successfully')</script>";
    }catch (\Exception $e) {
        echo $e->getMessage();
    }
}

$sqlKamers = "Select * from kamers";
$result = $db->select($sqlKamers)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kamer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <h1>voeg kamers toe</h1>
<form method="POST">
        <input type="text" name="type" placeholder="type"><br><br>
        <input type="text" name="prijs" placeholder="prijs"><br><br>
        <input type="submit">
    </form>

   <h1>Alle kamers</h1>
   <table class="table table-striped">
    <tr>
        <th>kamernummer</th>
        <th>Type</th>
        <th>Prijs</th>
        <th colspan="2">Actie</th>
    </tr>

    <tr>
        <?php 
        if(!is_null($result)) {
        foreach ($result as $rows) {?>
         <td><?php echo $rows['kamernummer'] ?></td>
         <td><?php echo $rows['type'] ?></td>
         <td><?php echo $rows['prijs'] ?></td>



         <td><a href="edit_kamer.php?kamernummer=
         <?php echo trim($rows['kamernummer']);?> 
         &type=<?php echo trim($rows['type']);?>
         &prijs=<?php echo trim($rows['prijs']);?>
         ">Edit</a></td>
         <td><a href="delete_kamer.php?kamernummer=<?php echo $rows['kamernummer'];?>">Delete</a></td>

       
    </tr>
     <?php }} ?> 
   </table>

   <a href="alle_res.php">Reserveringen</a>
   <a href="res_vandaag.php">Reserveringen_vandaag</a>
</body>
</html>













