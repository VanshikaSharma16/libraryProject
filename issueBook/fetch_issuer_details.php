<?php

$con = new mysqli('localhost', 'root', '', 'libraryProject');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$issuerCode = $_POST['issuer_id'];

$query = "SELECT * FROM userForm WHERE id = '$issuerCode'";
$result = $con->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $response = array(
        'name' => $row['name'],
        'email' => $row['email'],
        'department' => $row['department'],
        'course_name' => $row['course_name'],
        'year' => $row['year'],
        'issue_limit' => $row['issue_limit'],
        'category' => $row['category']
    );

    echo json_encode($response);
} else {
    $response = array('error' => 'Issuer not found');
    echo json_encode($response);
}

$con->close();
