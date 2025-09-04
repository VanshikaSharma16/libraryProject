<?php
// if the purchased quantity of book and requested quantity are equal.

    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    $id = isset($_GET['code']) ? $_GET['code'] : null;

    $qry = "SELECT * FROM book_request WHERE id = $id";

    $res = $con->query($qry);
    $rows = $res->fetch_assoc();

    // removed 1st element of the array
    array_shift($rows);

    $keys = implode(',', array_keys($rows));
    $values = array_values($rows);

    $temp = '';
    foreach ($values as $key => $value) {
        if (is_array($value)) {
            $temp = implode(',', $value);
            $values[$key] = $temp;
        }
    }

    $values = implode(',', array_map(function ($x) {
        return is_numeric($x) ? $x : "'$x'";
    }, $values));

    $quantity = $rows['quantity'];

    // started loop to add the books in book table, according to the quantity.
    for ($i = 0; $i < $quantity; $i++) {
        
        // set the value of quantity column in table to 1
        $rows['quantity'] = 1;
        $values = implode(',', array_map(function ($x) {
            return is_numeric($x) ? $x : "'$x'";
        }, $rows));

        $qry = "insert into books ($keys) values ($values);";
        $res = $con->query($qry);
        if ($res) {
            $q = "delete from book_request where id = $id";
            $r = $con->query($q);
            if ($r) {
                header("Location: viewBooksReq.php?msg=added&page=1");
            }
        }
    }
