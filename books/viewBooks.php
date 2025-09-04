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
        
        <h1>Books Records</h1>
        <table>
            <tr id="thh" style="background-color:var(--color-dark); color: var(--color-white); text-align:center">
                <td></td>
                <td>Code</td>
                <td>Book-Name</td>
                <td>Author</td>
                <td>Edition</td>
                <td>Publications</td>
                <td>Actual Stock</td>
                <td>Price</td>
                <td>Department</td>
                <td>View All</td>
                <!-- <td>Edit</td> -->
                <!-- <td>Delete</td> -->
            </tr>
            <!-- To get dynamic records -->
            <?php
            $lm = 10; // to change limit.
            $ofst = 0;
            $con = new mysqli('localhost', 'root', '', 'libraryProject');
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
                $pg = ($page - 1) * $lm; // calculated for offset.
                $qry = "SELECT id, book_name, author, edition, publications, quantity, price, department FROM books GROUP BY book_name LIMIT $lm OFFSET $pg;";

                $count = $pg + 1;
            } else {
                $qry = "SELECT id, book_name, author, edition, publications, quantity, price, department FROM books GROUP BY book_name LIMIT $lm OFFSET $pg;";

                $count = 1;
            }
            $res = $con->query($qry);
            // echo $x = $res->num_rows;
            // exit();
            $id;
            while ($result = $res->fetch_assoc()) {
                $id = $result['id'];
                echo "<tr>";
                echo "<td> $count </td>";
                $colm = $result['book_name'];
                $x1 = "select count(book_name) from books where book_name = '$colm';";
                $ress = $con->query($x1);
                $res1 = $ress->fetch_assoc();
                $qty = $res1['count(book_name)'];
                $result['quantity'] = $qty;
                foreach ($result as $key => $value) {


                    echo "<td> $value </td>";
                }
                echo "<td><a href='viewAllBooks.php?code=$id&bk=$colm&page=1' style='background-color:green; padding: 10%; border-radius:.5vw;  color:white;'>View</a></td>";

                // echo "<td><a href='updateBooks.php?code=$id' style='color:green;'><span class='material-icons-sharp'>
                // edit
                // </span></a></td>";

                // echo "<td><a href='deleteBooks.php?code=$id' style='color:red;''><span class='material-icons-sharp'>
                // delete
                // </span></a></td>";
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
                echo "<a href='viewBooks.php?page=$prev'>&laquo;</a>";
            } else {
                echo "<a href='#'>&laquo;</a>";
            }
            $qryy = "select id, book_name, author, edition, publications, quantity, price, department from books;";
            $re = $con->query($qryy);
            $rows = mysqli_num_rows($re);
            $box = ceil($rows / $lm);

            for ($i = 1; $i <= $box; $i++) {
                echo "<a href='viewBooks.php?page=$i'>$i</a>";
            }
            $next = $_GET['page'];
            $next = $next + 1;

            if ($next <= $box) {
                echo "<a href='viewBooks.php?page=$next'>&raquo;</a>";
            } else {
                echo "<a href='#'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
</body>

</html>