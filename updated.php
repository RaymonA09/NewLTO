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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Update</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        button {
            font-family: 'Poppins', sans-serif; /* Updated font family */
            background: #141E30;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #243B55, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #243B55, #141E30);
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            border: 3px solid #eee;

        }
        button:hover {
            background: #141E30;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #c1c1c1, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #b4b4b4, #787878);
            color: black;
            border: 3px solid #eee;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['editUserID'])) {
    $userid = $_SESSION['editUserID'];
    $lastname = $_POST['lastname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $middlename = $_POST['middlename'] ?? '';
    $province = $_POST['Province'] ?? '';
    $city = $_POST['City'] ?? '';
    $street = $_POST['street'] ?? '';
    $house_no = $_POST['house_no'] ?? '';
    $contact = $_POST['contact'] ?? '';
    $tin = $_POST['tin'] ?? '';
    $nationality = $_POST['nationality'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $height = $_POST['height'] ?? '';
    $weight = $_POST['weight'] ?? '';

    // SQL Update query
    $sql = "UPDATE USER_DATA SET 
                LASTNAME = ?, 
                FIRSTNAME = ?, 
                MIDDLENAME = ?, 
                PROVINCE = ?, 
                CITY = ?, 
                STREET = ?, 
                HOUSE_NO = ?, 
                CONTACT = ?, 
                TIN = ?, 
                NATIONALITY = ?, 
                GENDER = ?, 
                BIRTHDATE = ?, 
                HEIGHT = ?, 
                WEIGHT = ?
            WHERE USERID = ?";

    $params = [
        $lastname, 
        $firstname, 
        $middlename, 
        $province, 
        $city, 
        $street, 
        $house_no, 
        $contact, 
        $tin, 
        $nationality, 
        $gender, 
        $birthdate, 
        $height, 
        $weight, 
        $userid
    ];

    $stmt = sqlsrv_query($conn, $sql, $params);
            if ($stmt === false) {
                echo "<p>Error updating record: " . print_r(sqlsrv_errors(), true) . "</p>";
            } else {
                echo "<p>Record updated successfully.</p>";
                echo "<a href='registerget.php?userid=" . urlencode($userid) . "'><button>View Updated Record</button></a>";
            }
        } else {
            echo "<p>Invalid request</p>";
        }
        ?>
    </div>
</body>
</html>
<?php
// End of PHP
?>
