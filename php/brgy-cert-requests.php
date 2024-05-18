<?php
#include 'server.php';
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "barangay_service_management";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT ticket_number, date_submitted, firstname, middlename, lastname  
        FROM document_requests DR INNER JOIN accounts_list AL
        WHERE document_id = 4 and AL.account_id = DR.account_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['ticket_number']) . "</td>";
        echo "<td>" . htmlspecialchars($row['date_submitted']) . "</td>";
        echo "<td>" . htmlspecialchars($row['firstname'] . ' ' . $row['middlename'] . ' '. $row['lastname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['date_submitted']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No results found</td></tr>";
}
$conn->close();
?>
