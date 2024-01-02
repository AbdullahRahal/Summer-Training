<?php
// Include database connection file
include 'db_connect.php';

$query = "SELECT * FROM stdform WHERE stdf_fstates IS NULL";
$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)) {
    $infoDivId = 'info-'.$row['stdf_id'];  // Unique ID for the div

    echo '<tr>';
    echo '<td>'.htmlspecialchars($row['stdf_stdname']).'</td>';
    echo '<td>'.htmlspecialchars($row['stdf_stdnum']).'</td>';
    echo '<td><a href="#" onclick="event.preventDefault(); displayInfo(\''.$infoDivId.'\')">application</a></td>';
    echo '<td colspan="3">';
    echo '<div class="apply-file-nhidden" id="'.$infoDivId.'">';
    // Student Information
    echo '<h2>Student Information</h2><div class="view-apply">';
    echo '<div class="sides-apply">';
    echo '<p>First Name: '.htmlspecialchars($row['stdf_stdname']).'</p>';
    echo '<p>Student No: '.htmlspecialchars($row['stdf_stdnum']).'</p>';
    echo '<p>Phone No: '.htmlspecialchars($row['stdf_stdphone']).'</p>';
    echo '<p>E-Mail: '.htmlspecialchars($row['stdf_stdemail']).'</p>';
    echo '<p>Postal address: '.htmlspecialchars($row['stdf_stdaddress']).'</p>';
    echo '</div><div class="sides-apply">';
    echo '<div class="photo-div">';
    // Assuming stdf_stdphoto contains the filename of the photo
    $photoFilename = htmlspecialchars($row['stdf_stdphoto']);
    $photoPath = "student/$photoFilename";
    echo '<img src="'.$photoPath.'" alt="Student Photo">';
    echo '</div></div></div>';
    // Company Details
    echo '<h2>Company Details</h2><div class="view-apply">';
    echo '<div class="sides-apply">';
    echo '<p>Company Name: '.htmlspecialchars($row['stdf_cname']).'</p>';
    echo '<p>Country: '.htmlspecialchars($row['stdf_ccountry']).'</p>';
    echo '<p>Phone Number: '.htmlspecialchars($row['stdf_cphone']).'</p>';
    echo '<p>working field: '.htmlspecialchars($row['stdf_cfield']).'</p>';
    echo '<p>work to be done: '.htmlspecialchars($row['stdf_cwtbd']).'</p>';
    echo '</div><div class="sides-apply">';
    echo '<p>Website: '.htmlspecialchars($row['stdf_cwebsite']).'</p>';
    echo '<p>Fax: '.htmlspecialchars($row['stdf_cfax']).'</p>';
    echo '<p>email: '.htmlspecialchars($row['stdf_cemail']).'</p>';
    echo '<p>Duration: '.htmlspecialchars($row['stdf_cduration']).'</p>';
    echo '<p>address: '.htmlspecialchars($row['stdf_caddress']).'</p>';
    echo '</div></div>';
    // Company Supervisor
    echo '<h2>Company Supervisor</h2><div class="view-apply">';
    echo '<div class="sides-apply">';
    echo '<p>first name: '.htmlspecialchars($row['stdf_csfname']).'</p>';
    echo '<p>last name: '.htmlspecialchars($row['stdf_cslname']).'</p>';
    echo '</div><div class="sides-apply">';
    echo '<p>E-Mail: '.htmlspecialchars($row['stdf_csemail']).'</p>';
    echo '<p>his/her position: '.htmlspecialchars($row['stdf_csposition']).'</p>';
    echo '</div></div>';
    echo '<button type="button" onclick="event.preventDefault(); displayInfo(\''.$infoDivId.'\')">close</button>';
    echo '</div>';
    echo '<input type="hidden" name="stdf_id" value="'.htmlspecialchars($row['stdf_id']).'">';
    echo '<button type="button" class="approve-button" onclick="updateStatus('.htmlspecialchars($row['stdf_stdnum']).', \'approved\')">Approve</button>';
    echo '<button type="button" class="reject-button" onclick="updateStatus('.htmlspecialchars($row['stdf_stdnum']).', \'rejected\')">Reject</button>';
    echo '</td>';
}
?>
