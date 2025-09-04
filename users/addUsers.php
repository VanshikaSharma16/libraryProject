<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');
$qry = "select department_name from department;";
$res = $con->query($qry);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <meta charset="UTF-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Users</title>

    <!-- Temp Css file -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- Eye Styling CSS file -->
    <link rel="stylesheet" href="eye.css">

    <!-- Google Fonts Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- This File's CSS -->
    <link rel="stylesheet" href="addUsers.css">

    <!-- Sweet Alert Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include "../dashboard/tempFinal.php";
    ?>
    <div class="alert">
        <?php
        if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 'successful') {
        ?>
                <script>
                    Swal.fire({
                        title: "Great!",
                        text: "User Successfully Registered!",
                        icon: "success"
                    });
                </script>
            <?php
            } else if ($_GET['msg'] == 'userexists') {
            ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "The User Already Exist!"
                    });
                </script>
        <?php
            }
        }
        ?>
    </div>
    <div class="frm">
        <!-- Alert Div -->

        <!-- Form  -->
        <h1>Register here!</h1>
        <form action="addUsersDB.php" method="post">
            <div class="user__details">
                <div class="input__box">
                    <span class="details">Name</span>
                    <input type="text" name="name" onkeyup="lettersOnly(this)" required>
                </div>
                <div class="input__box">
                    <span class="details">Email</span>
                    <input type="email" name="email" id="email" required oninput="validateEmail()">
                </div>
                <div class="input__box">
                    <span class="details">Password</span>
                    <input type="password" name="password" id="pwd" oninput="validatePassword()" required>
                    <span class="material-icons-sharp eye" id="eye0">
                        remove_red_eye
                    </span>
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


                <!-- Inside your PHP code -->
                <div class="input__box">
                    <span class="details">Department</span>
                    <div class="select-style">
                        <select name="department" class="details" required>
                            <option value="-">-</option>
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
                    <span class="details">Course</span>
                    <div class="select-style">
                        <select name="course_name" class="details" required>
                            <option value="-">-</option>
                        </select>
                    </div>
                </div>

                <div class="input__box">
                    <span class="details">Year</span>
                    <div class="select-style">
                        <select name="year" class="details" required>
                            <option value="-">-</option>
                        </select>
                    </div>
                </div>

                <div class="input__box">
                    <span class="details">Book Issue Limit</span>
                    <input type="number" name="issue_limit" readonly required>
                </div>


            </div>
            <!-- Submit Button -->
            <div class="button">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
    <script src="eye.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function lettersOnly(input) {
            var regex = /[^a-zA-Z\s]/g;
            input.value = input.value.replace(regex, "");
        }

        function validateEmail() {
            var emailInput = document.getElementById("email");
            var emailValue = emailInput.value;

            // Check if the email contains valid characters
            var validCharacters = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

            if (!validCharacters.test(emailValue)) {
                emailInput.setCustomValidity("Please enter a valid email address without special characters.");
            } else {
                emailInput.setCustomValidity("");
            }
        }

        function validatePassword() {
            var passwordInput = document.getElementById("pwd");
            var passwordValue = passwordInput.value;

            // Check if the password contains only alphanumeric characters
            var validCharacters = /^[a-zA-Z0-9]+$/;

            if (!validCharacters.test(passwordValue)) {
                passwordInput.setCustomValidity("Please use only alphanumeric characters in your password.");
            } else {
                passwordInput.setCustomValidity("");
            }
        }

        $(document).ready(function() {
            // When the department dropdown changes
            $('select[name="department"]').on('change', function() {
                var department = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'fetch_course.php',
                    data: {
                        department: department
                    },
                    success: function(response) {
                        $('select[name="course_name"]').html(response);
                    }
                });
            });
        });

        $(document).ready(function() {
            // When the department dropdown changes
            $('select[name="department"]').on('change', function() {
                var department = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'fetch_limit.php',
                    data: {
                        department: department
                    },
                    success: function(response) {
                        var limit = JSON.parse(response).issue_limit;

                        $('input[name="issue_limit"]').val(limit);
                    }
                });
            });
        });


        $(document).ready(function() {
            // When the department dropdown changes
            $('select[name="course_name"]').on('change', function() {
                var course_name = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'fetch_years.php',
                    data: {
                        course_name: course_name
                    },
                    success: function(response) {
                        $('select[name="year"]').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>