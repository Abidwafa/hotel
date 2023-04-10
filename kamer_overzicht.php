<?php
include 'db.php';
$db = new Database();

$van = $_GET['van'];
$tot = $_GET['tot'];

if(isset($_GET['van']) && isset($_GET['tot'])) {
    $sql = "Select * from kamers where kamernummer not in 
    (select kamernummer from reservering where van between '$van' and '$tot' and tot between '$van' and '$tot')";
    $result = $db->select($sql);
} else {
    header("location:select_data.php");

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <h1>Beschikbara kamers</h1>

    <table class="table table-dark">
        <tr>
            <th>kamer</th>
            <th>Type</th>
            <th>Prijs per dag</th>
            <th>Action</th>
        </tr>

        <tr>
            <?php
            if(!is_null($result)) {
                foreach($result as $rows) { ?>
                <td><?php echo $rows['kamernummer'] ?></td>
                <td><?php echo $rows['type'] ?></td>
                <td><?php echo $rows['prijs'] ?></td>
                <td> <a href="reserveer_kamer.php?kamernummer=<?php echo $rows['kamernummer'];?>&van=<?php echo $van;?>&tot=<?php echo $tot;?>">Reserveer</a></td>  
        </tr>

        <?php } 
            }else {
                echo 'Geen kamers beschikbaar tussen de geselecteerde datum.';

            }

            ?>


    </table>
</body>
</html>