<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feb Accounting</title>
    <link rel="stylesheet" href="../dashboard/tempFinal.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />
    <link rel="stylesheet" href="../issueBook/viewIssueBooks.css">
    <link rel="stylesheet" href="febAcc.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    include("../dashboard/tempFinal.php");
    ?>
    <div class="tbl">
        <div class="alert">
            <?php
            if (isset($_GET['msg'])) {
                if ($_GET['msg'] == 'success') {
            ?>
                    <script>
                        Swal.fire({
                            title: "Great!",
                            text: "Accounting Done Successfully!",
                            icon: "success"
                        });
                    </script>
                <?php
                } else if ($_GET['msg'] == 'failed') {
                ?>
                    <script>
                        Swal.fire({
                            title: "Oppsss!",
                            text: "Error in this!",
                            icon: "error"
                        });
                    </script><?php
                            }
                        } ?>
        </div>
        <h1>Accounting</h1>
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
                <tr id="thh" style="background-color:var(--color-dark); color: var(--color-white); text-align:center">
                    <td></td>
                    <td>Code</td>
                    <td>Student Code</td>
                    <td>Issuer Name</td>
                    <td>Course</td>
                    <td>Year</td>
                    <td>Limit</td>
                    <td>Category</td>
                    <td>Book Code</td>
                    <td>Book Name</td>
                    <td>Author</td>
                    <td>Edition</td>
                    <td>Price</td>
                    <td>Book Return</td>
                </tr>
            </table>
        </div>

        <div id="hd">
            <form action="febAccDB.php" method="post">
                <div class="user__details">
                    <h3 style="position: relative; top:2vh; margin-right: 2%">Student Id</h3>
                    <div class="input__box">
                        <input type="text" name="student_id" id="issuer_id_form" readonly required>
                    </div>
                    <h3 style="position: relative; top:2vh; margin-right: 2%; margin-left: 6%;">Total Amount Payable</h3>
                    <div class="input__box">
                        <input type="text" name="book_total_amount" id="book_TAmount" readonly required>
                    </div>
                    <h3 style="position: relative; top:2vh; margin-right: 2%; margin-left: 6%;">Paid Amount</h3>
                    <div class="input__box">
                        <input type="number" name="paid_amount" id="paid_amt" required min="0" oninput="validateIssueLimit()" onkeydown="preventNegativeInput(event)">
                    </div>
                </div>
                <div class="button">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function validateIssueLimit() {
            var issueLimitInput = document.getElementById("paid_amt");

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

        $(document).ready(function() {
            $("#issuer_id_form").on("blur", function() {
                var value = $(this).val();

                $.ajax({
                    url: "searchdata3.php",
                    type: "POST",
                    data: 'request=' + value,
                    success: function(data) {
                        $(".cont1").html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data from searchdata3.php:", error);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'searchdata4.php', // Change the URL to the actual backend file
                    data: {
                        issuer_id: value
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.error) {
                            console.error(response.error);
                        } else {
                            $('input[name="student_id"]').val(value);
                            $('input[name="book_total_amount"]').val(response.totalAmount);
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