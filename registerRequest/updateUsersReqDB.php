<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id;
    if (isset($_GET['code'])) {
        $id = $_GET['code'];
    }

    extract ($_POST);

    $keys = array_keys($_POST);
    $values = array_values($_POST);

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

    $values = explode(',', $values);
    $arr = array_combine($keys, $values);

    $result = "";
    $arr2 = array();

    foreach ($arr as $k => $v){
        $result = "$k = $v";
        array_push($arr2, $result);
    }

    $v = array_values($arr2);
    $rs = implode(', ', $v);

    $qry = "update registerRequest set $rs where id=$id;";

    $res = $con->query($qry);
    if ($res){
        header("Location:viewRegisterReq.php?msg=successful");
    }
?>