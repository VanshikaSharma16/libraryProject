<?php
    $con = new mysqli('localhost', 'root', '', 'libraryProject');
    $id;

    if (isset($_GET['code'])) {
        $id = $_GET['code'];
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
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete Book!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "deleteAllRecord.php?code=<?php echo $id; ?>";
                }
                else{
                    window.location.href = "viewAllBooks.php?code=<?php echo $id; ?>";
                }
            });
        </script>
        
    </div>

</body>

</html>
