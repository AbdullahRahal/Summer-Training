<?php
// Include your database connection file from the 'supervisor' directory
include 'db_connect.php';

try {
    // SQL query to fetch the required data
    $stmt = $pdo->prepare("SELECT * FROM confirmations WHERE con_state IS NULL");
    $stmt->execute();

    // Fetching data
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// HTML structure
echo '<tbody>';
foreach ($rows as $row) {
    // Unique ID for each row
    $uniqueId = htmlspecialchars($row['con_id']);

    echo '<tr>';
    // Student and Company details
    echo '<td>' . htmlspecialchars($row['cs_name']) . '</td>';
    echo '<td>' . htmlspecialchars($row['cc_name']) . '</td>';

    // Confirmation link
    echo '<td><a onclick="displayInfoCom(' . $uniqueId . ')">confirmation</a></td>';

    // Hidden div with more information
    echo '<div class="con-file-hidden" id="info-' . $uniqueId . '">';
    echo '<h2>Information about the Company and Trainee</h2>';
    echo '<div class="view-apply">';
    echo '<div class="sides-apply">';
    echo '<p>Company Name: ' . htmlspecialchars($row['cc_name']) . '</p>';
    echo '<p>Working field(s): ' . htmlspecialchars($row['cc_field']) . '</p>';
    echo '<p>Phone No: ' . htmlspecialchars($row['cc_tele']) . '</p>';
    echo '<p>Fax: ' . htmlspecialchars($row['cc_fax']) . '</p>';
    echo '<p>Company E-mail: ' . htmlspecialchars($row['cc_email']) . '</p>';
    echo '<p>City: ' . htmlspecialchars($row['cc_city']) . '</p>';
    echo '<p>Country: ' . htmlspecialchars($row['cc_country']) . '</p>';
    echo '</div>';
    echo '<div class="sides-apply">';
    echo '<p>Company Website: ' . htmlspecialchars($row['cc_website']) . '</p>';
    echo '<p>Student name: ' . htmlspecialchars($row['std_name']) . '</p>';
    echo '<p>Start date(planned): ' . htmlspecialchars($row['std_s_date']) . '</p>';
    echo '<p>End date(planned): ' . htmlspecialchars($row['std_e_date']) . '</p>';
    echo '<p>Postal address: ' . htmlspecialchars($row['cc_address']) . '</p>';
    echo '</div>';
    echo '</div>';
    echo '<h2>The work to be done by the student</h2>';
    echo '<div class="view-apply">';
    echo '<div class="sides-apply">';
    echo '<ul>';
    // Example tasks - replace with actual data or loop if needed
    echo '<li>' . htmlspecialchars($row['work_to_be_done']) . '</li>';
    echo '</ul>';
    echo '</div>';
    echo '<div class="sides-apply">';
    echo '<h3>Official Signature and Stamp of the Company</h3>';
    // Links for e-stamp and e-signature (replace 'emu.png' with actual file paths if needed)
    echo '<p>E-stamp: <a href="download_stamp.php?id=' . $uniqueId . '" download>Download Stamp</a></p>';
    echo '<p>E-signature: <a href="download_signature.php?id=' . $uniqueId . '" download>Download Signature</a></p>';
    echo '</div>';
    echo '</div>';
    // Close button
    echo '<button type="button" onclick="displayInfoCom(' . $uniqueId . ')">close</button>';
    echo '</div>';

    // Action buttons
    echo '<td class="action-cell">';
    echo '<button class="approve-button" onclick="updateState(' . $row['con_id'] . ', \'approved\')">Approve</button>';
    echo '<button class="reject-button" onclick="updateState(' . $row['con_id'] . ', \'rejected\')">Reject</button>';
    echo '<div class="reject-reason" id="rejectReasonCon">';
    echo '<textarea name="rejectRes-application" id="rejectResCon" cols="30" rows="5" placeholder="Reason for rejection..."></textarea>';
    echo '<div>';
    echo '<button type="submit">send</button>';
    echo '</div>';
    echo '</div>';
    echo '</td>';

    echo '</tr>';
}
echo '</tbody>';
?>
