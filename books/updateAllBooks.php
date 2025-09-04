<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');

$id;
if (isset($_GET['code'])) {
    $id = $_GET['code'];
}

$qry = "select * from books where id = $id;";
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
    <link rel="stylesheet" href="addBooks.css">

    <!-- Google Fonts link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
</head>

<body>
    <?php
    include "../dashboard/tempFinal.php";
    ?>

    <div class="frm" style="top:11vh;">
        <h1>Update here!</h1>

        <form action="updateAllBooksDB.php?code=<?php echo $id; ?>" method="post">

            <div class="user__details">

                <div class="input__box">
                    <span class="details">Book Name</span>
                    <input type="text" name="book_name" value="<?php echo $result['book_name'] ?>" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input__box">
                    <span class="details">Author</span>
                    <input type="text" name="author" value="<?php echo $result['author'] ?>" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input__box">
                    <span class="details">Edition</span>
                    <input type="text" name="edition" id="edition" value="<?php echo $result['edition'] ?>" oninput="validateEdition()" required>
                </div>

                <div class="input__box">
                    <span class="details">Publications</span>
                    <input type="text" name="publications" value="<?php echo $result['publications'] ?>" onkeyup="lettersOnly(this)" required>
                </div>

                <div class="input__box">
                    <span class="details">Quantity</span>
                    <input type="number" name="quantity" value="<?php echo $result['quantity'] ?>" min="0" oninput="validateInteg()" onkeydown="preventNegativeInput(event)" required>
                </div>

                <div class="input__box">
                    <span class="details">Price</span>
                    <input type="text" name="price" value="<?php echo $result['price'] ?>" min="0" oninput="validateInteg()" onkeydown="preventNegativeInput(event)" required>
                </div>

                <!-- Inside your PHP code -->
                <div class="input__box">
                    <span class="details">Department</span>
                    <div class="select-style">
                        <select name="department" class="details" required>
                            <option value="<?php echo $result['department'] ?>"><?php echo $result['department'] ?></option>
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
                            <option value="<?php echo $result['status'] ?>"><?php echo $result['status'] ?></option>
                            <option value="Issued">Issued</option>
                            <option value="Not Issued">Not Issued</option>
                            <option value="Specialized">Specialized</option>
                        </select>
                    </div>
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

        function validateEdition() {
            var editionInput = document.getElementById("edition");
            var editionValue = editionInput.value;

            // Check if the edition contains only alphanumeric characters and spaces
            var validCharacters = /^[a-zA-Z0-9\s]+$/;

            if (!validCharacters.test(editionValue)) {
                editionInput.setCustomValidity("Please use only alphanumeric characters and spaces in the edition.");
            } else {
                editionInput.setCustomValidity("");
            }
        }
        function validateInteg() {
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