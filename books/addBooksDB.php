<?php
function saveData($arr, $tblname)
{
    extract($arr);
    if (!isset($arr['quantity'])) {
        return;
    }

    $k = array_keys($arr);
    $k = implode(',', $k);

    $v = array_values($arr);
    $v = implode(',', array_map(function ($x) {
        return is_numeric($x) ? $x : "'$x'";
    }, $v));

    $con = new mysqli('localhost', 'root', '', 'libraryProject');

    for ($i = 0; $i < $quantity; $i++) {

        // Set the quantity to 1 for each iteration
        $arr['quantity'] = 1;

        // // Update $v with the modified 'quantity' value
        // $v = implode(',', array_map(function ($x) {
        //     return is_numeric($x) ? $x : "'$x'";
        // }, $arr));

        $sql = "INSERT INTO $tblname ($k) VALUES ($v)";
        $res = $con->query($sql);
    }

    if ($res) {
        header("Location:addBook.php?msg=successful");
    }
}

$r = saveData($_POST, 'books');
?>
