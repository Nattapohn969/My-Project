<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Queue Status</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>เเฉ่งลูกชิ้นทอด</h1>
        <center><img src="expt.jpg"alt="expt"></center>

        <h3>Check Your Queue</h3>
        <form action="customer.php" method="GET">
            <label for="queue_number">Enter Your queue number:</label>
            <input type="text" id="queue_number" name="queue_number" required>
            <button type="submit">Check</button>
        </form>

        <?php
  
        include 'connect.php';

        // Check if form is submitted and customer_id is provided
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['queue_number'])) {
            $queue_number = mysqli_real_escape_string($conn, $_GET['queue_number']);


            $sql_current_queue = "SELECT * FROM queues WHERE queue_number = $queue_number AND completed = 0 ORDER BY id DESC LIMIT 1";
            $result_current_queue = mysqli_query($conn, $sql_current_queue);

            if (mysqli_num_rows($result_current_queue) > 0) {
                $current_queue = mysqli_fetch_assoc($result_current_queue);
                echo "<h4>Your Current Queue Number: " . htmlspecialchars($current_queue['queue_number']) . "</h4>";
            } else {
                echo "<p>You don't have an active queue.</p>";
            }

   
            $sql_previous_queues = "SELECT * FROM queues WHERE queue_number = $queue_number AND completed = 1 ORDER BY id DESC LIMIT 5";
            $result_previous_queues = mysqli_query($conn, $sql_previous_queues);

            if (mysqli_num_rows($result_previous_queues) > 0) {
                echo "<h4>Your Previous 5 Queues:</h4>";
                echo "<ul>";
                while ($previous_queue = mysqli_fetch_assoc($result_previous_queues)) {
                    echo "<li>" . htmlspecialchars($previous_queue['queue_number']) . " (" . ($previous_queue['completed'] ? 'Completed' : 'Pending') . ")</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>You don't have any completed queues.</p>";
            }
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
