<?php
function saveData($arr, $tblname)
{
    extract($arr);

    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    if (!isset($arr['quantity'])) {
        return;
    }

    $k = array_keys($arr);
    $k = implode(',', $k);

    $v = array_values($arr);
    $v = implode(',', array_map(function ($x) {
        return is_numeric($x) ? $x : "'$x'";
    }, $v));

    $sql = "INSERT INTO $tblname ($k) VALUES ($v)";
    $res = $con->query($sql);

    if ($res) {
        header("Location:addBookReq.php?msg=successful");
    }
}

$r = saveData($_POST, 'book_request');
