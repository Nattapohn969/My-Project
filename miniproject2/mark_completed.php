<?php

include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $queue_id = mysqli_real_escape_string($conn, $_GET['id']);


    $sql_update = "UPDATE queues SET completed = 1 WHERE id = $queue_id";

    if (mysqli_query($conn, $sql_update)) {

        header("Location: customer.php?customer_id={$_GET['customer_id']}");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
