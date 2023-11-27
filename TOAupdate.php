<?php

session_start();

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

$appData = array();


if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $_SESSION['editUserID'] = $userid;

    $sql = "SELECT AD.* FROM APPLICATION_DETAILS AD JOIN USER_DATA UD ON AD.USERID = UD.USERID WHERE AD.USERID = ?";
    $params = array($userid);
    $stmt = sqlsrv_query($conn, $sql, $params);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $appData = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

}

function set_checked($currentValue, $array, $key) {
    // Debugging: Uncomment the line below to see the values being compared.
    // echo "Checking: $key with value $currentValue against " . (isset($array[$key]) ? $array[$key] : 'null') . "<br>";

    if (isset($array[$key]) && (string)$array[$key] === (string)$currentValue) {
        echo 'checked';
    }
}
?>



<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="form.css">

    <title>Edit Application for Driver's License</title>
</head>

<body>
<section class="form" style = "margin-top: 1%";>

<form action="TOAupdated.php" method="post">


<div>
<h3 class="center" style="margin-bottom: 10px; margin-top: 30px; background-color: #003366; color: white;"> TYPE OF APPLICATION(TOA)</h3> 
<div class="container">
    

<div class="checkbox-container">
<input type="radio" id="A" name="A" value="A" <?php set_checked(1, $appData, 'A'); ?>>
        <label for="A" style="text-align: center;">A. NEW</label>
     </div>

<!-- B. DELINQUENT/DORMANT LICENSE -->
<div class="checkbox-container">
    <input type="radio" id="B" name="B" value="B" <?php set_checked(1, $appData, 'B'); ?>>
    <label for="B" style="text-align: center;">B. DELINQUENT/DORMANT LICENSE</label>
</div>

<!-- C1. PROF TO NON-PROF -->
<div class="checkbox-container">
    <input type="radio" id="C1" name="C1" value="C1" <?php set_checked(1, $appData, 'C'); ?>>
    <label for="C1" style="text-align: center;">PROF TO NON-PROF</label>
</div>

<!-- C2. NON-PROF TO PROF -->
<div class="checkbox-container">
    <input type="radio" id="C2" name="C2" value="C2" <?php set_checked(1, $appData, 'C2'); ?>>
    <label for="C2" style="text-align: center;">NON-PROF TO PROF</label>
</div>

<!-- D. FOREIGN LIC. CONVERSION -->
<div class="checkbox-container">
    <input type="radio" id="D" name="D" value="D" <?php set_checked(1, $appData, 'D'); ?>>
    <label for="D" style="text-align: center;">D. FOREIGN LIC. CONVERSION</label>
</div>

<!-- E. RENEWAL -->
<div class="checkbox-container">
    <input type="radio" id="E" name="E" value="E" <?php set_checked(1, $appData, 'E'); ?>>
    <label for="E" style="text-align: center;">E. RENEWAL</label> 
</div>

<!-- F. ADDITIONAL RESTRICTION CODE -->
<div class="checkbox-container">
    <input type="radio" id="F" name="F" value="F" <?php set_checked(1, $appData, 'F'); ?>>
    <label for="F" style="text-align: center;">F. ADDITIONAL RESTRICTION CODE</label>
</div>

<!-- G. DUPLICATE -->
<div class="checkbox-container">
    <input type="radio" id="G" name="G" value="G" <?php set_checked(1, $appData, 'G'); ?>>
    <label for="G" style="text-align: center;">G. DUPLICATE</label>
</div>

<!-- H1. REVISION OF RECORDS -->
<div class="checkbox-container">
    <input type="radio" id="H1" name="H1" value="H1" <?php set_checked(1, $appData, 'H1'); ?>>
    <label for="H1" style="text-align: center;">H. REVISION OF RECORDS</label>
</div>

<!-- H2. CHANGE ADDRESS -->
<div class="checkbox-container">
    <input type="radio" id="H2" name="H2" value="H2" <?php set_checked(1, $appData, 'H2'); ?>>
    <label for="H2" style="text-align: center;">CHANGE ADDRESS</label>
</div>

<!-- H3. CHANGE CIVIL STATUS -->
<div class="checkbox-container">
    <input type="radio" id="H3" name="H3" value="H3" <?php set_checked(1, $appData ,'H3'); ?>>
    <label for="H3" style="text-align: center;">CHANGE CIVIL STATUS</label>
</div>

<!-- H4. CHANGE NAME -->
<div class="checkbox-container">
    <input type="radio" id="H4" name="H4" value="H4" <?php set_checked(1, $appData ,'H4'); ?>>
    <label for="H4" style="text-align: center;">CHANGE NAME</label>
</div>

<!-- H5. CHANGE DATE OF BIRTH -->
<div class="checkbox-container">
    <input type="radio" id="H5" name="H5" value="H5" <?php set_checked(1, $appData ,'H5'); ?>>
    <label for="H5" style="text-align: center;">CHANGE DATE OF BIRTH</label>
</div>

<!-- H6. OTHERS -->
<div class="checkbox-container">
    <input type="radio" id="H6" name="H6" value="H6" <?php set_checked(1, $appData , 'H6'); ?>>
    <label for="H6" style="text-align: center;">OTHERS</label>
</div>



    </div>
</div>


