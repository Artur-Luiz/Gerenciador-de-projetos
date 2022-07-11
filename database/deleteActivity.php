<?php

require('../connection.php');

$id = $_GET['id'];
$sql = "DELETE FROM activities WHERE id = $id";
$result = mysqli_query($conn, $sql);

header("Location: ../index.php");

?>