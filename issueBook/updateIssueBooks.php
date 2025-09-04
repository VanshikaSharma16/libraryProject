<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');
$id;
if (isset($_GET['code'])) {
    $id = $_GET['code'];
}
$qry = "select * from issue_book where id = $id;";
$res = $con->query($qry);
$result = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Issue Books</title>

    <!-- Temp Css file -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- Google Fonts Link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- This File's CSS -->
    <link rel="stylesheet" href="addIssueBooks.css">

    <!-- Sweet Alert Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include "../dashboard/tempFinal.php";
    ?>
    <h1>Update Issued Books</h1>

    <div class="frm">
        <form action="updateIssueBooksDB.php?code=<?php echo $id ?>" method="post">
            <h3 style="color: var(--color-dark);">Student Details</h4>
                <div class="user__details">
                    <div class="input__box">
                        <span class="details">Code</span>
                        <input type="number" id="issuer_id" name="issuer_id" value="<?php echo $result['issuer_id'] ?>" required min="0" oninput="validateIssueLimit()" onkeydown="preventNegativeInput(event)">
                    </div>

                    <div class="input__box">
                        <span class="details">Name</span>
                        <input type="text" name="issuer_name" value="<?php echo $result['issuer_name'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Email</span>
                        <input type="text" name="issuer_email" value="<?php echo $result['issuer_email'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Department</span>
                        <input type="text" name="issuer_department" value="<?php echo $result['issuer_department'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Course</span>
                        <input type="text" name="issuer_course" value="<?php echo $result['issuer_course'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Year</span>
                        <input type="text" name="issuer_year" value="<?php echo $result['issuer_year'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Limit</span>
                        <input type="text" name="issuer_limit" id="lim" value="<?php echo $result['issuer_limit'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Category</span>
                        <input type="text" name="issuer_category" value="<?php echo $result['issuer_category'] ?>" readonly required>
                    </div>
                </div>

                <div id="hd">
                    <h3 style="color: var(--color-dark); margin: 2vh; margin-left: 0px;">Books Details</h4>

                </div>
                <div class="user__details" id="uniq">

                    <div class="input__box">
                        <span class="details">Code</span>
                        <input type="number" id="book_code" name="book_code" value="<?php echo $result['book_code'] ?>" oninput="validateIssueLimit()" onkeydown="preventNegativeInput(event)"  required>
                    </div>

                    <div class="input__box">
                        <span class="details">Book Name</span>
                        <input type="text" name="book_name" value="<?php echo $result['book_name'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Author</span>
                        <input type="text" name="author" value="<?php echo $result['author'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Edition</span>
                        <input type="text" name="book_edition" value="<?php echo $result['book_edition'] ?>" readonly required>
                    </div>

                    <div class="input__box">
                        <span class="details">Edition</span>
                        <input type="text" name="book_price" value="<?php echo $result['book_price'] ?>" readonly required>
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="button">
                    <input type="submit" value="Submit">
                </div>

        </form>
    </div>

    <script src="../dashboard/tempFinal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function validateIssueLimit() {
            var issueLimitInput = document.getElementById("issuer_id");

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

        function validateCode() {
            var codeInput = document.getElementById("book_code");
            var codeValue = codeInput.value;

            // Check if the code contains only digits and is non-negative
            var validCode = /^\d+$/;

            if (!validCode.test(codeValue) || parseInt(codeValue) < 0) {
                codeInput.setCustomValidity("Please enter a valid non-negative integer code.");
            } else {
                codeInput.setCustomValidity("");
            }
        }
        // let l = document.getElementById("lim").value;
        // console.log(l);

        $(document).ready(function() {
            $('input[name="issuer_id"]').on('change', function() {
                var issuerCode = $(this).val();

                // AJAX request to fetch issuer details based on the entered code
                $.ajax({
                    type: 'POST',
                    url: 'fetch_issuer_details.php',
                    data: {
                        issuer_id: issuerCode
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Update the issuer name and email fields with the fetched data
                        if (response.error) {
                            console.error(response.error);
                        } else {
                            // Corrected property names
                            $('input[name="issuer_name"]').val(response.name);
                            $('input[name="issuer_email"]').val(response.email);
                            $('input[name="issuer_department"]').val(response.department);
                            $('input[name="issuer_course"]').val(response.course_name);
                            $('input[name="issuer_year"]').val(response.year);
                            $('input[name="issuer_limit"]').val(response.issue_limit);
                            $('input[name="issuer_category"]').val(response.category);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });


            $(".add_btn").click(function(e) {
                e.preventDefault();
                $("#uniq").prepend(`
                <div class="user__details" id="uniq">
                <div class="input__box">
                    <span class="details">Code</span>
                    <input type="number" id="book_code" name="book_code[]" required>
                </div>

                <div class="input__box">
                    <span class="details">Book Name</span>
                    <input type="text" name="book_name[]" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Author</span>
                    <input type="text" name="author[]" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Edition</span>
                    <input type="text" name="book_edition[]" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Price</span>
                    <input type="text" name="book_price[]" readonly required>
                </div>
            </div> 
                `);
            });

            // Event delegation for dynamically added rows
            $('#uniq').on('change', 'input[name^="book_code"]', function() {
                var bookCode = $(this).val();
                var currentRow = $(this).closest('.user__details');

                $.ajax({
                    type: "POST",
                    url: "fetch_book_details.php",
                    data: {
                        book_code: bookCode
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Update the book details fields with the fetched data
                        if (response.error) {
                            console.error(response.error);
                        } else {
                            // Corrected property names
                            currentRow.find('input[name^="book_name"]').val(response.book_name);
                            currentRow.find('input[name^="author"]').val(response.author);
                            currentRow.find('input[name^="book_edition"]').val(response.edition);
                            currentRow.find('input[name^="book_price"]').val(response.price);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>

</body>

</html>