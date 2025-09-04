<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');
$qry = "select department_name from department;";
$res = $con->query($qry);

$book;
if (isset($_GET['bknm'])) {
    $book = $_GET['bknm'];
}
$author;
if (isset($_GET['auth'])) {
    $author = $_GET['auth'];
}
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
    <h1>Issue Book</h1>

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
                            text: "Book Issued Successfully!",
                            icon: "success"
                        });
                    </script>
                <?php
                } else if ($_GET['msg'] == 'cannot') {
                ?>
                    <script>
                        Swal.fire({
                            title: "Oppsss!",
                            text: "Book Cannot be issued the book is already issued!",
                            icon: "error"
                        });
                    </script>
                <?php
                } else if ($_GET['msg'] == 'limover') {
                ?>
                    <script>
                        Swal.fire({
                            title: "Oppsss!",
                            text: "Book Cannot be issued Your limit of issuing book is over!",
                            icon: "error"
                        });
                    </script>
            <?php
                }
            }
            ?>
        </div>

        <form action="addIssueBooksDB.php" method="post">
            <h3 style="color: var(--color-dark);">Student Details</h3>
            <div class="user__details">
                <div class="input__box">
                    <span class="details">Code</span>
                    <input type="number" id="issuer_id" name="issuer_id" required min="0" oninput="validateIssueLimit()" onkeydown="preventNegativeInput(event)">
                </div>

                <div class="input__box">
                    <span class="details">Name</span>
                    <input type="text" name="issuer_name" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Email</span>
                    <input type="text" name="issuer_email" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Department</span>
                    <input type="text" name="issuer_department" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Course</span>
                    <input type="text" name="issuer_course" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Year</span>
                    <input type="text" name="issuer_year" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Limit</span>
                    <input type="text" name="issuer_limit" id="lim" readonly required>
                </div>

                <div class="input__box">
                    <span class="details">Category</span>
                    <input type="text" name="issuer_category" readonly required>
                </div>
            </div>

            <div id="hd">
                <h3 style="color: var(--color-dark);">Books Details</h3>

                <span class="material-icons-sharp add_btn" style="color: var(--color-dark);">
                    add_circle
                </span>
            </div>
            <div class="user__details" id="uniq">
                
            </div>

            <!-- Submit Button -->
            <div class="button">
                <input type="submit" value="Submit">
            </div>

        </form>

        <div class="issuedBooks">
            <h1 style="margin: 2vh; margin-left: 25vw;">Books Issued Records</h1>
            <form id="searchForm" method="post" action="">
                <div class="outer">
                    <div id="showBooks">
                        <span class="details">Student Code</span>
                        <input type="text" name="issuer_id_form" id="issuer_id_form">
                    </div>
                </div>
            </form>

            <div class="cont1">
                <table id="issuedBooksTable">
                    <thead>
                        <tr style="background-color: var(--color-dark); color: var(--color-white);">
                            <th></th>
                            <!-- <th>Book Code</th> -->
                            <!-- <th>Student Code</th> -->
                            <th>Issuer Name</th>
                            <th>Course</th>
                            <th>Year</th>
                            <!-- <th>Limit</th> -->
                            <th>Book Code</th>
                            <th>Book Name</th>
                            <th>Author</th>
                            <th>Edition</th>
                            <th>Price</th>
                            <th>Return Book</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
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
            $("#issuer_id_form").on("change", function() {
                var value = $(this).val();
                // alert(value);
                $.ajax({
                    url: "searchdata.php",
                    type: "POST",
                    data: 'request=' + value,

                    success: function(data) {
                        $(".cont1").html(data);
                    }
                });
            });

            var maxRows;

            // Event handler for input[name="issuer_id"]
            $('input[name="issuer_id"]').on('change', function() {
                var issuerCode = $(this).val();

                // AJAX request to fetch issuer details including the limit based on the entered code
                $.ajax({
                    type: 'POST',
                    url: 'fetch_issuer_details.php', // Change the URL to the actual backend file
                    data: {
                        issuer_id: issuerCode
                    },
                    dataType: 'json',
                    success: function(response) {
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

                            // Store the limit in a global variable for later use
                            maxRows = response.issue_limit;
                            $('#lim').val(maxRows);
                            // console.log(maxRows);

                            // Log the updated value of maxRows
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
                    <input type="number" id="book_code" name="book_code[]" oninput="validateIssueLimit()" onkeydown="preventNegativeInput(event)" required>
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

                <span class="material-icons-sharp remove_btn" style="color: var(--color-dark); cursor: pointer;">
                remove_circle
                </span>
            </div> `);
            });

            $('#uniq').on('click', '.remove_btn', function() {
                // Find the closest .user__details and remove it
                $(this).closest('.user__details').remove();
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