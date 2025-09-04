<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    $department = $_POST['department'];

    $qry = "SELECT course_name FROM course WHERE department = '$department';";
    $res = $con->query($qry);

    $options = '<option value="-">-</option>';
    while ($row = $res->fetch_assoc()) {
        $options .= '<option value="' . $row['course_name'] . '">' . $row['course_name'] . '</option>';
    }

    echo $options;
}
?>
