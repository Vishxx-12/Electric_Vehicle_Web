
<!-- code to print db table contents. -->


<?php
$server = "localhost";
$username = "root";
$password = "";
$db = mysqli_connect($server, $username, $password);

// Fetch data from the database
$sql = "SELECT * FROM `ev`.`electric_bikes`";
$result = $db->query($sql);

// Display the data in an HTML table format
if ($result->num_rows > 0) {
    echo "<table style='border-collapse: collapse; width: 70%;'>";
    echo "<tr style='background-color: #dddddd;'><th style='padding: 10px; text-align: center;'>Model Name</th><th style='padding: 10px; text-align: center;'>Battery Capacity</th><th style='padding: 10px; text-align: center;'>Real Range</th><th style='padding: 10px; text-align: center;'>Charging Time</th><th style='padding: 10px; text-align: center;'>Ex Showroom Price</th><th style='padding: 10px; text-align: center;'>Website</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td style='padding: 10px; text-align: center;'>" . $row["model_name"] . "</td><td style='padding: 10px; text-align: center;'>" . $row["battery_cap"] . "</td><td style='padding: 10px; text-align: center;'>" . $row["real_range"] . "</td><td style='padding: 10px; text-align: center;'>" . $row["charging_time"] . "</td><td style='padding: 10px; text-align: center;'>" . $row["ex_showroom_price"] . "</td><td style='padding: 10px; text-align: center;'><a href='" . $row["website"] . "' target='_blank'>" . $row["website"] . "</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$db->close();
?>

