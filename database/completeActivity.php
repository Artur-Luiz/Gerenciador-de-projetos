<?php

require('connection.php');

$id = $_GET['id'];
print_r($id);
$sql = "UPDATE activities SET finished = 1 WHERE id = $id";
$result = mysqli_query($conn, $sql);

header("Location: ../index.php");

?>