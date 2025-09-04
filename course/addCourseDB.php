<?php
function saveData($arr, $tblname)
{
    extract($arr);

    $k = array_keys($arr);
    $k  = implode(',', $k);

    $v = array_values($arr);
    $v = implode(',', array_map(function ($x) {
        return is_numeric($x) ? $x : "'$x'";
    }, $v));

    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    $q = "select * from $tblname where course_name = '$course_name';";
    $res = $con->query($q);
    if ($res->num_rows >=  1) {
        header("Location:addCourse.php?msg=already");
    } else {
        $q1 = "insert into $tblname ($k) values ($v);";
        $r = $con->query($q1);
        if ($r) {
            header("Location:addCourse.php?msg=successful");
        }
    }
}
$r = saveData($_POST, 'course');
