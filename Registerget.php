<?php
$serverName = "LAPTOP-50DT4DQ6\SQLEXPRESS";
$connectionOptions = [
    "Database" => "WEBAPP",
    "Uid" => "",
    "PWD" => ""
];

$conn = sqlsrv_connect($serverName, $connectionOptions);
if ($conn == false) {
    die(print_r(sqlsrv_error(), true));
}

$sql = "SELECT * FROM USER_DATA WHERE USERID = (SELECT MAX(USERID) FROM USER_DATA)";
$result = sqlsrv_query($conn, $sql);
if ($result === false) {
    die(print_r(sqlsrv_error(), true));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LTO Form</title>
    <style>
        body {
            font-family: 'Segoe UI', 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            background: linear-gradient(to right, #eef2f3, #8e9eab);
        }

        .container {
            max-width: 960px;
            width: 100%;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ffffff;
            color: #5D6470;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        h1 {
            font-size: 2.5rem;
            color: #4A4A4A;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 0px #fff;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

.buttons {
    text-align: center;
}

.edit-btn, .done-btn {
    background-color: black; /* Transparent background */
    color: white; /* White text */
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-family: 'Roboto', sans-serif; /* Stylish font */
    font-weight: 700; /* Bold font */
    font-size: 16px; /* Slightly larger font size */
    margin: 4px 2px;
    cursor: pointer;
    border: 2px solid white; /* White border */
    border-radius: 4px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2); /* Subtle text shadow for depth */
    transition: all 0.3s ease; /* Transition effect for smooth color change */
}

.edit-btn:hover, .done-btn:hover {
    background-color: white; /* White background on hover */
    color: black; /* Black text on hover */
    border-color: black; /* Black border on hover */
    text-shadow: none; /* Remove text shadow on hover for contrast */
}




        @media (max-width: 768px) {
            .container {
                margin: 1rem;
                padding: 1rem;
            }

            h1 {
                font-size: 2rem;
            }

            table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>User Details</h2>
        <table>
            <thead>
                <th>Name</th>
                <th>Present Address</th>
                <th>Information</th>
                <th>Other Details</th>
            </thead>
            <tbody>
                <?php
                while ($rows = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                    echo "<tr>
                        <td>Lastname: " . htmlspecialchars($rows['LASTNAME']) . "</td>
                        <td>Province: " . htmlspecialchars($rows['PROVINCE']) . "</td>
                        <td>TEL NO. / CP.NO.: " . htmlspecialchars($rows['CONTACT']) . "</td>
                        <td>GENDER: " . htmlspecialchars($rows['GENDER']) . "</td>
                    </tr>";
                    echo "<tr>
                        <td>Firstname: " . htmlspecialchars($rows['FIRSTNAME']) . "</td>
                        <td>City: " . htmlspecialchars($rows['CITY']) . "</td>
                        <td>TIN: " . htmlspecialchars($rows['TIN']) . "</td>
                        <td>BIRTH DATE: " . ($rows['BIRTHDATE'] ? htmlspecialchars($rows['BIRTHDATE']->format('Y-m-d')) : '') . "</td>
                    </tr>";
                    echo "<tr>
                        <td>Middlename: " . htmlspecialchars($rows['MIDDLENAME']) . "</td>
                        <td>Street: " . htmlspecialchars($rows['STREET']) . "</td>
                        <td>NATIONALITY: " . htmlspecialchars($rows['NATIONALITY']) . "</td>
                        <td>HEIGHT(cm): " . htmlspecialchars($rows['HEIGHT']) . "</td>
                    </tr>";
                    echo "<tr>
                        <td></td>
                        <td>No.: " . htmlspecialchars($rows['HOUSE_NO']) . "</td>
                        <td></td>
                        <td>WEIGHT(kg): " . htmlspecialchars($rows['WEIGHT']) . "</td>

                    </tr>";
                    echo "<tr>
                    <td colspan='4' class='buttons'>
                    <a href='update.php?userid=" . urlencode($rows['USERID']) . "' class='edit-btn'>Edit</a>
                    <a href='view.php' class='done-btn'>Done</a>
                    
                    </td>
                </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
