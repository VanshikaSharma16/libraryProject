<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View Course</title>

    <!-- Temp file css -->
    <link rel="stylesheet" href="../dashboard/tempFinal.css">

    <!-- This file css -->
    <link rel="stylesheet" href="viewCourse.css">

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
                        text: "Course Successfully Updated!",
                        icon: "success"
                    });
                </script>
        <?php
            }
        } ?>
    </div>
    
    <!-- To Show table -->
    <div class="tbl">
        <h1>Course Records</h1>
        <table>
            <tr id="thh" style="background-color:var(--color-dark); color: var(--color-white); text-align:center">
                <td></td>
                <td>Code</td>
                <td>Course Name</td>
                <td>Department</td>
                <td>Type</td>
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
                $qry = "select id, course_name, department, type from course limit $lm offset $pg;";
                $count = $pg + 1;
            } else {
                $qry = "select id, course_name, department, type from course limit $lm offset $ofst;";
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
                echo "<td><a href='updateCourse.php?code=$id' style='color:green;'><span class='material-icons-sharp'>
                edit
                </span></a></td>";
                echo "<td><a href='deleteCourse.php?code=$id' style='color:red;''><span class='material-icons-sharp'>
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
                echo "<a href='viewCourse.php?page=$prev'>&laquo;</a>";
            } else {
                echo "<a href='#'>&laquo;</a>";
            }
            $qryy = "select * from userForm;";
            $re = $con->query($qryy);
            $rows = mysqli_num_rows($re);
            $box = ceil($rows / $lm);

            for ($i = 1; $i <= $box; $i++) {
                echo "<a href='viewCourse.php?page=$i'>$i</a>";
            }
            $next = $_GET['page'];
            $next = $next + 1;

            if ($next <= $box) {
                echo "<a href='viewCourse.php?page=$next'>&raquo;</a>";
            } else {
                echo "<a href='#'>&raquo;</a>";
            }
            ?>
        </div>
    </div>
    <script src="../dashboard/tempFinal.js"></script>
</body>

</html>