<?php
$con = new mysqli('localhost', 'root', '', 'libraryProject');

if (isset($_POST['request'])) {
    $request = $_POST['request'];

    $query = "SELECT id, name, email, password,category, department, course_name, year, issue_limit FROM userForm WHERE email = '$request'";

    $result = $con->query($query);

    $count = mysqli_num_rows($result);
}
if ($count > 0) { ?>
    <table id="issuedBooksTable">
        <thead>
            <tr id="thh" style="background-color: var(--color-dark); color: var(--color-white);">
                <td></td>
                <td>Code</td>
                <td>Name</td>
                <td>Email</td>
                <td>Password</td>
                <td>Category</td>
                <td>department</td>
                <td>Course</td>
                <td>Year</td>
                <td>Limit</td>
                <td>Edit</td>
                <td>Book Return</td>
            </tr>
        </thead>
        <tbody><?php
                $arr_data = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $idd = 0;
                foreach ($arr_data as $key => $valuess) {
                    echo '<tbody>';
                    echo '<tr>';
                    echo "<td>" . ++$idd . "</td>";
                    foreach ($valuess as $key => $value) {
                        $id = $valuess['id'];
                        echo "<td>" . $value . "</td>";
                    }
                    echo "<td><a href='updateUsers.php?code=$id' style='color:green;'><span class='material-icons-sharp'>
                edit
                </span></a></td>";
                    echo "<td><a href='deleteUsers.php?code=$id' style='color:red;''><span class='material-icons-sharp'>
                delete
                </span></a></td>";
                    echo "</tr>";
                }
                ?>
        </tbody>
    </table>
<?php
} else {
    echo "<p style='color: red; font-size: 19px; margin-top: 3%'>No records found!</p>";
}
?>

<?php
$con->close();
?>