<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Registered Request</title>

    <!-- Temp file css -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- This file css -->
    <link rel="stylesheet" href="viewRegisterReq.css">

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
                        text: "Record Successfully Updated!",
                        icon: "success"
                    });
                </script>
        <?php
            }
        } ?>
    </div>
    
    <!-- To Show table -->
    <div class="tbl">
        <h1>Users Request Records</h1>
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
                <td>Accept</td>
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
                $qry = "select * from registerRequest limit $lm offset $pg;";
                $count = $pg + 1;
            } else {
                $qry = "select * from registerRequest limit $lm offset $ofst;";
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

                echo "<td><a href='updateUsersReq.php?code=$id' style='background-color:green; color: var(--color-white); padding:14%; border-radius: .5vw'>Edit</a></td>";

                echo "<td><a href='addToUsers.php?code=$id' style='background-color:green; color: var(--color-white); padding:9%; border-radius: .5vw'>Accept</a></td>";

                echo "<td><a href='deleteRegUser1.php?code=$id' style='background-color:red; color: var(--color-white); padding:9%; border-radius: .5vw'>Delete</a></td>";

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
                echo "<a href='registerRequest.php?page=$prev'>&laquo;</a>";
            } else {
                echo "<a href='#'>&laquo;</a>";
            }
            $qryy = "select * from registerRequest;";
            $re = $con->query($qryy);
            $rows = mysqli_num_rows($re);
            $box = ceil($rows / $lm);

            for ($i = 1; $i <= $box; $i++) {
                echo "<a href='registerRequest.php?page=$i'>$i</a>";
            }
            $next = $_GET['page'];
            $next = $next + 1;

            if ($next <= $box) {
                echo "<a href='registerRequest.php?page=$next'>&raquo;</a>";
            } else {
                echo "<a href='#'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
</body>

</html>