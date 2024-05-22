<?php
include 'server.php';

// Step 1: Query the database
$sql = "SELECT Commercial_ID, Commercial_Name, Owner_First_Name, Owner_Middle_Name, Owner_Last_Name, Contact_Number, Location, Validity, commercial_photo, filename, filetype FROM commercial_population";
$result = $conn->query($sql);

$update_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Commercial_ID = $_POST['Commercial_ID']; 
    $Commercial_Name = $_POST['Commercial_Name'];
    $Owner_First_Name = $_POST['Owner_First_Name'];
    $Owner_Middle_Name = $_POST['Owner_Middle_Name'];
    $Owner_Last_Name = $_POST['Owner_Last_Name'];
    $Contact_Number = $_POST['Contact_Number'];
    $Location = $_POST['Location'];
    $Validity = $_POST['Validity'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['tmp_name'];
        $imageContent = file_get_contents($image);
        $imageType = $_FILES['image']['type'];
        $imageName = $_FILES['image']['name'];
        
        $sql = "UPDATE commercial_population SET Commercial_Name=?, Owner_First_Name=?, Owner_Middle_Name=?, Owner_Last_Name=?, Contact_Number=?, Location=?, Validity=?, commercial_photo=?, filename=?, filetype=? WHERE Commercial_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", $Commercial_Name, $Owner_First_Name, $Owner_Middle_Name, $Owner_Last_Name, $Contact_Number, $Location, $Validity, $imageContent, $imageName, $imageType, $Commercial_ID);

    } else {
        $sql = "UPDATE commercial_population SET Commercial_Name=?, Owner_First_Name=?, Owner_Middle_Name=?, Owner_Last_Name=?, Contact_Number=?, Location=?, Validity=? WHERE Commercial_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $Commercial_Name, $Owner_First_Name, $Owner_Middle_Name, $Owner_Last_Name, $Contact_Number, $Location, $Validity, $Commercial_ID);
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
                $image = $row['commercial_photo'];
                $file_extension = pathinfo($row["filename"], PATHINFO_EXTENSION);
                
                // Encode the image data
                $imageBase64 = base64_encode($image);

                // HTML and data to display
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Commercial_ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Commercial_Name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Owner_First_Name']) . " " . ($row['Owner_Middle_Name']) . " " .($row['Owner_Last_Name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Contact_Number']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Location']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Validity']) . "</td>";
                echo "<td>
                        <button type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModalCenter" . htmlspecialchars($row['Commercial_ID']) . "'>
                            View
                        </button>
                        <div class='modal fade' id='exampleModalCenter" . htmlspecialchars($row['Commercial_ID']) . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLongTitle'>Edit Commercial Information</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                    <form id='editForm" . htmlspecialchars($row['Commercial_ID']) . "' method='POST' action='' enctype='multipart/form-data'>
                                            <input type='hidden' name='Commercial_ID' value='" . htmlspecialchars($row['Commercial_ID']) . "'/>
                                            <div class='form-group'>
                                                <label for='editPhoto'>Existing Photo:</label>
                                                <img src='data:" . htmlspecialchars($imageType) . ";base64," . htmlspecialchars($imageBase64) . "' class='img-fluid'/>
                                                <hr class='my-4' />
                                                <label for='editPhoto'>New Photo:</label>
                                                <input class='form-control' type='file' name='image' id='image' accept='image/*'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editFirstName'>Commercial Name:</label>
                                                <input type='text' class='form-control' id='editCommercialName' name='Commercial_Name' value='" . htmlspecialchars($row['Commercial_Name']) . "' readonly/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editFirstName'>First Name:</label>
                                                <input type='text' class='form-control' id='editFirstName' name='Owner_First_Name' value='" . htmlspecialchars($row['Owner_First_Name']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editMiddleName'>Middle Name:</label>
                                                <input type='text' class='form-control' id='editMiddleName' name='Owner_Middle_Name' value='" . htmlspecialchars($row['Owner_Middle_Name']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editLastName'>Last Name:</label>
                                                <input type='text' class='form-control' id='editLastName' name='Owner_Last_Name' value='" . htmlspecialchars($row['Owner_Last_Name']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editContactNumber'>Contact Number:</label>
                                                <input type='text' class='form-control' id='editBirthdate' name='Contact_Number' value='" . htmlspecialchars($row['Contact_Number']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editLocation'>Location:</label>
                                                <input type='text' class='form-control' id='editLocation' name='Location' value='" . htmlspecialchars($row['Location']) . "' readonly/>
                                            </div>
                                            <div class='form-group'>
                                            <label for='editValidity'>Validity:</label>
                                            <input type='date' class='form-control' id='editValidty' name='Validity' value='" . htmlspecialchars($row['Validity']) . "' readonly/>
                                        </div>
                                            <div class='form-group'>
                                                <input type='text' class='form-control' value='". $update_message . "' readonly/>
                                            </div>
                                            <div class='modal-footer'>
                                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                                <button type='submit' class='btn btn-primary'>Save Changes</button>
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
