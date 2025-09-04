<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id;
    if (isset($_GET['username'])) {
        $id = $_GET['username'];
    }
    $qry = "select * from userForm where email = '$id';";
    $res = $con->query($qry);
    $r = $res->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student </title>

    <!-- This file CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        table td{
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="mn">

        <div class="content">

            <div class="im flex justify-around">
                <img src="../imgs/s2.png" alt="">
                <img src="../imgs/s.png" alt="">
            </div>

            <div class="x flex">
                <p id="outer">Name:</p>
                <p id="inner"><?php echo strtoupper($r['name']); ?></p>
            </div>

            <div class="x flex">
                <p id="outer">E-Mail:</p>
                <p id="inner"><?php echo $r['email']; ?></p>
            </div>

            <div class="x flex">
                <p id="outer">Department:</p>
                <p id="inner"><?php echo $r['department']; ?></p>
            </div>

            <div class="x">
                <p id="outer">Books Issued:</p>
                <p id="inner">
                <table style="width: 37.5vw; position:relative; top: -9vh; box-shadow: 1px 1px 15px grey;">
                    <tr id="thh" style="background-color:var(--color-dark); color: var(--color-white); text-align:center;">
                        <td>Code</td>
                        <td>Book Name</td>
                        <td>Author</td>
                    </tr>
                    <!-- To get dynamic records -->
                    <?php
                    $con = new mysqli('localhost', 'root', '', 'libraryProject');
                    $qry = "select book_code, book_name, author from issue_book where issuer_email = '$id'";
                    $res = $con->query($qry);
                    $id;
                    while ($result = $res->fetch_assoc()) {
                        echo "<tr>";
                        // echo "<td> </td>";
                        foreach ($result as $key => $value) {
                            echo "<td> $value </td>";
                        }
                        $count++;
                    }
                    ?>
                </table>
                </p>
            </div>
        </div>
    </div>
</body>

</html>