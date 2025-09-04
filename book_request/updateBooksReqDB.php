<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id;
    if (isset($_GET['code'])) {
        $id = $_GET['code'];
    }

    extract ($_POST);

    $keys = array_keys($_POST);  // fetching keys of an array
    $values = array_values($_POST);   // fetching values of an array

    $temp = '';
    foreach ($values as $key => $value){
        if(is_array($value)){
            $temp = implode(',', $value);
            $values[$key] = $temp;
        }
    }
    
    $values = array_map(function($x){
        return is_numeric($x)? $x: "'$x'";
    }, $values);  // converting string values in quotes

    $arr = array_combine($keys, $values);  // creating array again of keys and values in $arr

    $result = "";
    $arr2 = array();

    foreach ($arr as $k => $v){
        $result = "$k = $v";  // creating string of each keys and values
        array_push($arr2, $result);  // pushing the string in $arr2
    }

    $v = array_values($arr2);  // fetching all the strings of $arr2 in $v
    $rs = implode(', ', $v);   // seperating all the strings by ','

    $qry = "update book_request set $rs where id=$id;";

    $res = $con->query($qry);

    if ($res == 1){
        header("Location: viewBooksReq.php?msg=successful&page=1");
        exit;
    }
    
?>