<?php
include 'connect.php';


$sql_reset = "DELETE FROM queues WHERE id = id";
if (mysqli_query($conn, $sql_reset)) {
    echo "Queues reset successfully.";
} else {
    echo "Error resetting queues: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
