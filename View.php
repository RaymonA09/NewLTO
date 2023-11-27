<?php
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

    // Fetching the latest user's details including USERID
    $sql = "SELECT USERID, LASTNAME, FIRSTNAME FROM USER_DATA WHERE USERID = (SELECT IDENT_CURRENT('USER_DATA'))";
    $result = sqlsrv_query($conn, $sql);
    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    $userID = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="form.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500&display=swap" rel="stylesheet"> <!-- Google Font Link -->
    <title>LTO Form</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif; /* Updated font family */
            background-color: #eceff1;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 350px;
            margin-top: 50px;
        }

        h2 {
            color: #444;
            margin-bottom: 20px;
        }

        button {
            font-family: 'Poppins', sans-serif; /* Updated font family */
            background: #141E30;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #243B55, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #243B55, #141E30);
            color: #fff;
            padding: 10px 20px;
            border: 3px solid #141E30;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
            transition: transform 0.2s ease, background-color 0.2s ease; /* Transition for transform and background color */
        }

        button:hover {
            background: #141E30;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #c1c1c1, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #b4b4b4, #787878);
            color: #fff;
            border: 3px solid #eee;
        }

        button a {
            color: inherit; /* Inherits color from the button */
            text-decoration: none;
            display: block;
        }

        button a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Welcome, <?php echo $userID['FIRSTNAME']; ?> <?php echo $userID['LASTNAME']; ?></h2>
        <button><a href="Registerget.php">View my records</a></button>
        <button><a href="TOAupdate.php?userid=<?php echo urlencode($userID['USERID']); ?>">Change Application Details</a></button>
        <button><a href="register.html" class="edit-btn">Done</a></button>
    </div>
</body>
</html>
