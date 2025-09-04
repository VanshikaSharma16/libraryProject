<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    $bookCode = $_POST['book_code'];

    $qry = "select book_name, author, edition, price from books where id = $bookCode";

    $res = $con->query($qry);

    if ($res) {
        $row = $res->fetch_assoc();
        echo json_encode($row);
        // print_r($row);
    } else {
        echo json_encode(['error' => 'Unable to fetch issuer details']);
    }
    
?>