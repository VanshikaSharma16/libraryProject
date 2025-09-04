<?php
session_start();
function saveData($arr)
{
    // array_pop($arr);
    extract($_POST);

    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $q = "select * from userForm where email = '$email' and password =  '$password';";
    $r = $con->query($q);
    $row = $r->fetch_assoc();

    if ($r->num_rows > 0) {

        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];

        if ($row['category'] == "teacher") {
            header("Location:../tchrDash/dash.php?username=$email");
        } else if ($row['category'] == "student") {
            header("Location:../studDash/dash.php?username=$email");
        } else if ($row['category'] == 'librarian') {
            header("Location:../dashboard/dash.php?username=$email");
        } else {
            header("Location:home.php?msg=notCorrect");
        }
    } else {
        header("Location:home.php?msg=notCorrect");
    }

}
$result = saveData($_POST);
