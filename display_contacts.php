<?php
include 'db_connect.php';

function displayContacts($conn) {
    $sql = "SELECT contact_id, contact_name, contact_email, contact_onum FROM contact";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["contact_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["contact_email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["contact_onum"]) . "</td>";
        echo "<td>
                <a href='edit_contact.php?edit_id=" . $row['contact_id'] . "'>Edit</a>
                |
                <a href='delete_contact.php?delete_id=" . $row['contact_id'] . "' onclick='return confirm(\"Are you sure you want to delete this contact?\");'>Delete</a>
              </td>";
        echo "</tr>";
    }
}


displayContacts($conn);

$conn->close();
?>
