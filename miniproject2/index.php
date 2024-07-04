<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>queue</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <h1>เเฉ่งลูกชิ้นทอด</h1>
        <center><img src="expt.jpg"alt="expt"></center>

       
        <form action="add_queue.php" method="POST">
            <label for="queue_number">Next Queue Number:</label>
            <input type="hidden" id="queue_number" name="queue_number" value="1"> <!-- กำหนดค่าเริ่มต้นเป็น 1 -->
            <button type="submit">Add Queue</button>
                <a href="reset_queues.php" class="reset-link">
                    <button1 type="button">Reset queue</button1>
                </a>
        </form>

  
        <h3>Queue List</h3>
        <table>
            <thead>
                <tr>
                    <th>Queue Number</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
               
                include 'connect.php';

              
                $sql = "SELECT * FROM queues";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($queue = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($queue['queue_number']) . "</td>";
                        echo "<td>" . ($queue['completed'] ? 'Completed' : 'Pending') . "</td>";
                        echo "<td><a href='mark_completed.php?id=" . $queue['id'] . "'>Mark Completed</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No queues found.</td></tr>";
                }

              
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>