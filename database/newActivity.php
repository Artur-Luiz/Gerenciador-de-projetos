<?php

include('../connection.php');

$activityname = $_POST['activityname'];
$id_project = $_POST['id_project'];
$startactivity = $_POST['startactivity'];
$endactivity = $_POST['endactivity'];
$finished = $_POST['finished'];

$sql = "INSERT INTO activities (id_project, activityname, startactivity, endactivity, finished) VALUES ('$id_project', '$activityname', '$startactivity', '$endactivity', '$finished')";
$conn->query($sql);

header('location: ../index.php');

?>