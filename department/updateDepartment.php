<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id;
    if (isset($_GET['code'])) {
        $id = $_GET['code'];
    }

    $qry = "select * from department where id = $id;";
    $res = $con->query($qry);
    $r = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update Department</title>

    <!-- Temp file css -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- This file styling -->
    <link rel="stylesheet" href="addDepartment.css">

    <!-- Box icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
</head>

<body>
    <?php
    include "../dashboard/tempFinal.php";
    ?>
    <div class="frm">

        <h1>Update here!</h1>

        <form action="updateDepartmentDB.php?code=<?php echo $id; ?>" method="post">

            <div class="user__details">

                <div class="input__box">
                    <span class="details">Department Name</span>
                    <input type="text" name="department_name" value="<?php echo $r['department_name'] ?>" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input__box">
                    <span class="details">Book Issue Limit</span>
                    <input type="number" name="issue_limit" value="<?php echo $r['issue_limit'] ?>" min="0" oninput="validateIssueLimit()" onkeydown="preventNegativeInput(event)" required>
                </div>

            </div>

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