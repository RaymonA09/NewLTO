<?php
session_start();

// Database connection
$serverName = "LAPTOP-50DT4DQ6\SQLEXPRESS";
$connectionOptions = [
    "Database" => "WEBAPP",
    "Uid" => "",
    "PWD" => ""
];

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Check if the form was submitted and the session user ID is set
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['editUserID'])) {
    $userid = $_SESSION['editUserID'];

// Assuming 'A', 'B', 'C1', 'C2', etc. are the TOA choices
$a = isset($_POST['A']) ? 1 : 0;
$b = isset($_POST['B']) ? 1 : 0;
$c1 = isset($_POST['C1']) ? 1 : 0;
$c2 = isset($_POST['C2']) ? 1 : 0;
$d = isset($_POST['D']) ? 1 : 0;
$e = isset($_POST['E']) ? 1 : 0;
$f = isset($_POST['F']) ? 1 : 0;
$g = isset($_POST['G']) ? 1 : 0;
$h1 = isset($_POST['H1']) ? 1 : 0;
$h2 = isset($_POST['H2']) ? 1 : 0;
$h3 = isset($_POST['H3']) ? 1 : 0;
$h4 = isset($_POST['H4']) ? 1 : 0;
$h5 = isset($_POST['H5']) ? 1 : 0;
$h6 = isset($_POST['H6']) ? 1 : 0;

// TLA choices
$student_permit = isset($_POST['STUDENT_PERMIT']) ? 1 : 0;
$non_professional = isset($_POST['NON_PROFESSIONAL']) ? 1 : 0;
$professional = isset($_POST['PROFESSIONAL']) ? 1 : 0;
$conductor = isset($_POST['CONDUCTOR']) ? 1 : 0;

// DSA choices
$driving_school = isset($_POST['DRIVING_SCHOOL']) ? 1 : 0;
$licensed_private_person = isset($_POST['LICENSED_PRIVATE_PERSON']) ? 1 : 0;

// EA choices
$informal_schooling = isset($_POST['INFORMAL_SCHOOLING']) ? 1 : 0;
$elementary = isset($_POST['ELEMENTARY']) ? 1 : 0;
$high_school = isset($_POST['HIGH_SCHOOL']) ? 1 : 0;
$vocational = isset($_POST['VOCATIONAL']) ? 1 : 0;
$college = isset($_POST['COLLEGE']) ? 1 : 0;
$post_graduate = isset($_POST['POST_GRADUATE']) ? 1 : 0;

// SQL Update query
$sql = "UPDATE APPLICATION_DETAILS SET 
            A = ?, 
            B = ?, 
            C1 = ?, 
            C2 = ?, 
            D = ?, 
            E = ?, 
            F = ?, 
            G = ?, 
            H1 = ?, 
            H2 = ?, 
            H3 = ?, 
            H4 = ?, 
            H5 = ?, 
            H6 = ?,
            STUDENT_PERMIT = ?, 
            NON_PROFESSIONAL = ?, 
            PROFESSIONAL = ?, 
            CONDUCTOR = ?,
            DRIVING_SCHOOL = ?, 
            LICENSED_PRIVATE_PERSON = ?, 
            INFORMAL_SCHOOLING = ?, 
            ELEMENTARY = ?, 
            HIGH_SCHOOL = ?, 
            VOCATIONAL = ?, 
            COLLEGE = ?, 
            POST_GRADUATE = ?
        WHERE USERID = ?";

$params = [
    $a, $b, $c1, $c2, $d, $e, $f, $g, $h1, $h2, $h3, $h4, $h5, $h6,
    $student_permit, $non_professional, $professional, $conductor,
    $driving_school, $licensed_private_person,
    $informal_schooling, $elementary, $high_school, $vocational, $college, $post_graduate,
    $userid
];

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Record updated successfully.";
    echo "<a href='View.php?userid=" . urlencode($userid) . "'><button>Back to Update Form</button></a>";
}
} else {
echo "Invalid request";
}
?>