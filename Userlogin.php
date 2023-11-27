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
if ($conn == false) {
    die(print_r(sqlsrv_errors(), true));
}

// Common function to display user profile
function displayUserProfile($conn, $userId) {


    $sql = "SELECT * FROM USER_DATA WHERE USERID = ?";
    $params = array($userId);
    $stmt = sqlsrv_query($conn, $sql, $params);
    

    if ($stmt !== false && sqlsrv_has_rows($stmt)) {
        $userDetails = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        // Construct the full name, checking if the middle name is present
        $fullName = htmlspecialchars($userDetails['FIRSTNAME']);
        if (!empty($userDetails['MIDDLENAME']) && $userDetails['MIDDLENAME'] !== 'NA') {
            $fullName .= " " . htmlspecialchars($userDetails['MIDDLENAME']);
        }
        $fullName .= " " . htmlspecialchars($userDetails['LASTNAME']);


        // Include Bootstrap for modern styling
        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>";

        // Custom style for a larger badge
        echo "<style>
            .badge-custom {
                padding: 0.6em 0.75em;
                font-size: 1rem;
            }
        </style>";
    
        // Use Bootstrap classes to center the card
        echo "<div class='d-flex justify-content-center align-items-center' style='height: 100vh;'>";
        echo "<div class='card shadow-lg' style='max-width: 60rem; width: 100%;   border-radius: 20px;'>"; // Set a max-width for the card and allow it to be responsive
        echo "<div class='card-header bg-dark text-white d-flex justify-content-between align-items-center' style='border-radius: 10px;'>";
        echo "<h5 class='mb-0'>Welcome, " . htmlspecialchars($userDetails['FIRSTNAME']) . "!</h5>";
        echo "<div class='btn-toolbar'>";
        // Use button classes for both User ID and Log Out elements
        echo "<div class='btn-group me-2'>";
        echo "<span class='badge bg-light text-dark' style='padding: 0.375rem 0.75rem; font-size: 1rem;'>User ID: " . htmlspecialchars($userId) . "</span>";
        echo "</div>";
        echo "<div class='btn-group'>";
        echo "<a href='login.php' class='btn btn-sm btn-outline-light'>Log Out</a>";
        echo "</div>";
        echo "</div>"; // End btn-toolbar
        echo "</div>"; // End card-header
        echo "<div class='card-body'>";
        echo "<div class='row'>";
        echo "<div class='col-md-6'>";
        echo "<p class='fw-bold'>Name:</p>";
        echo "<p>" . $fullName . "</p>"; // Display the full name here
        echo "<p class='fw-bold'>Contact:</p>";
        echo "<p>" . htmlspecialchars($userDetails['CONTACT']) . "</p>";
        echo "<p class='fw-bold'>TIN:</p>";
        echo "<p>" . htmlspecialchars($userDetails['TIN']) . "</p>";
        echo "</div>";
        echo "<div class='col-md-6'>";
        echo "<p class='fw-bold'>Address:</p>";
        echo "<p>" . htmlspecialchars($userDetails['PROVINCE']) . ", " . htmlspecialchars($userDetails['CITY']) . ", " . htmlspecialchars($userDetails['STREET']) . ", " . htmlspecialchars($userDetails['HOUSE_NO']) . "</p>";
        echo "<p class='fw-bold'>Other Details:</p>";
        echo "<p>Gender: " . htmlspecialchars($userDetails['GENDER']) . "<br />";
        echo "Birthdate: " . ($userDetails['BIRTHDATE'] ? htmlspecialchars($userDetails['BIRTHDATE']->format('Y-m-d')) : '') . "<br />";
        echo "Height: " . htmlspecialchars($userDetails['HEIGHT']) . " cm<br />";
        echo "Weight: " . htmlspecialchars($userDetails['WEIGHT']) . " kg</p>";
        echo "</div>";
        echo "</div>"; // Row
        echo "</div>"; // Card Body
        echo "</div>"; // Card
        echo "</div>"; // Container
    } else {
        echo "User data not found.";
    }
}

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Admin Check and Redirect
    if ($username === 'Admin' && $password === 'Admin') {
        header('Location: reports.php');
        exit();
    }

    // Check if the username and password combination exists
    $sql = "SELECT USERID FROM ACCOUNTS WHERE USERNAME = ? AND PASSWORD = ?";
    $params = array($username, $password);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt !== false && sqlsrv_has_rows($stmt)) {
        // Login successful
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $_SESSION['userid'] = $row['USERID'];
        displayUserProfile($conn, $_SESSION['userid']);
        exit();
    } else {
        // Check if the username exists
        $sql = "SELECT USERID FROM ACCOUNTS WHERE USERNAME = ?";
        $params = array($username);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt !== false && !sqlsrv_has_rows($stmt)) {
            // Username does not exist
            $_SESSION['error_message'] = "Invalid username.";
        } else {
            // Username exists, so the password must be incorrect
            $_SESSION['error_message'] = "Invalid password.";
            $_SESSION['attempted_username'] = $username; // Store the username
        }

        header("location: login.php");
        exit();
    }
} elseif (isset($_SESSION['userid'])) {
    // Display user profile for already logged-in users
    displayUserProfile($conn, $_SESSION['userid']);
} else {
    header("location: login.php");
}

// Close the database connection
sqlsrv_close($conn);
?>


