<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id;
    if (isset($_GET['code'])) {
        $id = $_GET['code'];
    }
    $sid;
    if (isset($_GET['stu'])) {
        $sid = $_GET['stu'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Books</title>

    <!-- Sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Styles for the page -->
    <style>
        .alert {
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
    </style>
</head>

<body>
    <div class="alert">

        <script>
            Swal.fire({
                title: "Are you sure?",
                text: "You want to return this Book!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Return it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = "<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>";
                    window.location.href = "deleteIssuedRecord.php?code=<?php echo $id; ?>&stu=<?php echo $sid; ?>";
                } else {
                    window.location.href = "viewAccRcrd.php";
                }
            });
        </script>

    </div>

</body>

</html>