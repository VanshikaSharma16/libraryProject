<?php

    function saveData($arr, $tblname){
        // array_pop($arr);
        extract($_POST);

        $k = array_keys($arr);
        $k = implode(',', $k);
        $v = array_values($arr);
        $v = implode(',', array_map(function($x){
            return is_numeric($x)? $x: "'$x'";
        }, $v));

        $con = new mysqli ('localhost', 'root', '', 'libraryProject');

        $q1 = "select * from $tblname where email = '$email';";

        $r = $con->query($q1);
        $row = $r->num_rows;

        if ($row > 0){
            header("Location:home.php?msg=userexists");
            echo "<script> window.location.href='form.php'; </script>";
        }
        else{
            $q2 = "insert into registerRequest ($k) values ($v);";
            $r = $con->query($q2);
            if ($r){ 
                header("Location:home.php?msg=sucessful");
            }
            // if ($category == 'student'){
            //     $q2 = "insert into student ($k) values ($v);";
            //     $r = $con->query($q2);
            // }
            // else{
            //     $q2 = "insert into student ($k) values ($v);";
            //     $r = $con->query($q2);
            // }
        }
    }

    $r = saveData($_POST, 'userForm');
    
?>