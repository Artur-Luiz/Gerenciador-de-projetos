<?php
include('connection.php');
error_reporting(E_ERROR | E_PARSE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <script src="style/script.js"></script>
    <title>EUAX Challenge</title>
</head>

<body>
    <div class="add">
        <div class="form_project">
            <form action="database/newProject.php" method="POST">
                <fieldset>
                    <legend>Adicionar Projeto</legend>
                    <label for="projectname">Project Name: </label>
                    <input type="text" name="projectname" id="projectname" required>
                    <label for="startproject">Start Project: </label>
                    <input type="date" name="startproject" id="startproject" required>
                    <label for="endproject">End Project: </label>
                    <input type="date" name="endproject" id="endproject" required>
                    <input class="btn" type="submit" name="submit" id='btn' onmouseover="over()" onmouseout="out()"value="Criar">
                </fieldset>
            </form>
        </div>

        <div class="form_activities">
            <form action="database/newActivity.php" method="POST">
                <fieldset>
                    <legend>Adicionar Atividade</legend>
                    <label for="activityname">Activity Name: </label>
                    <input type="text" name="activityname" id="activityname" required>

                    <label for="id_project">Project ID: </label>
                    <?php
                    require('connection.php');
                    $sqlproject = "SELECT id FROM project";
                    $result = mysqli_query($conn, $sqlproject);
                    $opt = "<select name = 'id_project' required>
                    <option value = 'none' selected disabled hidden >Select</option>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        $opt .= "<option value = '" . $row['id'] . "'>" . $row['id'] . "</option>";
                    }
                    $opt .= "</select>";
                    ?>
                    <?php echo $opt; ?>

                    <label for="startactivity">Start Activity: </label>
                    <input type="date" name="startactivity" id="startactivity" required>
                    <label for="endactivity">End Activity: </label>
                    <input type="date" name="endactivity" id="endactivity" required>
                    <label for="finished"> Finished? </label>
                    <select name="finished" id="finished" required>
                        <option value="none" selected disabled hidden>Select</option>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                    <input class="btn" type="submit" name="submit" id='btn' onmouseover="over()" onmouseout="out()" value="Criar">
                </fieldset>
            </form>
        </div>



        <div class="tables">
            <div class="table_projects">
                <h2>Projects</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Start Project</th>
                            <th>End Project</th>
                            <th>% Completed</th>
                            <th>Late</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('connection.php');

                        $sqlactivity = "SELECT * FROM activities ORDER BY startactivity";
                        $result2 = mysqli_query($conn, $sqlactivity);
                        while ($row = mysqli_fetch_assoc($result2)) {
                            $endactivity = $row['endactivity'];
                        }

                        $sql = "SELECT * FROM project ORDER BY startproject";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $projectname = $row['projectname'];
                            $startproject = $row['startproject'];
                            $endproject = $row['endproject'];
                            $sqlactivities = "SELECT * FROM activities WHERE id_project = $id";
                            $resultactivities = mysqli_query($conn, $sqlactivities);
                            $totalactivities = mysqli_num_rows($resultactivities);
                            $completedactivities = 0;
                            while ($rowactivities = mysqli_fetch_assoc($resultactivities)) {
                                if ($rowactivities['finished'] == 1) {
                                    $completedactivities++;
                                }
                            }
                            if ($totalactivities == 0) {
                                $percentage = 0;
                            } else {
                                $percentage = ($completedactivities / $totalactivities) * 100;
                            }

                            if ($endactivity < $startproject) {
                                $late = "Yes";
                            } else {
                                $late = "No";
                            }
                            echo "<tr>";
                            echo "<td>" . $id . "</td>";
                            echo "<td>" . $projectname . "</td>";
                            echo "<td>" . $startproject . "</td>";
                            echo "<td>" . $endproject . "</td>";
                            echo "<td>" . $percentage . "%</td>";
                            echo "<td>" . $late . "</td>";
                            echo "<td><a href='database/deleteProject.php?id=$id' class='remove'id='btn' onmouseover='over()' onmouseout='out()'> <img src='style/src/bin.png'> </a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="table_activities">
                <hr>
                <h2>Activities</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Activity Name</th>
                            <th>ID do Projeto</th>
                            <th>Start Activity</th>
                            <th>End Activity</th>
                            <th>Finished?</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require('connection.php');
                        $sql = "SELECT * FROM activities ORDER BY id_project";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            if ($row['finished'] == 0) {
                                $finished = "No";
                            } else {
                                $finished = "Yes";
                            }
                            $id = $row['id'];
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['activityname'] . "</td>";
                            echo "<td>" . $row['id_project'] . "</td>";
                            echo "<td>" . $row['startactivity'] . "</td>";
                            echo "<td>" . $row['endactivity'] . "</td>";
                            echo "<td>" . $finished .
                                "<a href='database/completeActivity.php?id=$id' class='complete' id='btn'> Complete </a>
                            </td>";
                            echo "<td><a href='database/deleteActivity.php?id=$id' class='remove'> <img src='style/src/bin.png'> </a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>