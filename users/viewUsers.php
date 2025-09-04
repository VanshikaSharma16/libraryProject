<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Users</title>

    <!-- Temp file css -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- This file css -->
    <link rel="stylesheet" href="viewUsers.css">

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
                        text: "User Successfully Updated!",
                        icon: "success"
                    });
                </script>
        <?php
            }
        } ?>
    </div>

    <!-- To Show table -->
    <div class="tbl">
        <h1>Users Records</h1>
        <form id="searchForm" method="post" action="">
            <div class="outer">
                <div id="showBooks">
                    <span class="details">User Email</span>
                    <input type="text" name="email" id="email">
                </div>
            </div>
        </form>
        <div class="cont1">
            <table>
                <tr id="thh" style="background-color:var(--color-dark); color: var(--color-white); text-align:center">
                    <td></td>
                    <td>Code</td>
                    <td>Name</td>
                    <td>E-Mail</td>
                    <td>Password</td>
                    <td>Category</td>
                    <td>Department</td>
                    <td>Course</td>
                    <td>Year</td>
                    <td>Issue Book Limit</td>
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
                    $qry = "select * from userForm limit $lm offset $pg;";
                    $count = $pg + 1;
                } else {
                    $qry = "select * from userForm limit $lm offset $ofst;";
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
                    echo "<td><a href='updateUsers.php?code=$id' style='color:green;'><span class='material-icons-sharp'>
                edit
                </span></a></td>";
                    echo "<td><a href='deleteUsers.php?code=$id' style='color:red;''><span class='material-icons-sharp'>
                delete
                </span></a></td>";
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
                echo "<a href='viewUsers.php?page=$prev'>&laquo;</a>";
            } else {
                echo "<a href='#'>&laquo;</a>";
            }
            $qryy = "select * from userForm;";
            $re = $con->query($qryy);
            $rows = mysqli_num_rows($re);
            $box = ceil($rows / $lm);

            for ($i = 1; $i <= $box; $i++) {
                echo "<a href='viewUsers.php?page=$i'>$i</a>";
            }
            $next = $_GET['page'];
            $next = $next + 1;

            if ($next <= $box) {
                echo "<a href='viewUsers.php?page=$next'>&raquo;</a>";
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
            $("#email").on("blur", function() {
                var value = $(this).val();
                // alert(value);
                // console.log("Search value:", value);
                $.ajax({
                    url: "searchemail.php",
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