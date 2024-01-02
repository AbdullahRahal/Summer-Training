<?php
include 'db_connect.php';

function fetchContactDetails($conn, $id) {
    $stmt = $conn->prepare("SELECT contact_id, contact_name, contact_email, contact_onum FROM contact WHERE contact_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $editContactData = $result->fetch_assoc();
    $stmt->close();
    return $editContactData;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'update') {
    $id = $_POST['contact_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $officeNumber = $_POST['office_number'];

    $stmt = $conn->prepare("UPDATE contact SET contact_name = ?, contact_email = ?, contact_onum = ? WHERE contact_id = ?");
    $stmt->bind_param("sssi", $name, $email, $officeNumber, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: controlPanelhtml.php#section-3");
    exit;
}

if (isset($_GET['edit_id'])) {
    $editContactData = fetchContactDetails($conn, $_GET['edit_id']);
    // Display your edit form here, pre-filled with $editContactData
}

$conn->close();
?>
<?php if ($editContactData) : ?>
    <form action="" method="POST">
        <input type="hidden" name="contact_id" value="<?php echo $editContactData['contact_id']; ?>">
        <input type="text" name="name" value="<?php echo htmlspecialchars($editContactData['contact_name']); ?>">
        <input type="email" name="email" value="<?php echo htmlspecialchars($editContactData['contact_email']); ?>">
        <input type="text" name="office_number" value="<?php echo htmlspecialchars($editContactData['contact_onum']); ?>">
        <input type="hidden" name="action" value="update">
        <button type="submit">Update Contact</button>
    </form>
<?php endif; ?>