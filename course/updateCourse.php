<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id;
    if (isset($_GET['code'])) {
        $id = $_GET['code'];
    }
    $qry = "select * from course where id = $id;";
    $res = $con->query($qry);
    $result = $res->fetch_assoc();

    $qry2 = "select department_name from department;";
    $res2 = $con->query($qry2);
    $result2 = $res2->fetch_assoc();
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
    <link rel="stylesheet" href="addCourse.css">

    <!-- Google Fonts link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
</head>

<body>
    <?php
    include "../dashboard/tempFinal.php";
    ?>

    <div class="frm">
        <h1>Update here!</h1>
        <form action="updateCourseDB.php?code=<?php echo $id; ?>" method="post">

            <div class="user__details">
                <!-- Inside your PHP code -->
                <div class="input__box">
                    <span class="details">Department</span>
                    <div class="select-style">
                        <select name="department" class="details" required>
                            <option value="<?php echo $result['department']?>" ><?php echo $result['department'] ?></option>
                            <!-- <option value="-">-</option> -->
                            <?php
                            while ($row = $res2->fetch_assoc()) {
                                foreach ($row as $k => $v) {
                            ?><option value="<?php echo $v; ?>"><?php echo $v; ?></option><?php
                            }
                        }
                    ?>
                        </select>
                    </div>
                </div>

                <div class="input__box">
                    <span class="details">Type</span>
                    <div class="select-style">
                    <select name="type" class="details" required>
                        <option value="<?php echo $result['type']?>"><?php echo $result['type']?></option>
                        <option value="Bachelors">Bachelors</option>
                        <option value="Post Graduate">Post Graduate</option>
                    </select>
                    </div>
                </div>

                <div class="input__box">
                    <span class="details">Course Name</span>
                    <input type="text" name="course_name" value="<?php echo $result['course_name']?>" onkeyup="lettersOnly(this)" required>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="button">
                <input type="submit" value="Update">
            </div>

        </form>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
    <script>
        function lettersOnly(input) {
            var regex = /[^a-zA-Z\s]/g;
            input.value = input.value.replace(regex, "");
        }
    </script>
</body>

</html>