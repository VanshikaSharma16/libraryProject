<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="tempFinal.css">
</head>

<body> -->
<?php
session_start();
// $con = new mysqli('localhost', 'root', '', 'libraryProject');
// $email;
// if (isset($_GET['username'])) {
//     $email = $_GET['username'];
// }

// $qry = "select * from userForm where email = '$email';";
// $res = $con->query($qry);
// $result = $res->fetch_assoc();
?>

<div class="container">
    <aside>
        <div class="top">
            <div class="logo">
                <img src="../imgs/logo.jpeg">
                <h2>SJK<span class="danger">PG</span>M</h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">
                    close
                </span>
            </div>
        </div>

        <div class="sidebar">

            <a href="../dashboard/dash.php" class="active">
                <span class="material-icons-sharp">
                    grid_view
                </span>
                <h3>Dashboard</h3>
            </a>

            <a href="../users/addUsers.php">
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Add User</h3>
            </a>

            <a href="../users/viewUsers.php?page=1">
                <span class="material-icons-sharp">
                    people_alt
                </span>
                <h3>View User</h3>
            </a>

            <a href="../department/addDepartment.php">
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Add Department</h3>
            </a>

            <a href="../department/viewDepartment.php?page=1">
                <span class="material-icons-sharp">
                    school
                </span>
                <h3>View Department</h3>
            </a>

            <a href="../course/addCourse.php">
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Add Course</h3>
            </a>

            <a href="../course/viewCourse.php?page=1">
                <span class="material-icons-sharp">
                    school
                </span>
                <h3>View Course</h3>
            </a>

            <a href="../books/addBook.php">
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Add Books</h3>
            </a>

            <a href="../books/viewBooks.php?page=1">
                <span class="material-icons-sharp">
                    auto_stories
                </span>
                <h3>View Books</h3>
            </a>

            <a href="../book_request/addBookReq.php">
                <span class="material-icons-sharp">
                    add
                </span>
                <h3>Request Books</h3>
            </a>

            <a href="../book_request/viewBooksReq.php?page=1">
                <span class="material-icons-sharp">
                    summarize
                </span>
                <h3>View Request Books</h3>
            </a>

            <a href="../issueBook/addIssueBook.php">
                <span class="material-icons-sharp">
                    bookmark_remove
                </span>

                <h3>Issue Book</h3>
            </a>

            <a href="../issueBook/viewIssueBooks.php?page=1">
                <span class="material-icons-sharp">
                    summarize
                </span>
                <h3>View Issued Books</h3>
            </a>

            <a href="../febAccounting/febAcc.php">
                <span class="material-icons-sharp">
                    summarize
                </span>
                <h3>Feb Accounting</h3>
            </a>

            <a href="../febAccounting/viewAccRcrd.php">
                <span class="material-icons-sharp">
                    bookmark_add
                </span>
                <h3>Feb Accounting Records</h3>
            </a>

            <a href="../registerRequest/viewRegisterReq.php">
                <span class="material-icons-sharp">
                    drafts
                </span>
                <h3>Register Requests</h3>
            </a>

            <a href="../dashboard/logout.php">
                <span class="material-icons-sharp">
                    logout
                </span>
                <h3>Logout</h3>
            </a>


        </div>
    </aside>

    <div class="right">
        <div class="top">
            <button id="menu-btn">
                <span class="material-icons-sharp active">
                    menu
                </span>
            </button>
            <div class="theme-toggler">
                <span class="material-icons-sharp">
                    contrast
                </span>
            </div>
            <div class="profile" onclick="showPopup()">
                <div class="info">
                    <p style="color: var(--color-dark);">Hey, <b>
                            <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>
                        </b> </p>
                    <small class="text-muted">Admin</small>
                </div>
                <div class="profile-photo">
                    <img src="../imgs/user.jpeg" alt="">
                </div>
            </div>
            <div id="userDetailsPopup" class="popup-container">
                <div class="popup-content">
                    <span class="close-popup" onclick="closePopup()">&times;</span>
                    <!-- <h1 style="margin-bottom: 3%;">User Details</h1> -->
                    <!-- <table style="width: 80vw; margin: auto; height: 40vh;"> -->
                    <form action="../dashboard/changepwd.php" method="post" style="height: 70vh; width:30vw; margin-top:4vh">
                        <div class="input__box">
                            <span class="details">Name</span>
                            <input type="text" name="name" value="<?php echo $_SESSION['name'] ?>" readonly required>
                        </div>
                        <div class="input__box">
                            <span class="details">Email</span>
                            <input type="text" name="email" value="<?php echo $_SESSION['email'] ?>" readonly required>
                        </div>
                        <div class="input__box">
                            <span class="details">New Password</span>
                            <input type="text" name="password" required>
                        </div>
                        <div class="input__box">
                            <span class="details">Confirm Password</span>
                            <input type="text" name="confirm" required>
                        </div>
                        <div class="input__box">
                            <input type="submit" value="Submit" style="background-color: var(--color-primary); width: 83%">
                        </div>
                    </form>
                    <!-- </table> -->
                </div>
            </div>
        </div>
    </div>
    <!-- </div>  -->

    <!-- </body>

</html> -->