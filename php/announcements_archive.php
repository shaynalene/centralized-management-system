<?php
// Include the connection script
include 'server.php';

// Query to fetch announcements
$sql = "SELECT Title, Time_Posted, Content, Created_By FROM announcements";
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
