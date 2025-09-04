<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Department</title>

    <!-- Temp CSS -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- This file CSS -->
    <link rel="stylesheet" href="addDepartment.css">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- Sweet Alerts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include "../dashboard/tempFinal.php";
    ?>

    <div class="frm">

        <div class="alert">
            <?php if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'userexists') {
            ?>
                    <script>
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "The Department Already Exist!"
                        });
                    </script>

                <?php
                } else if ($_GET['msg'] == 'successful') {
                ?>
                    <script>
                        Swal.fire({
                            title: "Great!",
                            text: "Department Added Successfully!",
                            icon: "success"
                        });
                    </script>
            <?php
                }
            } ?>
        </div>

        <h1>Add Department</h1>

        <form action="addDepartmentDB.php" method="post">

            <div class="user__details">

                <div class="input__box">
                    <span class="details">Department Name</span>
                    <input type="text" name="department_name" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input__box">
                    <span class="details">Book Issue Limit</span>
                    <input type="number" name="issue_limit" id="issue_limit" required min="0" oninput="validateIssueLimit()" onkeydown="preventNegativeInput(event)">
                </div>

            </div>

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

        function validateIssueLimit() {
            var issueLimitInput = document.getElementById("issue_limit");

            if (issueLimitInput.value < 0) {
                issueLimitInput.setCustomValidity("Please enter a non-negative number.");
            } else {
                issueLimitInput.setCustomValidity("");
            }
        }

        function preventNegativeInput(event) {
            // Prevent the entry of the minus sign (-) for negative numbers
            if (event.key === "-" || event.key === "e" || event.key === "." || event.key === "+" || event.key === "E") {
                event.preventDefault();
            }
        }
    </script>
</body>

</html>