<!-- TYPE OF LICENSE APPLIED FOR (TLA) Section -->
<div>
    <h3 class="center" style="margin-bottom: 5px; background-color: #003366; color: white;">TYPE OF LICENSE APPLIED FOR (TLA)</h3> 
    <div class="container exclusive-selection">
        <div class="checkbox-container">
            <input type="radio" id="t1" name="STUDENT_PERMIT" value="1" <?php set_checked(1, $appData, 'STUDENT_PERMIT'); ?>>
            <label for="t1" style="text-align: center;">1. STUDENT PERMIT</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="t2" name="NON_PROFESSIONAL" value="1" <?php set_checked(1, $appData, 'NON_PROFESSIONAL'); ?>>
            <label for="t2" style="text-align: center;">2. NON-PROFESSIONAL</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="t3" name="PROFESSIONAL" value="1" <?php set_checked(1, $appData, 'PROFESSIONAL'); ?>>
            <label for="t3" style="text-align: center;">3. PROFESSIONAL</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="t4" name="CONDUCTOR" value="1" <?php set_checked(1, $appData, 'CONDUCTOR'); ?>>
            <label for="t4" style="text-align: center;">4. CONDUCTOR</label>
        </div>
    </div>
</div>


<!-- DRIVING SKILL ACQUIRED OR WILL BE ACQUIRED THRU (DSA) Section -->
<div >
    <h3 class="center" style="margin-bottom: 5px; background-color: #003366; color: white;">DRIVING SKILL ACQUIRED OR WILL BE ACQUIRED THRU (DSA)</h3> 
    <div class="container exclusive-selection">
        <div class="checkbox-container">
            <input type="radio" id="d1" name="DRIVING_SCHOOL" value="1" <?php set_checked(1, $appData, 'DRIVING_SCHOOL'); ?>>
            <label for="d1" style="text-align: center;">1. DRIVING SCHOOL</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="d2" name="LICENSED_PRIVATE_PERSON" value="1" <?php set_checked(1, $appData, 'LICENSED_PRIVATE_PERSON'); ?>>
            <label for="d2" style="text-align: center;">2. LICENSED PRIVATE PERSON</label>
        </div>
    </div>
</div>



<!-- EDUCATIONAL ATTAINMENT (EA) Section -->
<div>
    <h3 class="center" style="margin-bottom: 5px; background-color: #003366; color: white;">EDUCATIONAL ATTAINMENT (EA)</h3> 
    <div class="container exclusive-selection">
        <div class="checkbox-container">
            <input type="radio" id="e1" name="INFORMAL_SCHOOLING" value="1" <?php set_checked(1, $appData, 'INFORMAL_SCHOOLING'); ?>>
            <label for="e1" style="text-align: center;">1. INFORMAL SCHOOLING</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="e2" name="ELEMENTARY" value="1" <?php set_checked(1, $appData, 'ELEMENTARY'); ?>>
            <label for="e2" style="text-align: center;">2. ELEMENTARY</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="e3" name="HIGH_SCHOOL" value="1" <?php set_checked(1, $appData, 'HIGH_SCHOOL'); ?>>
            <label for="e3" style="text-align: center;">3. HIGH SCHOOL</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="e4" name="VOCATIONAL" value="1" <?php set_checked(1, $appData, 'VOCATIONAL'); ?>>
            <label for="e4" style="text-align: center;">4. VOCATIONAL</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="e5" name="COLLEGE" value="1" <?php set_checked(1, $appData, 'COLLEGE'); ?>>
            <label for="e5" style="text-align: center;">5. COLLEGE</label>
        </div>
        <div class="checkbox-container">
            <input type="radio" id="e6" name="POST_GRADUATE" value="1" <?php set_checked(1, $appData, 'POST_GRADUATE'); ?>>
            <label for="e6" style="text-align: center;">6. POST GRADUATE</label>
        </div>
    </div>
</div>

<div class="checkbox-container">
                    <input type="submit" value="Update">
                </div>
</form>

</section>

<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function() {
    var radioButtonA = document.getElementById("A");
    var radioButtonE = document.getElementById("E");

    // Other TOA specific radio buttons
    var toaRadioButtons = document.querySelectorAll('input[type="radio"][name="H1"], input[type="radio"][name="H2"], input[type="radio"][name="H3"], input[type="radio"][name="H4"], input[type="radio"][name="H5"], input[type="radio"][name="H6"], input[type="radio"][name="B"], input[type="radio"][name="C1"], input[type="radio"][name="C2"], input[type="radio"][name="D"], input[type="radio"][name="F"], input[type="radio"][name="G"]');

    function disableOtherRadioButtons(disable) {
        toaRadioButtons.forEach(function(button) {
            button.disabled = disable;
            if (disable) {
                button.checked = false;
            }
        });
    }

    // Initialize state based on the selection
    if (radioButtonA.checked) {
        disableOtherRadioButtons(true);
        radioButtonE.disabled = false;
    } else if (radioButtonE.checked) {
        disableOtherRadioButtons(false);
    }

    // Change event for A
    radioButtonA.addEventListener("change", function() {
        if (radioButtonA.checked) {
            radioButtonE.checked = false;
            disableOtherRadioButtons(true);
            radioButtonE.disabled = false;
        }
    });

    // Change event for E
    radioButtonE.addEventListener("change", function() {
        if (radioButtonE.checked) {
            radioButtonA.checked = false;
            disableOtherRadioButtons(false);
        }
    });
});



window.onload = function() {
    function uncheckOthers(container, selectedRadio) {
        var radios = container.querySelectorAll('input[type="radio"]');
        radios.forEach(function(radio) {
            if (radio !== selectedRadio) {
                radio.checked = false;
            }
        });
    }

    var exclusiveContainers = document.querySelectorAll('.exclusive-selection');
    exclusiveContainers.forEach(function(container) {
        container.addEventListener('change', function(event) {
            if (event.target.type === 'radio') {
                uncheckOthers(container, event.target);
            }
        });
    });
};




</script>
</body>
</html>