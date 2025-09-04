<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');
$book;
if (isset($_GET['bk'])) {
    $book = $_GET['bk'];
}

$author;
if (isset($_GET['au'])) {
    $author = $_GET['au'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Issued Books</title>

    <!-- Temp file css -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- This file css -->
    <link rel="stylesheet" href="viewIssueBooks.css">

    <!-- Google fonts link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- Sweet alert link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!-- For templete -->
    <?php
    include "../dashboard/tempFinal.php";
    ?>

    <div class="alert">
        <?php if (isset($_GET['msg'])) {
            if ($_GET['msg'] == 'successful') {
        ?>
                <script>
                    Swal.fire({
                        title: "Great!",
                        text: "Issue Book Record Successfully Updated!",
                        icon: "success"
                    });
                </script>
        <?php
            }
        } ?>
    </div>

    <!-- To Show table -->
    <div class="tbl">
        <h1>Issued Books Records</h1>
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
                    <td>Edit</td>
                    <td>Book Return</td>
                </tr>
                <!-- To get dynamic records -->
                <?php
                $lm = 10; // to change limit.
                $ofst = 0;
                $con = new mysqli('localhost', 'root', '', 'libraryProject');
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                    $pg = ($page - 1) * $lm; // calculated for offset.
                    $qry = "select id, issuer_id, issuer_name, issuer_course, issuer_year, issuer_limit, issuer_category, book_code, book_name, author, book_edition, book_price from issue_book limit $lm offset $pg;";
                    $count = $pg + 1;
                } else {
                    $qry = "select id, issuer_id, issuer_name, issuer_course, issuer_year, issuer_limit, issuer_category, book_code, book_name, author, book_edition, book_price from issue_book limit $lm offset $ofst;";
                    $count = 1;
                }
                $res = $con->query($qry);
                $id;
                while ($result = $res->fetch_assoc()) {
                    $sid = $result['issuer_id'];
                    $id = $result['id'];
                    $bookcode = $result['book_code'];
                    echo "<tr>";
                    echo "<td> $count </td>";
                    foreach ($result as $key => $value) {
                        echo "<td> $value </td>";
                    }
                    echo "<td><a href='updateIssueBooks.php?code=$id&bkcode=$bookcode' style='background-color:green; color: var(--color-white); padding: 13.5%; border-radius: .5vw;'>Edit</a></td>";

                    echo "<td><a href='deleteIssueBooks.php?code=$id&stu=$sid' style='background-color:red; color: var(--color-white); padding: 8%; border-radius: .5vw'>Return</a></td>";
                    echo "</tr>";
                    $count++;
                }
                ?>
            </table>
        </div>
        <div class="pagination">
            <?php
            $prev = $_GET['page'];
            $prev = $prev - 1;
            if ($prev > 0) {
                echo "<a href='viewIssueBooks.php?page=$prev'>&laquo;</a>";
            } else {
                echo "<a href='#'>&laquo;</a>";
            }
            $qryy = "select id, issuer_id, issuer_name, issuer_course, issuer_year, issuer_limit, issuer_category, book_code, book_name, author, book_edition, book_price from issue_book;";
            $re = $con->query($qryy);
            $rows = mysqli_num_rows($re);
            $box = ceil($rows / $lm);

            for ($i = 1; $i <= $box; $i++) {
                echo "<a href='viewIssueBooks.php?page=$i'>$i</a>";
            }
            $next = $_GET['page'];
            $next = $next + 1;

            if ($next <= $box) {
                echo "<a href='viewIssueBooks.php?page=$next'>&raquo;</a>";
            } else {
                echo "<a href='#'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#issuer_id_form").on("blur", function() {
                var value = $(this).val();
                // console.log("Search value:", value);
                $.ajax({
                    url: "searchdata2.php",
                    type: "POST",
                    data: 'request=' + value,
                    success: function(data) {
                        // console.log("Response:", data);
                        $(".cont1").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>