<?php
// Include the database connection file
include 'db_connect.php';

// SQL query to fetch contacts from the "contact" table
$sql = "SELECT contact_name, contact_email, contact_onum FROM contact";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    // Start an HTML table to display the contact information
    echo '<table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Office Number</th>
                </tr>
            </thead>
            <tbody>';
    
    // Loop through the result set and display each contact
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>
                <td>' . $row['contact_name'] . '</td>
                <td>' . $row['contact_email'] . '</td>
                <td>' . $row['contact_onum'] . '</td>
              </tr>';
    }
    
    // Close the HTML table
    echo '</tbody></table>';
    
    // Free the result set
    mysqli_free_result($result);
} else {
    // If the query fails, display an error message
    echo 'Error: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
