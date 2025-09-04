<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    extract($_POST);

    $key = array_keys($_POST);
    $key = implode(',', $key);

    $values = array_values($_POST);

    $values = implode(',', array_map(function ($x) {
        return is_numeric($x) ? $x : "'$x'";
    }, $values));

    $qry = "insert into febAcc ($key) values ($values);";
    $res = $con -> query($qry);
    if ($res) {
        header("Location: febAcc.php?msg=success");
    }
    else{
        header("Location: febAcc.php?msg=failed");
    }
