<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');

$qry = "select * from userForm";
$res = $con->query($qry);
$total_users = $res->num_rows;

$qry2 = "select * from books";
$res2 = $con->query($qry2);
$total_books = $res2->num_rows;

$qry3 = "select * from issue_book";
$res3 = $con->query($qry3);
$total_ibooks = $res3->num_rows;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>dashboard</title>

    <!-- File Styling -->
    <link rel="stylesheet" href="tempFinal.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- Box icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="dash.css">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Sweet Alert Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="alert">
        <?php
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 'success') {
        ?>
                <script>
                    Swal.fire({
                        title: "Great!",
                        text: "Password Updated!",
                        icon: "success"
                    });
                </script>
            <?php
            } else if ($_GET['msg'] == 'failed') {
            ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Couldn't Update!"
                    });
                </script>
        <?php
            } else if ($_GET['msg'] == 'notmatch') {
            ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "The Password and Confirm Password doesn't match!"
                    });
                </script>
        <?php
            }
        }
        ?>
    </div>
    <?php
    include "tempFinal.php";
    ?>
    <div class="cont">
        <div class="card">
            <div class="face face1">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <h3>
                        <a href="../users/viewUsers.php??page=1">Total Users</a> <br> <br>
                        <?php echo $total_users; ?>
                    </h3>

                </div>
            </div>
        </div>
        <div class="card">
            <div class="face face1">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <h3>
                        <a href="../books/viewBooks.php?page=1">Total Books</a> <br><br>
                        <?php echo $total_books; ?>
                    </h3>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="face face1">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-file" aria-hidden="true"></i>

                    </div>
                </div>
            </div>
            <div class="face face2">
                <div class="content">
                    <h3>
                        <a href="../issueBook/viewIssueBooks.php">Issued Books</a> <br><br>
                        <?php echo $total_ibooks; ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    
    <script src="tempFinal.js"></script>
</body>

</html>