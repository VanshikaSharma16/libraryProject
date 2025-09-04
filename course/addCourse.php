<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');
$qry = "select department_name from department;";
$res = $con->query($qry);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Course</title>

    <!-- Temp Css file -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- Google Fonts Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- This File's CSS -->
    <link rel="stylesheet" href="addCourse.css">

    <!-- Sweet Alert Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include "../dashboard/tempFinal.php";
    ?>
    <div class="frm">

        <!-- Alert Div -->
        <div class="alert">
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'successful') {
            ?>
                    <script>
                        Swal.fire({
                            title: "Great!",
                            text: "Course Added Successfully!",
                            icon: "success"
                        });
                    </script>
                <?php
                } else if ($_GET['msg'] == 'already') {
                ?>
                    <script>
                        Swal.fire({
                            title: "Oppsss!",
                            text: "Course Already Exist!",
                            icon: "error"
                        });
                    </script>
            <?php
                }
            }
            ?>
        </div>

        <!-- Form  -->
        <h1>Add Course!</h1>

        <form action="addCourseDB.php" method="post">

            <div class="user__details">
                <!-- Inside your PHP code -->
                <div class="input__box">
                    <span class="details">Department</span>
                    <div class="select-style">
                        <select name="department" class="details" required>
                            <option value="-">-</option>
                            <!-- <option value="-">-</option> -->
                            <?php
                            while ($row = $res->fetch_assoc()) {
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
                            <option value="-">-</option>
                            <option value="Bachelors">Bachelors</option>
                            <option value="Post Graduate">Post Graduate</option>
                        </select>
                    </div>
                </div>

                <div class="input__box">
                    <span class="details">Course Name</span>
                    <input type="text" name="course_name" onkeyup="lettersOnly(this)" required>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="button">
                <input type="submit" value="Submit">
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