<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a connection to the database already
    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    // Get the selected course from the AJAX request
    $course_name = $_POST['course_name'];

    // Fetch type based on the selected course
    $qry = "SELECT type FROM course WHERE course_name = '$course_name';";
    $res = $con->query($qry);

    // Check if the query was successful
    if ($res) {
        $column_name = $res->fetch_assoc();
        $type = $column_name['type'];

        // Fetch years based on the selected type
        $q = "SELECT year FROM years WHERE type = '$type';";
        $re = $con->query($q);

        // Build the options for the year dropdown
        $options = '<option value="-">-</option>';
        while ($row = $re->fetch_assoc()) {
            $options .= '<option value="' . $row['year'] . '">' . $row['year'] . '</option>';
        }

        // Return the options to the AJAX request
        echo $options;
    }
}
?>
