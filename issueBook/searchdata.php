<?php

$con = new mysqli('localhost', 'root', '', 'libraryProject');

if (isset($_POST['request'])) {
    $request = $_POST['request'];

    $query = "SELECT issuer_name, issuer_course, issuer_year, book_code, book_name, author, book_edition FROM issue_book WHERE issuer_id = $request";

    $result = $con->query($query);

    $count = mysqli_num_rows($result);
}
if ($count > 0) { ?>
    <table id="issuedBooksTable">
        <thead>
            <tr id="thh" style="background-color: var(--color-dark); color: var(--color-white);">
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
            </tr>
        </thead>
        <tbody>
            <?php
            $arr_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $id = 0;
            foreach ($arr_data as $key => $valuess) {
                echo '<tbody>';
                echo "<tr>";
                echo "<td>" . ++$id . "</td>";
                foreach ($valuess as $key => $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    <?php
} else {
    echo "<p style='color: red;'>No Records Found!</p>";
} ?>

    </table>

    <?php
    $con->close();
