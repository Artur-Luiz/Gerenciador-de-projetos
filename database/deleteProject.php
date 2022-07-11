<?php

require('../connection.php');

$id = $_GET['id'];
$sql = "DELETE FROM project WHERE id = $id";
$result = mysqli_query($conn, $sql);
$sql = "DELETE FROM activities WHERE id_project = $id";
$result = mysqli_query($conn, $sql);

header("Location: ../index.php");

?>