<?php
ob_start();
include 'db_connect.php'; // Include the database connection details

// Function to handle delete
function handleDelete($cid) {
    global $conn;
    $sql = "DELETE FROM company WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        header("Location: controlPanelhtml.php#section-4");
        exit();
    }
}

// Function to handle update
function handleUpdate($cid, $cname, $cfield, $ccountry, $cphone, $cwebsite, $cfax, $cemail, $cduration, $caddress, $csfname, $cslname, $csemail, $csposition) {
    global $conn;
    $sql = "UPDATE company SET cname = ?, cfeild = ?, ccountry = ?, cphone = ?, cwebsite = ?, cfax = ?, cemail = ?, cduration = ?, caddress = ?, csfname = ?, cslname = ?, csemail = ?, csposition = ? WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss", $cname, $cfield, $ccountry, $cphone, $cwebsite, $cfax, $cemail, $cduration, $caddress, $csfname, $cslname, $csemail, $csposition, $cid);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        exit();
    }else{
        exit();
    }
}

// Check if delete form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["deletecompany"])) { // Changed to check for 'deletecompany'
        handleDelete($_POST["delete_cid"]); // Assuming 'delete_cid' is sent correctly
    } elseif (isset($_POST["update_cid"])) {
        handleUpdate($_POST["update_cid"], $_POST["cname"], $_POST["cfield"], $_POST["ccountry"], $_POST["cphone"], $_POST["cwebsite"], $_POST["cfax"], $_POST["cemail"], $_POST["cduration"], $_POST["caddress"], $_POST["csfname"], $_POST["cslname"], $_POST["csemail"], $_POST["csposition"]);
    }
}

// SQL to fetch companies
$sql = "SELECT * FROM company"; // Assuming the table name is 'company'
$result = $conn->query($sql);

// Check if there are results
if ($result && $result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Generate the visible grid item
        echo '<div class="grid-item" onclick="showForm(\'company' . $row["cid"] . '-form\')">';
        echo '<h2>' . htmlspecialchars($row["cname"]) . '</h2>';
        echo '<h4>' . htmlspecialchars($row["cfeild"]) . '</h4>';
        echo '<p>' . htmlspecialchars($row["ccountry"]) . '</p>';
        echo '</div>';

        // Generate the editable form for the company
        echo '<form id="company' . $row["cid"] . '-form" method="POST" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" class="hidden-form">';
        echo '<h2>Company Details</h2>';
        echo '<div class="viewF">';
        echo '<div class="sides">';
        // Editable fields
        echo '<p>Company Name: <input type="text" class="editable" name="cname" value="' . htmlspecialchars($row["cname"]) . '" readonly></p>';
        echo '<p>Country: <input type="text" class="editable" name="ccountry" value="' . htmlspecialchars($row["ccountry"]) . '" readonly></p>';
        echo '<p>Phone Number: <input type="text" class="editable" name="cphone" value="' . htmlspecialchars($row["cphone"]) . '" readonly></p>';
        echo '<p>Working Field: <input type="text" class="editable" name="cfield" value="' . htmlspecialchars($row["cfeild"]) . '" readonly></p>';
        echo '<p>Work to be Done: <input type="text" class="editable" name="cwork_to_be_done" value="' . htmlspecialchars($row["cwork_to_be_done"]) . '" readonly></p>';
        echo '</div>';
        echo '<div class="sides">';
        echo '<p>Website: <input type="text" class="editable" name="cwebsite" value="' . htmlspecialchars($row["cwebsite"]) . '" readonly></p>';
        echo '<p>Fax: <input type="text" class="editable" name="cfax" value="' . htmlspecialchars($row["cfax"]) . '" readonly></p>';
        echo '<p>Email: <input type="text" class="editable" name="cemail" value="' . htmlspecialchars($row["cemail"]) . '" readonly></p>';
        echo '<p>Duration: <input type="text" class="editable" name="cduration" value="' . htmlspecialchars($row["cduration"]) . '" readonly></p>';
        echo '<p>Address: <input type="text" class="editable" name="caddress" value="' . htmlspecialchars($row["caddress"]) . '" readonly></p>';
        echo '</div>';
        echo '</div>';

        echo '<h3>Company Supervisor</h3>';
        echo '<div class="viewF">';
        echo '<div class="sides">';
        echo '<p>First Name: <input type="text" class="editable" name="csfname" value="' . htmlspecialchars($row["csfname"]) . '" readonly></p>';
        echo '<p>Last Name: <input type="text" class="editable" name="cslname" value="' . htmlspecialchars($row["cslname"]) . '" readonly></p>';
        echo '</div>';
        echo '<div class="sides">';
        echo '<p>Email: <input type="text" class="editable" name="csemail" value="' . htmlspecialchars($row["csemail"]) . '" readonly></p>';
        echo '<p>Position: <input type="text" class="editable" name="csposition" value="' . htmlspecialchars($row["csposition"]) . '" readonly></p>';
        echo '</div>';
        echo '</div>';

        // Hidden field for company ID
        echo '<input type="hidden" name="update_cid" value="' . $row["cid"] . '">';
        // Hidden field for company ID (for deletion)
        echo '<input type="hidden" name="delete_cid" value="' . $row["cid"] . '">';


        // Edit and Save buttons
        echo '<button type="button" class="edit-btn" onclick="enableEditMode(' . $row["cid"] . ')">Edit</button>';
        echo '<button type="submit" class="save-btn" style="display:none;">Save</button>';

        // Close and Delete buttons
        echo '<button onclick="hideForm(\'company' . $row["cid"] . '-form\')" name="closecompany">Close</button>';
        echo '<button type="submit" name="deletecompany" onclick="return confirm(\'Are you sure you want to delete this company?\')">Delete</button>';
        echo '</form>';
        }
    }

    // Close connection
    $conn->close();
    ob_end_flush(); 
    ?>
