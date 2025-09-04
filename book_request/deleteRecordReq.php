<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Delete Users</title>

    <!-- Sweet Alert Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styling for this page -->
    <style>
        .alert {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
    
</head>

<body>
    <?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id = isset($_GET['code']) ? $_GET['code'] : null;

    if ($id !== null) {
        $result = deleteRecord($con, $id);
        if ($result) {
    ?>
        <script>
            Swal.fire({
                title: "Deleted!",
                text: "Your Book Request has been deleted Successfully.",
                icon: "success"
            }).then(() => {
                window.location.href = "viewBooksReq.php?page=1";
            });
        </script>
    <?php
        }
    }
    
    // Function to delete the record
    function deleteRecord($con, $id)
    {
        $qry = "DELETE FROM book_request WHERE id = $id;";
        $res = $con->query($qry);
        return $res;
    }
    ?>
</body>
</html>