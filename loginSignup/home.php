<?php
session_start();
$con = new mysqli('localhost', 'root', '', 'libraryProject');
$q = "select department_name from department";
$res = $con->query($q);

if(isset($_SESSION['email'])){
    header('index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login/SignUp</title>

    <!-- Css link -->
    <link rel="stylesheet" href="home.css">

    <!-- Box Icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>

    <!-- Material Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- Sweet Alert Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container">

        <h1 id="main_hd">LIBRARY MANAGEMENT SYSTEM</h1>

        <div id="login" class="cont">
            <h1 id="loginhd">Log In</h1>

            <form action="logindb.php" id="form_login" method="post">

                <div class="alert">
                    <?php
                    if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'notCorrect') {
                    ?>
                            <script>
                                Swal.fire({
                                    title: "Opps!",
                                    text: "Could not login! Due to Incorrect Details.",
                                    icon: "error"
                                });
                            </script>
                    <?php
                        }
                    }
                    ?>
                </div>

                <label for="mail">Username</label><br>
                <input type="email" id="mail" name="email" required oninput="validateEmail()"><br><br>

                <label for="pwd">Password</label><br>
                <input type="password" id="pwd" name="password" minlength="8" oninput="validatePassword()" required>
                <span class="material-icons-sharp eye" id="eye0">
                    remove_red_eye
                </span><br><br>

                <!-- <input type="radio" id="stud" name="category" value="student">
                <label for="stud">Student</label><br>
                <input type="radio" id="stud" name="category" value="teacher">
                <label for="stud">Teacher</label><br>
                <input type="radio" id="tchr" name="category" value="admin">
                <label for="tchr">Admin</label><br>
                <br><br> -->

                <a href="forget.php" id="forg">Forgot Password?</a><br><br>

                <input type="submit" id="log" value="LOGIN">
            </form>
        </div>

        <div id="signup" class="cont">
            <h1>Register</h1>
            <form action="signUp_db.php" id="form_sign" method="post">

                <div class="alert">
                    <?php
                    if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'userexists') {
                    ?>
                            <script>
                                Swal.fire({
                                    title: "Opps!",
                                    text: "Could not Register! The User already Exists.",
                                    icon: "error"
                                });
                            </script>
                        <?php
                        }
                    } else if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'passworderror') {
                        ?>
                            <script>
                                Swal.fire({
                                    title: "Opps!",
                                    text: "Could not Register! The Password and Confirm Password Doesn't match.",
                                    icon: "error"
                                });
                            </script>
                        <?php
                        }
                    } else if (isset($_GET['msg'])) {
                        if ($_GET['msg'] == 'sucessful') {
                        ?>
                            <script>
                                Swal.fire({
                                    title: "Great!",
                                    text: "The Register Request Successfully sent",
                                    icon: "success"
                                });
                            </script>
                    <?php
                        }
                    }
                    ?>
                </div>

                <label for="nm">Your Name</label>
                <input type="text" id="nm" name="name" onkeyup="lettersOnly(this)" required><br><br>

                <label for="email">Your Mail</label>
                <input type="email" id="email" name="email" required oninput="validateEmail()"><br><br>

                <label for="spwd">Password</label><br>
                <input type="password" id="spwd" name="password" minlength="8" oninput="validatePassword()" required>
                <span class="material-icons-sharp eye" id="eye1">
                    remove_red_eye
                </span>
                <br><br>

                <input type="radio" id="std" name="category" value="student">
                <label for="stud">Student</label><br>
                <input type="radio" id="thr" name="category" value="teacher">
                <label for="tchr">Teacher</label><br><br>

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

                <!-- <div class="input__box"> -->
                <span>Book Issue Limit</span>
                <input type="number" name="issue_limit" readonly required>
                <!-- </div> -->

                <input type="submit" id="sub" value="SIGNUP">

            </form>
        </div>
    </div>
    <!-- <script src="javas.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        let eyeicon = document.getElementById("eye0");
        let password = document.getElementById("pwd");

        let eyeicon1 = document.getElementById("eye1");
        let password1 = document.getElementById("spwd");

        let eyeicon2 = document.getElementById("eye2");
        let password2 = document.getElementById("confirm_pwd");

        eyeicon.onclick = function() {
            if (password.type == "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }


        eyeicon1.onclick = function() {
            if (password1.type == "password") {
                password1.type = "text";
            } else {
                password1.type = "password";
            }
        }

        eyeicon2.onclick = function() {
            if (password2.type == "password") {
                password2.type = "text";
            } else {
                password2.type = "password";
            }
        }

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
            $('select[name="department"]').on('change', function() {
                var dept = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'course_aj.php',
                    data: {
                        department: dept
                    },
                    success: function(response) {
                        $('select[name="course_name"]').html(response);
                    }
                });
            });
    
            $('select[name="department"]').on('change', function() {
                var dept = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: 'fetch_limit.php',
                    data: {
                        department: dept
                    },
                    success: function(response) {
                        var limit = JSON.parse(response).issue_limit;

                        
                    }
                });
            });

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