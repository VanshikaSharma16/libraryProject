<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');
$id;
if (isset($_GET['code'])) {
    $id = $_GET['code'];
}
$qry = "select * from userForm where id = $id;";
$res = $con->query($qry);
$result = $res->fetch_assoc();

$qry = "select department_name from department;";
$res = $con->query($qry);
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
    <link rel="stylesheet" href="addUsers.css">

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
        <h1>Update here!</h1>
        <form action="updateUsersDB.php?code=<?php echo $id; ?>" method="post">
            <div class="user__details">
                <div class="input__box">
                    <span class="details">Name</span>
                    <input type="text" name="name" value="<?php echo $result['name'] ?>" onkeyup="lettersOnly(this)" required>
                </div>
                <div class="input__box">
                    <span class="details">Email</span>
                    <input type="email" name="email" value="<?php echo $result['email'] ?>" required>
                </div>
                <!-- <div class="input__box">
                    <span class="details">Phone Number</span>
                    <input type="text" name="phoneNumber" maxlength="10" required>
                </div> -->
                <div class="input__box">
                    <span class="details">Password</span>
                    <input type="password" name="password" id="pwd" value="<?php echo $result['password'] ?>" readonly required>
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
                            <option value="<?php echo $result['department'] ?>"><?php echo $result['department'] ?></option>
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
                        <option value="<?php echo $result['course_name'] ?>"><?php echo $result['course_name'] ?></option>
                        </select>
                    </div>
                </div>

                <div class="input__box">
                    <span class="details">Year</span>
                    <div class="select-style">
                        <select name="year" class="details" required>
                        <option value="<?php echo $result['year'] ?>"><?php echo $result['year'] ?></option>
                        </select>
                    </div>
                </div>

                <div class="input__box">
                    <span class="details">Book Issue Limit</span>
                    <input type="number" name="issue_limit" value="<?php echo $result['issue_limit'] ?>" readonly required>
                </div>

            </div>
            <!-- Submit Button -->
            <div class="button">
                <input type="submit" value="Update">
            </div>
        </form>

    </div>
    <script src="../dashboard/tempFinal.js"></script>
    <script src="eye.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function lettersOnly(input){
            var regex = /[^a-zA-Z\s]/g;
            input.value =input.value.replace(regex, "");
        }

        // when all html element loads
        $(document).ready(function() {
            // When the department dropdown changes
            $('select[name="department"]').on('change', function() {
                var department = $(this).val();

                // AJAX request to fetch books based on the selected department
                $.ajax({
                    type: 'POST',
                    url: 'fetch_course.php',
                    data: {
                        department: department
                    },
                    success: function(response) {
                        // console.log(response); // Add this line for debugging
                        $('select[name="course_name"]').html(response);
                    }
                });
            });
        });

        $(document).ready(function() {
            // When the department dropdown changes
            $('select[name="department"]').on('change', function() {
                var department = $(this).val();

                // AJAX request to fetch the limit based on the selected department
                $.ajax({
                    type: 'POST',
                    url: 'fetch_limit.php',
                    data: {
                        department: department
                    },
                    success: function(response) {
                        // Assuming the response is a JSON object with a 'limit' property
                        var limit = JSON.parse(response).issue_limit;

                        // Update the input field with the fetched limit
                        $('input[name="issue_limit"]').val(limit);
                    }
                });
            });
        });


        $(document).ready(function() {
            // When the department dropdown changes
            $('select[name="course_name"]').on('change', function() {
                var course_name = $(this).val();

                // AJAX request to fetch books based on the selected department
                $.ajax({
                    type: 'POST',
                    url: 'fetch_years.php',
                    data: {
                        course_name: course_name
                    },
                    success: function(response) {
                        // console.log(response); // Add this line for debugging
                        $('select[name="year"]').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>