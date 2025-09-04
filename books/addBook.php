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

    <title>Add Books</title>

    <!-- Temp Css file -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- Google Fonts Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- This File's CSS -->
    <link rel="stylesheet" href="addBooks.css">

    <!-- Sweet Alert Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    <?php
    include "../dashboard/tempFinal.php";
    ?>
    <div class="frm">
        <div class="alert">
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'successful') {
            ?>
                    <script>
                        Swal.fire({
                            title: "Great!",
                            text: "Book Added Successfully!",
                            icon: "success"
                        });
                    </script>
            <?php
                }
            }
            ?>
        </div>

        <h1>Add Book!</h1>

        <form action="addBooksDB.php" method="post">

            <div class="user__details">

                <div class="input__box">
                    <span class="details">Book Name</span>
                    <input type="text" name="book_name" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input__box">
                    <span class="details">Author</span>
                    <input type="text" name="author" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input__box">
                    <span class="details">Edition</span>
                    <input type="text" name="edition" id="edition" required oninput="validateEdition()">
                </div>

                <div class="input__box">
                    <span class="details">Publications</span>
                    <input type="text" name="publications" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input__box">
                    <span class="details">Quantity</span>
                    <input type="number" name="quantity" required min="0" oninput="validateInteg()" onkeydown="preventNegativeInput(event)">
                </div>

                <div class="input__box">
                    <span class="details">Price</span>
                    <input type="text" name="price" required min="0" oninput="validateInteg()" onkeydown="preventNegativeInput(event)">
                </div>

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
                    <span class="details">Status</span>
                    <div class="select-style">
                        <select name="status" class="details" required>
                            <option value="Issued">Issued</option>
                            <option value="Not Issued" selected>Not Issued</option>
                            <option value="Not To Issue">Not To Issue</option>
                        </select>
                    </div>
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

        function validateEdition() {
            var editionInput = document.getElementById("edition");
            var editionValue = editionInput.value;

            var validCharacters = /^[a-zA-Z0-9\s]+$/;

            if (!validCharacters.test(editionValue)) {
                editionInput.setCustomValidity("Please use only alphanumeric characters and spaces in the edition.");
            } else {
                editionInput.setCustomValidity("");
            }
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
            if (event.key === "-" || event.key === "e" || event.key === "." || event.key === "+" || event.key === "E") {
                event.preventDefault();
            }
        }
    </script>
</body>

</html>