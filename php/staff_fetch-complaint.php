<?php
include 'server.php';

// Step 1: Query the database
$sql = "SELECT Complaint_ID, Name_Of_Complainant, Account_ID, Name_Of_Respondent, Address_Of_The_Respondent, Summary_Of_The_Complaint, Status, Date_Submitted, complaint_photo, filename, filetype FROM complaint_records";
$result = $conn->query($sql);

$update_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Complaint_ID = $_POST['Complaint_ID'];
    $Account_ID = $_POST['Account_ID'];
    $Date_Submitted = $_POST['Date_Submitted'];
    $Status = $_POST['Status'];

    $Name_Of_Complainant = $_POST['Name_Of_Complainant'];
    $Name_Of_Respondent = $_POST['Name_Of_Respondent'];
    $Address_Of_The_Respondent = $_POST['Address_Of_The_Respondent'];
    $Summary_Of_The_Complaint = $_POST['Summary_Of_The_Complaint'];


    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['tmp_name'];
        $imageContent = file_get_contents($image);
        $imageType = $_FILES['image']['type'];
        $imageName = $_FILES['image']['name'];
        
        $sql = "UPDATE complaint_records SET Name_Of_Complainant=?, Name_Of_Respondent=?, Address_Of_The_Respondent=?, Summary_Of_The_Complaint=?, complaint_photo=?, filename=?, filetype=? WHERE Complaint_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $Name_Of_Complainant, $Name_Of_Respondent, $Address_Of_The_Respondent, $Summary_Of_The_Complaint, $imageContent, $imageName, $imageType, $Complaint_ID);

    } else {
        $sql = "UPDATE complaint_records SET Name_Of_Complainant=?, Name_Of_Respondent=?, Address_Of_The_Respondent=?, Summary_Of_The_Complaint=? WHERE Complaint_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $Name_Of_Complainant, $Name_Of_Respondent, $Address_Of_The_Respondent, $Summary_Of_The_Complaint, $Complaint_ID);
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
                $imageType = $row['filetype'];
                $image = $row['complaint_photo'];
                $file_extension = pathinfo($row["filename"], PATHINFO_EXTENSION);
                
                // Encode the image data
                $imageBase64 = base64_encode($image);

                // HTML and data to display
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Complaint_ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Name_Of_Complainant']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Name_Of_Respondent']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Address_Of_The_Respondent']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Summary_Of_The_Complaint']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Account_ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Status']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Date_Submitted']) . "</td>";



                echo "<td>
                        <button type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModalCenter" . htmlspecialchars($row['Complaint_ID']) . "'>
                            View
                        </button>
                        <div class='modal fade' id='exampleModalCenter" . htmlspecialchars($row['Complaint_ID']) . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLongTitle'>View Complaint Information</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                    <form id='editForm" . htmlspecialchars($row['Complaint_ID']) . "' method='POST' action='../php/staff_complaint-button.php' enctype='multipart/form-data'>
                                            <input type='hidden' name='Complaint_ID' value='" . htmlspecialchars($row['Complaint_ID']) . "'/>
                                            <div class='form-group'>
                                                <label for='editPhoto'>Existing Photo:</label>
                                                <img src='data:" . htmlspecialchars($imageType) . ";base64," . htmlspecialchars($imageBase64) . "' class='img-fluid'/>
                                                <hr class='my-4' />
                                                <label for='editPhoto'>New Photo:</label>
                                                <input class='form-control' type='file' name='image' id='image' accept='image/*'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editComplaint_ID'>Complaint ID:</label>
                                                <input type='text' class='form-control' id='editComplaint_ID' name='Complaint_ID' value='" . htmlspecialchars($row['Complaint_ID']) . "'readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editAccount_ID_ID'>Account ID:</label>
                                                <input type='text' class='form-control' id='editAccount_ID' name='Account_ID' value='" . htmlspecialchars($row['Account_ID']) . "'readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editComplainant'>Complainant:</label>
                                                <input type='text' class='form-control' id='editComplainant' name='Name_Of_Complainant' value='" . htmlspecialchars($row['Name_Of_Complainant']) . "'readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editRespondent'>Respondent:</label>
                                                <input type='text' class='form-control' id='editMiddleName' name='Name_Of_Respondent' value='" . htmlspecialchars($row['Name_Of_Respondent']) . "'readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editAddress'>Address of the Respondent:</label>
                                                <input type='text' class='form-control' id='editAddress' name='Address_Of_The_Respondent' value='" . htmlspecialchars($row['Address_Of_The_Respondent']) . "'readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editSummary'>Summary of the Complaint</label>
                                                <input type='text' class='form-control' id='editSummary' name='Summary_Of_The_Complaint' value='" . htmlspecialchars($row['Summary_Of_The_Complaint']) . "'readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editDateSubmitted'>Date Submitted</label>
                                                <input type='text' class='form-control' id='editDateSubmitted' name='Date_Submitted' value='" . htmlspecialchars($row['Date_Submitted']) . "'readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editStatus'>Status</label>
                                                <input type='text' class='form-control' id='editStatus' name='Status' value='" . htmlspecialchars($row['Status']) . "'readonly/>
                                            </div>

                                            
                                            <div class='form-group'>
                                                <input type='text' class='form-control' value='". $update_message . "' readonly/>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='submit' class='btn btn-success' name='approveComplaint'>Approve</button>
                                                <button type='submit' class='btn btn-danger' name='disapproveComplaint'>Disapprove</button>
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
