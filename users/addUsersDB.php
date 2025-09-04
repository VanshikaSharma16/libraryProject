<?php
    function saveData($arr, $tblname){
        extract($_POST);
        $k = array_keys($arr);
        $k = implode(',', $k);
        $v = array_values($arr);

        // $temp = '';
        // foreach ($v as $key => $value){
        //     if(is_array($value)){
        //         $temp = implode(',', $value);
        //         $v[$key] = $temp;
        //     }
        // }
        
        $v = implode(',', array_map(function($x){
            return is_numeric($x)? $x: "'$x'";
        }, $v));

        $con = new mysqli ('localhost', 'root', '', 'libraryProject');

        $q1 = "select * from $tblname where email = '$email';";

        $r = $con->query($q1);
        $row = $r->num_rows;

        if ($row > 0){
            header("Location:addUsers.php?msg=userexists");
        }
        else{
            $q2 = "insert into $tblname ($k) values ($v);";
            $r = $con->query($q2);
            if ($r){ 
                header("Location:addUsers.php?msg=successful");
            }
        }
    }

    $r = saveData($_POST, 'userForm');
    
?>