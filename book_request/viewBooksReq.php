<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Book Request</title>

    <!-- Temp file css -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- This file css -->
    <link rel="stylesheet" href="viewBooksReq.css">

    <!-- Google fonts link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" />

    <!-- Sweet alert link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
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
                        text: "Book Request Successfully Updated!",
                        icon: "success"
                    });
                </script>
            <?php
            } else if ($_GET['msg'] == 'added') {
            ?>
                <script>
                    Swal.fire({
                        title: "Great!",
                        text: "Books Request Added Successfully!",
                        icon: "success"
                    });
                </script>
        <?php
            }
        } ?>
    </div>

    <div class="tbl">
        <h1>Requested Books Records</h1>
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
                <td>Book Status</td>
                <td>Add Book</td>
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
                $qry = "SELECT * FROM book_request LIMIT $lm OFFSET $pg;";
                $count = $pg + 1;
            } else {
                $qry = "SELECT * FROM book_request LIMIT $lm OFFSET $pg;";
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
                $quantity = $result['quantity'];

                echo "<td><a href='#' onclick='handleAddBook($id, $quantity)' style='color:green;'><span class='material-icons-sharp'>
                add
                </span></a></td>";

                echo "<td><a href='updateBooksReq.php?code=$id' style='color:green;'><span class='material-icons-sharp'>
                edit
                </span></a></td>";

                echo "<td><a href='deleteBooksReq.php?code=$id' style='color:red;''><span class='material-icons-sharp'>
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
                echo "<a href='viewBooksReq.php?page=$prev'>&laquo;</a>";
            } else {
                echo "<a href='#'>&laquo;</a>";
            }
            $qryy = "select * from book_request;";
            $re = $con->query($qryy);
            $rows = mysqli_num_rows($re);
            $box = ceil($rows / $lm);

            for ($i = 1; $i <= $box; $i++) {
                echo "<a href='viewBooksReq.php?page=$i'>$i</a>";
            }
            $next = $_GET['page'];
            $next = $next + 1;

            if ($next <= $box) {
                echo "<a href='viewBooksReq.php?page=$next'>&raquo;</a>";
            } else {
                echo "<a href='#'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
    <script>
        function handleAddBook(id, quantity) {
            let comp = prompt('Enter the Books Number whose request is completed');
            // console.log(comp);

            if (comp !== null) {
                comp = parseInt(comp);

                if (!isNaN(comp)) {
                    if (comp === quantity) {
                        window.location.href = 'addToBookReqDB.php?code=' + id;
                    } else if (comp < quantity) {
                        window.location.href = 'addToBookReqDB2.php?code=' + id + '&quantity=' + comp;
                    } else {
                        alert('Invalid input. The entered value should be less than or equal to the quantity.');
                    }
                } 
                
                else {
                    alert('Invalid input. Please enter a valid number.');
                }
            }
        }
    </script>
</body>

</html>