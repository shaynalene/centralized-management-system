<?php
include "../php/server.php";
include '../php/onload.php';

$account_id = $_SESSION["account_id"];

$sql1 = "SELECT document_id, date_submitted, status FROM document_requests WHERE account_id = '$account_id'";
$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {
    $counter = 1;
    while ($row = $result1->fetch_assoc()) {
        $documentID = $row['document_id'];

        // Determine document type based on document ID
        if ($documentID == 1) {
            $documentType = "Permit Request";
        } elseif ($documentID == 2) {
            $documentType = "Clearance";
        } elseif ($documentID == 3) {
            $documentType = "Barangay ID";
        } elseif ($documentID == 4) {
            $documentType = "Certificate of Residence";
        } else {
            continue; // Skip to the next iteration if document ID is not recognized
        }

        $dateSubmitted = $row['date_submitted'];
        $actionTaken = "Submitted";
        $status = strtoupper($row['status']);

        echo "<tr>";
        echo "<td>" . htmlspecialchars($counter) . "</td>";
        echo "<td>" . htmlspecialchars($documentType) . "</td>";
        echo "<td>" . htmlspecialchars($dateSubmitted) . "</td>";
        echo "<td>" . htmlspecialchars($actionTaken) . "</td>";
        echo "<td>" . htmlspecialchars($status) . "</td>";
        echo "</tr>";

        $counter++;
    }
} else {
    echo "<tr><td colspan='5'>No results found</td></tr>";
}

$conn->close();
?>
