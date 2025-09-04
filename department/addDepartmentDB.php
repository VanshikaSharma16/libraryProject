<?php
    function saveData($arr, $tblname){
        
        extract ($_POST);

        $k = array_keys($arr);
        $k = implode(',', $k);

        $v = array_values($arr);
        $v = implode(',', array_map(function($x){
            return is_numeric($x)? $x: "'$x'";
        }, $v));
        
        $con = new mysqli('localhost', 'root', '', 'libraryProject');

        $qry = "select * from $tblname where department_name = '$department_name';";

        $r = $con -> query($qry);
        $row = $r->num_rows;

        if($row > 0){
            header("Location:addDepartment.php?msg=userexists");
        }

        else {
            $q2 = "insert into $tblname ($k) values ($v);";
            $res = $con -> query($q2);
            if ($res){
                header("Location:addDepartment.php?msg=successful");
            }
        }
    }
    $r = saveData($_POST, 'department');
?>