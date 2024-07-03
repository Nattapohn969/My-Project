<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the next queue number
    $sql = "SELECT MAX(queue_number) AS max_queue_number FROM queues";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $next_queue_number = $row['max_queue_number'] + 1;

    // Insert the next queue number into the database
    $sql_insert = "INSERT INTO queues (queue_number) VALUES ('$next_queue_number')";
    if (mysqli_query($conn, $sql_insert)) {
       
        header("Location: admin.php");
        exit;
    } else {
        echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
    }
}


mysqli_close($conn);
?>