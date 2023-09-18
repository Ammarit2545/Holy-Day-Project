<?php
session_start();
include('database/condb.php');

$sql = "SELECT t_name FROM topic Where del_flg = 0";
$result = mysqli_query($conn ,$sql);

while($row = mysqli_fetch_array($result)){
    echo '<br>'.$row['t_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="index.php?id=1">sadasd</a>
</body>
</html>
