<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delete Books</title>

    <!-- Sweet Alert Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styling for this page -->
    <style>
        .alert {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>

</head>

<body>
    <?php

    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    $id = isset($_GET['code']) ? $_GET['code'] : null;
    // $sid = isset($_GET['stu']) ? $_GET['stu'] : null;

    if ($id !== null) {
        $result = deleteRecord($con, $id);
        if ($result) {
    //         $qr = "update userForm set issue_limit = issue_limit + 1 where id = $sid;";
    //         $r = $con->query($qr);
    //         if ($r) {
    //             $qr1 = "update issue_book set issuer_limit = issuer_limit + 1 where issuer_id = $sid;";
    //             $r1 = $con->query($qr1);
    //             if ($r1) {
    // ?>
                    <script>
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your Book is Returned Successfully.",
                            icon: "success"
                        }).then(() => {
                            window.location.href = "viewAccRcrd.php?msg=success";
                        });
                    </script>
    <?php
                }
        //     }
        // }
    }
    // Function to delete the record
    function deleteRecord($con, $id)
    {
        $qry = "DELETE FROM febAcc WHERE id = $id;";
        $res = $con->query($qry);
        return $res;
    }
    ?>
</body>

</html>