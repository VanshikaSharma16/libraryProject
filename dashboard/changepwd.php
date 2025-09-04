<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');
extract($_POST);
if ($password == $confirm) {
    $q = "update userForm set password = '$password' where email = '$email';";
    $r = $con->query($q);
    if ($r) {
        header("Location: ../dashboard/dash.php?username=$email&msg=success");
    } else {
        header("Location: ../dashboard/dash.php?username=$email&msg=failed");
    }
}
else{

        header("Location: ../dashboard/dash.php?username=$email&msg=notmatch");

}