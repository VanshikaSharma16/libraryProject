<?php
// when the books received is less than the requested
    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    $id = isset($_GET['code']) ? $_GET['code'] : null;

    $comp = isset($_GET['quantity']) ? $_GET['quantity'] : null;

    // fetching particular book record
    $qry = "SELECT * FROM book_request WHERE id = $id";

    $res = $con->query($qry);
    $rows = $res->fetch_assoc();
    array_shift($rows);

    $keys = implode(',', array_keys($rows));
    $values = array_values($rows);

    $temp = '';
    foreach ($values as $key => $value){
        if(is_array($value)){
            $temp = implode(',', $value);
            $values[$key] = $temp;
        }
    }
    $values = implode(',', array_map(function($x){
        return is_numeric($x)? $x: "'$x'";
    }, $values));

    $quantity = $rows['quantity'];

    // this is calculated to update the book request
    $diff = $quantity - $comp;

    for ($i = 0; $i < $comp; $i++){
        $rows['quantity'] = 1;
        $values = implode(',', array_map(function ($x) {
            return is_numeric($x) ? $x : "'$x'";
        }, $rows));
        $qry = "insert into books ($keys) values ($values);";
        $res = $con->query($qry);
        if ($res){
            $q = "update book_request set quantity = $diff where id = $id";
            $r = $con->query($q);
            if ($r){
                header("Location: viewBooksReq.php?msg=added&page=1");
            }
        }
    }
    ?>