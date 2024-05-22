<?php
include "../php/server.php";
include '../php/onload.php';

$account_id = $_SESSION["account_id"];

// Query to fetch data from the document_requests table
$sql1 = "SELECT document_id, date_submitted, status FROM document_requests WHERE account_id = '$account_id'";
$result1 = $conn->query($sql1);

$documentRequests = [];
if ($result1->num_rows > 0) {
    while ($row = $result1->fetch_assoc()) {
        $documentRequests[] = $row;
    }
}

// Query to fetch data from the complaint_records table
$sql2 = "SELECT date_submitted, status FROM complaint_records WHERE Account_Id = '$account_id'";
$result2 = $conn->query($sql2);

$additionalRequests = [];
if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        // Adding a placeholder for document_id so we can differentiate these entries later
        $row['document_id'] = null;
        $additionalRequests[] = $row;
    }
}

// Merge the two sets of results
$allRequests = array_merge($documentRequests, $additionalRequests);

if (count($allRequests) > 0) {
    $counter = 1;
    foreach ($allRequests as $row) {
        $documentID = $row['document_id'];
        $dateSubmitted = $row['date_submitted'];
        $actionTaken = "Submitted";
        $status = strtoupper($row['status']);

        // Determine document type based on document ID if it's not null
        if ($documentID !== null) {
            if ($documentID == 1) {
                $documentType = "Permit Request";
            } elseif ($documentID == 2) {
                $documentType = "Clearance";
            } elseif ($documentID == 3) {
                $documentType = "Barangay ID";
            } elseif ($documentID == 4) {
                $documentType = "Certificate of Residence";
            } else {
                $documentType = "Unknown Document";
            }
        } else {
            $documentType = "Complaint Record";
        }

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
