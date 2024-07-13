<!-- Form to add vehicles to database table. -->

<!--      ("Hero OptimaCX", "1.5kw", "55km", "04:45:00", 67190),
          ("Epluto 7G", "2.5kw", "90km", "04:00:00", 86999),
          ("Bounce E1", "1.9kw", "65km", "04:00:00", 96799),
          ("Praise Pro", "2.0kw", "65km", "03:00:00", 99645),
          ("TVS Iqube", "3.04kw", "100km", "07:00:00", 99999),
          ("Ola E S1", "3.0kw", "105km", "05:00:00", 109999),
          ("Bajaj Chetak", "2.94kw", "90km", "04:00:00", 122000),
          ("Ola S1 Pro", "4.0kw", "135km", "05:45:00", 129999),
         ("Ather 450x", "3.66kw", "105km", "05:30:00", 142000),
         ("Vida V1 Pro", "3.94kw", "95km", "07:00:00", 146880)';
 -->


<?php
$server = "localhost";
$username = "root";
$password = "";
$db = mysqli_connect($server, $username, $password);
if (isset($_POST['model_name']) && isset($_POST['battery_cap']) && isset($_POST['real_range']) && isset($_POST['charging_time']) && isset($_POST['ex_showroom_price'])) {
    $model_name = $_POST['model_name'];
    $battery_cap = $_POST['battery_cap'];
    $real_range = $_POST['real_range'];
    $charging_time = $_POST['charging_time'];
    $ex_showroom_price = $_POST['ex_showroom_price'];
    $sql = "INSERT INTO `ev`.`electric_bikes`(`model_name`, `battery_cap`, `real_range`, `charging_time`, `ex_showroom_price`) VALUES ('$model_name','$battery_cap','$real_range','$charging_time','$ex_showroom_price')";
    $db->query($sql);
    if ($db->query($sql)) {
        echo "<div class='submitMsg'>Data added successfully!</div>";
    } else {
        echo "<div class='submitMsg'>Error adding data to database</div>";
    }    
}
$db->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database entry</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto|Sriracha&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 60%;
            padding: 34px;
            margin: auto;
            background-color: white;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        }

        body {
            background-image: url('ev-background.png');
            background-size: 100%;
            opacity: 0.89;
            background-position: center bottom;
            background-repeat: no-repeat;
            z-index: -1;
        }

        p {
            font-size: 25px;
            text-align: center;
            font-family: 'Sriracha', cursive;
        }

        input,
        textarea {
            border: 2px solid black;
            border-radius: 6px;
            outline: none;
            font-size: 16px;
            width: 100%;
            margin: 11px 0px;
            padding: 10px;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .btn {
            color: white;
            padding: 10px 20px;
            font-size: 20px;
            border: 2px solid white;
            border-radius: 14px;
            cursor: pointer;
            margin-right: 10px;
            border-radius: 10px;
        }
        
        .reset-btn {
            background: red;
        }
        .submit-btn {
            background: green;
        }
        
        .btn-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .bg {
            width: 100%;
            position: absolute;
            z-index: -1;
            opacity: 0.6;
        }

        .submitMsg {
            fontfont-size: 22px;
            color: green;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Enter vehicle details to add to database</h3>
        <form action="insert.php" method="post" onsubmit="return validateForm()">
            <input type="text" name="model_name" id="model_name" placeholder="Model name">
            <input type="text" name="battery_cap" id="battery_cap" placeholder="Battery capacity in kW">
            <input type="text" name="real_range" id="real_range" placeholder="Average range in kms">
            <input type="text" name="charging_time" id="charging_time" placeholder="Charging time in hh:mm:ss">
            <input type="text" name="ex_showroom_price" id="ex_showroom_price" placeholder="Ex showroom price">
            <div class="btn-group">
                <button class="btn submit-btn" type="submit">Submit</button>
                <button class="btn reset-btn" type="reset">Reset</button>
            </div>

        </form>
        <div class="submitMsg"></div>
    </div>
    <script>
        function validateForm() {
            var modelName = document.getElementById("model_name").value;
            if (modelName == "") {
                alert("Model name must be filled out");
                return false;
            }
        }
    </script>
</body>

</html>