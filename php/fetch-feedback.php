<?php
include 'server.php';
include '../php/onload.php';

// Step 1: Query the database
$sql = "SELECT feedback_id, feedback_title, feedback, feedback_photo, filename, filetype, account_id, date_posted FROM feedback_records";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $account_id = $_POST["account_id"];
    $feedback_id = $_POST['feedback_id'];
    $feedback_title = $_POST['feedback_title'];
    $feedback = $_POST['feedback'];
    $account_id = $_POST['account_id']; // GET ACCOUNT ID
    $update_message = "";

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['tmp_name'];
        $imageContent = file_get_contents($image);
        $imageType = $_FILES['image']['type'];
        $imageName = $_FILES['image']['name'];
        
        $sql = "UPDATE feedback_records SET feedback_title=?, feedback=?, account_id=?, feedback_photo=?, filename=?, filetype=? WHERE feedback_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $feedback_title, $feedback, $account_id, $imageContent, $imageName, $imageType, $feedback_id);

    } else {
        $sql = "UPDATE feedback_records SET feedback_title=?, feedback=?, account_id=? WHERE feedback_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $feedback_title, $feedback, $account_id, $feedback_id);
    }
    
    if ($stmt->execute()) {
        $update_message = "Please reload the page after saving the changes.";
    } else {
        $update_message = "Error updating record: " . $conn->error;
    }
    
    $stmt->close();
}

if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Step 2: Retrieve image data
                $update_message = "Please reload the page after saving the changes.";
                $imageType = $row['filetype'];
                $image = $row['feedback_photo'];
                $file_extension = pathinfo($row["filename"], PATHINFO_EXTENSION);
                
                // Encode the image data
                $imageBase64 = base64_encode($image);

                // HTML and data to display
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['feedback_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['feedback_title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['feedback']) . "</td>";
                echo "<td>" . htmlspecialchars($row['account_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['date_posted']) . "</td>";
                echo "<td>
                        <button type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModalCenter" . htmlspecialchars($row['feedback_id']) . "'>
                            View
                        </button>
                        <div class='modal fade' id='exampleModalCenter" . htmlspecialchars($row['feedback_id']) . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLongTitle'>Edit Feedback</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                    <form id='editForm" . htmlspecialchars($row['feedback_id']) . "' method='POST' action='' enctype='multipart/form-data'>
                                            <input type='hidden' name='feedback_id' value='" . htmlspecialchars($row['feedback_id']) . "'/>
                                            <div class='form-group'>
                                                <label for='editPhoto'>Existing Photo:</label>
                                                <img src='data:" . htmlspecialchars($imageType) . ";base64," . htmlspecialchars($imageBase64) . "' class='img-fluid'/>
                                                <hr class='my-4' />
                                                <!--
                                                <label for='editPhoto'>New Photo:</label>
                                                <input class='form-control' type='file' name='image' id='image' accept='image/*' readonly>
                                                -->
                                            </div>
                                            <div class='form-group'>
                                                <label for='editTitle'>Feedback Title:</label>
                                                <input type='text' class='form-control' id='editTitle' name='feedback_title' value='" . htmlspecialchars($row['feedback_title']) . "' readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editFeedback'>Feedback:</label>
                                                <input type='text' class='form-control' id='editFeedback' name='feedback' value='" . htmlspecialchars($row['feedback']) . "'readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editAccountID'>Account ID:</label>
                                                <input type='text' class='form-control' id='editAccountID' name='account_id' value='" . htmlspecialchars($row['account_id']) . "' readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editDatePosted'>Date Posted:</label>
                                                <input type='text' class='form-control' id='editDatePosted' name='date_posted' value='". htmlspecialchars($row['date_posted']) . "' readonly/>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No results found</td></tr>";
        }

$conn->close();
?>
