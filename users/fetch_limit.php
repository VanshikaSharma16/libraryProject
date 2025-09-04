<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a connection to the database already
    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    // Get the selected department from the AJAX request
    $department = $_POST['department'];

    // Fetch the limit based on the selected department
    $qry = "SELECT issue_limit FROM department WHERE department_name = '$department';";
    $res = $con->query($qry);

    // Check if the query was successful
    if ($res) {
        $limit = $res->fetch_assoc()['issue_limit'];

        // Return the limit as a JSON object
        echo json_encode(['issue_limit' => $limit]);
    }
}
?>
