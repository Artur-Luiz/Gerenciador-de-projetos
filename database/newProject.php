<?php

include('connection.php');

$projectname = $_POST['projectname'];
$startproject = $_POST['startproject'];
$endproject = $_POST['endproject'];

$sql = "INSERT INTO project (projectname, startproject, endproject) VALUES ('$projectname', '$startproject', '$endproject')";
$conn->query($sql);

header('location: ../index.php');

?>