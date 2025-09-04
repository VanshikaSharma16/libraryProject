<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    $id;
    if (isset($_GET['code'])) {
        $id = $_GET['code'];
    }

    $qry = "select * from registerRequest where id = $id";
    $res = $con -> query($qry);
    $rows = $res->fetch_assoc();

    array_shift($rows);

    $keys = array_keys($rows);
    $keys = implode(',', $keys);
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


    $qry = "insert into userForm ($keys) values ($values);";
    $res = $con->query($qry);
    if ($res){
        $qr = "delete from registerRequest where id = $id;";
        $r = $con -> query($qr);
        header("Location:viewRegisterReq.php?msg=successful");
    }
?>