<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id;
    if (isset($_GET['code'])) {
        $id = $_GET['code'];
    }
    $qry = "select * from registerRequest where id = $id;";
    $res = $con->query($qry);
    $result = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Users</title>

    <!-- Temp Css file -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- For styling this page -->
    <link rel="stylesheet" href="addRegUsers.css">

    <!-- For eye button styling -->
    <link rel="stylesheet" href="eye.css">

    <!-- Google Fonts link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
</head>

<body>
    <?php
    include "../dashboard/tempFinal.php";
    ?>

    <div class="frm">
        <h1>Update User Request here!</h1>

        <form action="updateUsersReqDB.php?code=<?php echo $id; ?>" method="post">

            <div class="user__details">

                <div class="input__box">
                    <span class="details">Username</span>
                    <input type="text" name="name" value="<?php echo $result['name'] ?>" required>
                </div>

                <div class="input__box">
                    <span class="details">Email</span>
                    <input type="email" name="email" value="<?php echo $result['email'] ?>" required>
                </div>

                <div class="input__box">
                    <span class="details">Phone Number</span>
                    <input type="text" name="phoneNumber" value="<?php echo $result['phoneNumber'] ?>" required maxlength="10">
                </div>

                <div class="input__box">
                    <span class="details">Password</span>
                    <input disabled type="password" name="password" id="pwd" value="<?php echo $result['password'] ?>" required>
                    <span class="material-icons-sharp eye" id="eye0">
                        remove_red_eye
                    </span>
                </div>

                
                <div class="input__box">
                    <span class="details">Department</span>

                    <div class="select-style">
                        <select name="department" class="details" required>

                            <option value="<?php echo $result['department'] ?>"><?php echo $result['department'] ?></option>

                            <?php
                            $q1 = "select department_name from department order by department_name;";
                            $r = $con->query($q1);

                            while ($row = $r->fetch_assoc()) {
                                foreach ($row as $k => $v) {
                            ?><option value="<?php echo $v; ?>"><?php echo $v; ?></option><?php
                                                                                                }
                                                                                            }
                                                                                                    ?>
                        </select>
                    </div>
                </div>

                <div class="input__box">
                    <span class="details">Category</span>
                    <div class="category1">
                        <input type="radio" name="category" id="dot-1" value="student">
                        <input type="radio" name="category" id="dot-2" value="teacher">

                        <div class="category">
                            <label for="dot-1">
                                <span class="dot one"></span>
                                <span>Student</span>
                            </label>
                            <label for="dot-2">
                                <span class="dot two"></span>
                                <span>Teacher</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button">
                <input type="submit" value="Update">
            </div>

        </form>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
    <script src="eye.js"></script>
</body>

</html>