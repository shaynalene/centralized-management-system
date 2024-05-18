<?php
// Include the connection script
include 'server.php';

// Query to fetch announcements
$sql = "SELECT title, time_posted, content, created_by FROM announcements_records";
$result = $conn->query($sql);

$announcements = [];
if ($result->num_rows > 0) {
    // Fetch all announcements and store them in an array
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();
?>
