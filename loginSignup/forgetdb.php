<?php
function saveData($arr, $tblname)
{
    // array_pop($arr);
    extract($_POST);

    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $qry = "select * from $tblname where email = '$user_v';";

    $res = $con->query($qry);
    $row = $res->num_rows;

    if($row == 0){
        header("Location:forget.php?msg=nouser");
    }
    else{
        $receiver = $user_v;
        $subject = "Confirm Password code.";
        $body = "this is confirm password code";
        $sender = "From:sharmavanshika1616@gmail.com";

        if(mail($receiver, $subject, $body, $sender)){
            echo "Email sent sucessfully";
        }
        else{
            echo "sorry";
        }
    }
}
$result = saveData($_POST, 'userForm');
?>
