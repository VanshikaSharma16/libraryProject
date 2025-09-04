<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');

if (isset($_POST['request'])) {
    $request = $_POST['request'];

    $query = "SELECT id, issuer_id, issuer_name, issuer_course, issuer_year,issuer_limit, issuer_category, book_code, book_name, author, book_edition, book_price FROM issue_book WHERE issuer_id = $request";

    $result = $con->query($query);

    $count = mysqli_num_rows($result);
}
if ($count > 0) { ?>
    <table id="issuedBooksTable">
        <thead>
            <tr id="thh" style="background-color: var(--color-dark); color: var(--color-white);">
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
        </thead>
        <tbody><?php
                $arr_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $id = 0;
                foreach ($arr_data as $key => $valuess) {
                    echo '<tbody>';
                    echo '<tr>';
                    echo "<td>" . ++$id . "</td>";
                    foreach ($valuess as $key => $value) {
                        echo "<td>" . $value . "</td>";
                    }
                    echo "<td><a href='updateIssueBooks.php?code=$id&bkcode=$bookcode' style='background-color:green; color: var(--color-white); padding: 17%; border-radius: .5vw'>Edit</a></td>";

                    echo "<td><a href='deleteIssueBooks.php?code=$id' style='background-color:red; color: var(--color-white); padding: 10%; border-radius: .5vw'>Return</a></td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
<?php
} else {
    echo "<p style='color: red; font-size: 19px'>No records found!</p>";
}
?>

<?php
$con->close();
?>