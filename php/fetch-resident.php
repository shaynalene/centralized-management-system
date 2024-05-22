<?php
include 'server.php';

// Step 1: Query the database
$sql = "SELECT Resident_ID, First_Name, Middle_Name, Last_Name, Birthdate, Gender, Phone, Address, resident_photo, filename, filetype FROM resident_population";
$result = $conn->query($sql);

$update_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Resident_ID = $_POST['Resident_ID'];
    $First_Name = $_POST['First_Name'];
    $Middle_Name = $_POST['Middle_Name'];
    $Last_Name = $_POST['Last_Name'];
    $Birthdate = $_POST['Birthdate'];
    $Gender = $_POST['Gender'];
    $Phone = $_POST['Phone'];
    $Address = $_POST['Address'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['tmp_name'];
        $imageContent = file_get_contents($image);
        $imageType = $_FILES['image']['type'];
        $imageName = $_FILES['image']['name'];
        
        $sql = "UPDATE resident_population SET First_Name=?, Middle_Name=?, Last_Name=?,  Birthdate=?, Gender=?, Phone=?, Address=?, resident_photo=?, filename=?, filetype=? WHERE Resident_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", $First_Name, $Middle_Name, $Last_Name, $Birthdate, $Gender, $Phone, $Address, $imageContent, $imageName, $imageType, $Resident_ID);

    } else {
        $sql = "UPDATE resident_population SET First_Name=?, Middle_Name=?, Last_Name=?,  Birthdate=?, Gender=?, Phone=?, Address=? WHERE Resident_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $First_Name, $Middle_Name, $Last_Name, $Birthdate, $Gender, $Phone, $Address, $Resident_ID);
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
                $image = $row['resident_photo'];
                $file_extension = pathinfo($row["filename"], PATHINFO_EXTENSION);
                
                // Encode the image data
                $imageBase64 = base64_encode($image);

                // HTML and data to display
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Resident_ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['First_Name']) . " " . ($row['Middle_Name']) . " " .($row['Last_Name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Birthdate']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Gender']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Phone']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Address']) . "</td>";
                echo "<td>
                        <button type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModalCenter" . htmlspecialchars($row['Resident_ID']) . "'>
                            View
                        </button>
                        <div class='modal fade' id='exampleModalCenter" . htmlspecialchars($row['Resident_ID']) . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLongTitle'>Edit Resident Information</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                    <form id='editForm" . htmlspecialchars($row['Resident_ID']) . "' method='POST' action='' enctype='multipart/form-data'>
                                            <input type='hidden' name='Resident_ID' value='" . htmlspecialchars($row['Resident_ID']) . "'/>
                                            <div class='form-group'>
                                                <label for='editPhoto'>Existing Photo:</label>
                                                <img src='data:" . htmlspecialchars($imageType) . ";base64," . htmlspecialchars($imageBase64) . "' class='img-fluid'/>
                                                <hr class='my-4' />
                                                <label for='editPhoto'>New Photo:</label>
                                                <input class='form-control' type='file' name='image' id='image' accept='image/*'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editResidentID'>Resident ID:</label>
                                                <input type='text' class='form-control' id='editResidentID' name='Resident_ID' value='" . htmlspecialchars($row['Resident_ID']) . " ' readonly/>
                                            </div>                                            
                                            <div class='form-group'>
                                                <label for='editFirstName'>First Name:</label>
                                                <input type='text' class='form-control' id='editFirstName' name='First_Name' value='" . htmlspecialchars($row['First_Name']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editMiddleName'>Middle Name:</label>
                                                <input type='text' class='form-control' id='editMiddleName' name='Middle_Name' value='" . htmlspecialchars($row['Middle_Name']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editLastName'>Last Name:</label>
                                                <input type='text' class='form-control' id='editLastName' name='Last_Name' value='" . htmlspecialchars($row['Last_Name']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editBirthdate'>Birthdate:</label>
                                                <input type='date' class='form-control' id='editBirthdate' name='Birthdate' value='" . htmlspecialchars($row['Birthdate']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editGender'>Gender:</label>
                                                <select id='editGender' class='form-control' name='Gender' value='" . htmlspecialchars($row['Gender']) . "'/>
                                                <option value='Male'>Male</option>
                                                <option value='Female'>Female</option>
                                                </select>  
                                            </div>
                                            <div class='form-group'>
                                            <label for='editPhone'>Phone:</label>
                                            <input type='text' class='form-control' id='editPhone' name='Phone' value='" . htmlspecialchars($row['Phone']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editAddress'>Address:</label>
                                                <input type='text' class='form-control' id='editAddress' name='Address' value='" . htmlspecialchars($row['Address']) . "'/>
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
