<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');

$id;
if (isset($_GET['code'])) {
    $id = $_GET['code'];
    $qry = "select book_name from books where id=$id;";
    $res = $con->query($qry);
    $row = $res->fetch_assoc();
    $book_name = $row['book_name'];
}

$book_name;
if (isset($_GET['bk'])) {
    $book_name = $_GET['bk'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Books</title>

    <!-- Temp file css -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- This file css -->
    <link rel="stylesheet" href="viewBooks.css">

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
                        text: "Book Successfully Updated!",
                        icon: "success"
                    });
                </script>
        <?php
            }
        } ?>
    </div>

    <!-- To Show table -->
    <div class="tbl">
        <div class="hd">
            <a href="viewBooks.php?page=1" style="display: inline-block; top: 5vh;">
            <span class="material-icons-sharp">
                arrow_back
            </span>
            </a>
        <h1 style="display: inline-block; left: 35%;">Books Records</h1>
        </div>
        
        <table>
            <tr id="thh" style="background-color:var(--color-dark); color: var(--color-white); text-align:center">
                <td></td>
                <td>Code</td>
                <td>Book-Name</td>
                <td>Author</td>
                <td>Edition</td>
                <td>Publications</td>
                <td>Quantity</td>
                <td>Price</td>
                <td>Department</td>
                <td>Status</td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
            <!-- To get dynamic records -->
            <?php
            $lm = 10; // to change limit.
            $ofst = 0;
            $con = new mysqli('localhost', 'root', '', 'libraryProject');
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $pg = ($page - 1) * $lm; // calculated for offset.
                $qry = "select * from books where book_name = '$book_name' limit $lm offset $pg;";
                $count = $pg + 1;
            } else {
                $qry = "select * from books where book_name = '$book_name' limit $lm offset $ofst;";
                $count = 1;
            }
            $res = $con->query($qry);
            $id;
            while ($result = $res->fetch_assoc()) {
                $id = $result['id'];
                echo "<tr>";
                echo "<td> $count </td>";
                foreach ($result as $key => $value) {
                    echo "<td> $value </td>";
                }

                echo "<td><a href='updateAllBooks.php?code=$id' style='color:green;'><span class='material-icons-sharp'>
                edit
                </span></a></td>";
                echo "<td><a href='deleteAllBooks.php?code=$id' style='color:red;''><span class='material-icons-sharp'>
                delete
                </span></a></td>";
                echo "</tr>";
                $count++;
            }
            ?>
        </table>
        <div class="pagination">
            <?php
            $prev = $_GET['page'];
            $prev = $prev - 1;
            if ($prev > 0) {
                echo "<a href='viewAllBooks.php?page=$prev'>&laquo;</a>";
            } else {
                echo "<a href='#'>&laquo;</a>";
            }
            $qryy = "select * from books where book_name = '$book_name';";
            $re = $con->query($qryy);
            $rows = mysqli_num_rows($re);

            $box = ceil($rows / $lm);

            for ($i = 1; $i <= $box; $i++) {
                echo "<a href='viewAllBooks.php?code=$id&bk=$book_name&page=$i'>$i</a>";
            }
            
            $next = $_GET['page'];
            $next = $next + 1;

            if ($next <= $box) {
                echo "<a href='viewAllBooks.php?page=$next'>&raquo;</a>";
            } else {
                echo "<a href='#'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
</body>

</html>