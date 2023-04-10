<?php

use LDAP\Result;

include 'db.php';
$db = new Database();

$sql = "SELECT * from reservering WHERE van = CURDATE()";
$result = $db->select($sql);

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


   <h1>Alle Reserveringen</h1>
   <table class="table table-striped">
    <tr>
        <th>reserveringnummer</th>
        <th>van</th>
        <th>tot</th>
        <th>kamernummer</th>
        <th>klant_id</th>
        <th colspan="2">Action</th>
    </tr>

    <tr>
        <?php 
        if(!is_null($result)) {
        foreach ($result as $rows) {?>
         <td><?php echo $rows['reserveringnummer'] ?></td>
         <td><?php echo $rows['van'] ?></td>
         <td><?php echo $rows['tot'] ?></td>
         <td><?php echo $rows['kamernummer'] ?></td>
         <td><?php echo $rows['klant_id'] ?></td>
         <td><a  class="btn btn-secondary" href="edit_res.php?reserveringnummer=
         <?php echo trim($rows['reserveringnummer']);?> 
         &van=<?php echo trim($rows['van']);?>
         &tot=<?php echo trim($rows['tot']);?>
         ">Edit</a></td>
         <td><a  class="btn btn-secondary" href="delete_res.php?reserveringnummer=<?php echo $rows['reserveringnummer'];?>">Delete</a></td>

       
    </tr>
     <?php }
     } ?>
   </table>

   <a href="alle_res.php">Reserveringen</a>
   <a href="res_vandaag.php">Reserveringen_vandaag</a>
</body>
</html>