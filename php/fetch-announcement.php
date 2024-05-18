<?php
include 'server.php';

// Step 1: Query the database
$sql = "SELECT Announcement_ID, Title, Created_By, Content, Time_Posted, announcement_photo, filename, filetype FROM announcements";
$result = $conn->query($sql);

$update_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Title = $_POST['Title'];
    $Created_By = $_POST['Created_By'];
    $Content = $_POST['Content'];
    $Announcement_ID = $_POST['Announcement_ID'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['tmp_name'];
        $imageContent = file_get_contents($image);
        $imageType = $_FILES['image']['type'];
        $imageName = $_FILES['image']['name'];
        
        $sql = "UPDATE announcements SET Title=?, Created_By=?, Content=?, announcement_photo=?, filename=?, filetype=? WHERE Announcement_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $Title, $Created_By, $Content, $imageContent, $imageName, $imageType, $Announcement_ID);
    
    }  else {
        $sql = "UPDATE announcements SET Title=?, Created_By=?, Content=? WHERE Announcement_ID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $Title, $Created_By, $Content, $Announcement_ID);
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
                $image = $row['announcement_photo'];
                $file_extension = pathinfo($row["filename"], PATHINFO_EXTENSION);
                
                // Encode the image data
                $imageBase64 = base64_encode($image);

                // HTML and data to display
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['Announcement_ID']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Title']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Created_By']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Content']) . "</td>";
                echo "<td>" . htmlspecialchars($row['Time_Posted']) . "</td>";
                echo "<td>
                        <button type='button' class='btn btn-success' data-toggle='modal' data-target='#exampleModalCenter" . htmlspecialchars($row['Announcement_ID']) . "'>
                            View
                        </button>
                        <div class='modal fade' id='exampleModalCenter" . htmlspecialchars($row['Announcement_ID']) . "' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>
                            <div class='modal-dialog modal-dialog-centered' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLongTitle'>Edit Announcement Information</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                    <form id='editForm" . htmlspecialchars($row['Announcement_ID']) . "' method='POST' action='' enctype='multipart/form-data'>
                                            <input type='hidden' name='Announcement_ID' value='" . htmlspecialchars($row['Announcement_ID']) . "'/>
                                            <div class='form-group'>
                                                <label for='editPhoto'>Existing Photo:</label>
                                                <img src='data:" . htmlspecialchars($imageType) . ";base64," . htmlspecialchars($imageBase64) . "' class='img-fluid'/>
                                                <hr class='my-4' />
                                                <label for='editPhoto'>New Photo:</label>
                                                <input class='form-control' type='file' name='image' id='image' accept='image/*'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editTitle'>Title:</label>
                                                <input type='text' class='form-control' id='editTitle' name='Title' value='" . htmlspecialchars($row['Title']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editCreatedBy'>Created By:</label>
                                                <input type='text' class='form-control' id='editCreatedBy' name='Created_By' value='" . htmlspecialchars($row['Created_By']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editContent'>Content:</label>
                                                <input type='text' class='form-control' id='editContent' name='Content' value='" . htmlspecialchars($row['Content']) . "'/>
                                            </div>
                                            <div class='form-group'>
                                                <label for='editTime_Posted'>Time Posted:</label>
                                                <input type='text' class='form-control' id='editTime_Posted' name='Time_Posted' value='" . htmlspecialchars($row['Time_Posted']) . "'readonly/>
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
