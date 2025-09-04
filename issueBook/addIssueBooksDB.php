<?php
function saveData($arr, $tblname)
{
    $con = new mysqli("localhost", "root", "", "libraryProject");

    extract($arr);

    $key = array_keys($arr);
    $key = implode(',', $key);

    $count = count($book_code);
    $issuerLimit = $issuer_limit;

    for ($i = 0; $i < $count; $i++) {
        $values = [
            $issuer_id,
            $issuer_name,
            $issuer_email,
            $issuer_department,
            $issuer_course,
            $issuer_year,
            $issuer_limit,
            $issuer_category,
            $book_code[$i],
            $book_name[$i],
            $author[$i],
            $book_edition[$i],
            $book_price[$i]
        ];

        $values = array_map(function ($x) use ($con) {
            return is_numeric($x) ? $x : "'" . $con->real_escape_string($x) . "'";
        }, $values);

        $values = implode(',', $values);

        if ($issuerLimit > 0) {
            $checkQuery = "SELECT * FROM issue_book WHERE book_code = $book_code[$i];";
            $checkResult = $con->query($checkQuery);
            $numRows = $checkResult->num_rows;

            if ($numRows != 0) {
                header("Location: addIssueBook.php?msg=cannot");
            } else {
                $insertQuery = "INSERT INTO $tblname ($key) VALUES ($values);";
                $insertResult = $con->query($insertQuery);

                if ($insertResult) {
                    $updateUserQuery = "UPDATE userForm SET issue_limit = issue_limit - 1 WHERE id= $issuer_id;";
                    $updateUserResult = $con->query($updateUserQuery);

                    if ($updateUserResult) {
                        $updateIssueBookQuery = "UPDATE issue_book SET issuer_limit = issuer_limit - 1 WHERE issuer_id= $issuer_id;";
                        $updateIssueBookResult = $con->query($updateIssueBookQuery);

                        if ($updateIssueBookResult) {
                            $updateBookQuery = "UPDATE books SET status = 'Issued' WHERE id = $book_code[$i];";
                            $updateBookResult = $con->query($updateBookQuery);

                            if ($updateBookResult) {
                                header("Location: addIssueBook.php?msg=successful");
                            } else {
                                header("Location: addIssueBook.php?msg=cannot");
                            }
                        }
                    }
                } else {
                    header("Location: addIssueBook.php?msg=limover");
                }
            }
        }
    }
}
saveData($_POST, 'issue_book');
?>
