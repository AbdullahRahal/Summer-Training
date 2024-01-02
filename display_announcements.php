<?php
ob_start();
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'summer_training';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_announcement'])) {
    $announcementId = $_POST['delete_announcement'];

    $sql = "DELETE FROM announcement WHERE announcement_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $announcementId);

    if ($stmt->execute()) {
        echo '<script>alert("Announcement deleted successfully.");</script>';
    } else {
        echo 'Error deleting announcement.';
    }

    $stmt->close();
}

// Handle Edit Request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_announcement_id'])) {
    $editedAnnouncementId = $_POST['edit_announcement_id'];
    $editedAnnouncementBody = $_POST['edited_announcement_body'];

    $sql = "UPDATE announcement SET nnouncement_body = ? WHERE announcement_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $editedAnnouncementBody, $editedAnnouncementId);

    if ($stmt->execute()) {
        echo '<script>alert("Announcement updated successfully.");</script>';
    } else {
        echo 'Error updating announcement.';
    }

    $stmt->close();
}

$sql = "SELECT announcement_id, nnouncement_body FROM announcement";
$result = $conn->query($sql);

if ($result) {
    echo '<ul class="Announcement-list">';
    while ($row = $result->fetch_assoc()) {
        echo '<li class="Announcement-item">';

        // Display announcement body
        echo '<p id="announcement_body_' . $row['announcement_id'] . '">' . htmlspecialchars($row['nnouncement_body']) . '</p>';
        
        // Edit Form
        echo '<form method="post" action="" class="edit-announcement-form" id="edit_form_' . $row['announcement_id'] . '" style="display:none;">';
        echo '<textarea name="edited_announcement_body">' . htmlspecialchars($row['nnouncement_body']) . '</textarea>';
        echo '<input type="hidden" name="edit_announcement_id" value="' . $row['announcement_id'] . '">';
        echo '<button type="submit">Save</button>';
        echo '</form>';

        // Display Options
        echo '<div class="announcement-options">';
        echo '<span class="edit-announcement-button" onclick="showEditForm(' . $row['announcement_id'] . ')">Edit</span>';
        echo '<form method="post" action="">';
        echo '<input type="hidden" name="delete_announcement" value="' . $row['announcement_id'] . '">';
        echo '<span class="delete-announcement-button" onclick="confirmDelete(' . $row['announcement_id'] . ')">Delete</span>';
        echo '</form>';
        echo '</div>';

        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>Error retrieving announcements.</p>';
}

$conn->close();
?>

<script>
function showEditForm(announcementId) {
    var form = document.getElementById('edit_form_' + announcementId);
    var announcementBody = document.getElementById('announcement_body_' + announcementId);
    announcementBody.style.display = 'none';
    form.style.display = 'block';
}
</script>


