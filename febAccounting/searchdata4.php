<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['issuer_id'])) {
    $issuer_id = $con->real_escape_string($_POST['issuer_id']); // Sanitize input
    $query = "SELECT ceil(SUM(book_price)) AS totalAmount FROM issue_book WHERE issuer_id = $issuer_id";

    $res = $con->query($query);

    if ($res) {
        $row = $res->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Unable to fetch issuer details']);
    }
} else {
    echo json_encode(['error' => 'Invalid request']);
}

$con->close();
