<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV | purchase assist and tour guide</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="pur_ass.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="navbar" style="font-size: 20px;">
                <div class="logo"><a href="index.html">
                        <img src="images/logo.webp" width="60vh"></a>
                </div>
                <a href="index.html">
                    <h2 style="margin: 0 20px;">For a Greener India</h2>
                </a>
                <nav>
                    <h3>EV Purchase assist and trip planner</h3>
                    <ul id="menuitems">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.html">Vehicles</a></li>
                        <li><a href="showall.php">Database</a></li>
                        <li><a href="about.html">About</a></li>
                    </ul>
                </nav>
                <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
            </div>

            <div style="display:flex;margin:30px 0 10px 20px;justify-content:space-evenly;">
                <form action="" method="post" style="font-size: 20px;">
                <h2><br>Find Suitable Electric Bikes</h2><br>
                    <label for="daily_travel">Daily Travel Distance:</label>
                    <input type="number" min="1" name="daily_travel" class="daily_travel" id="daily_travel"
                        placeholder="in kilometres" required>
                    <button type="submit" class="btn">Find Bikes</button> <br><br><br><br>
                </form>
                <p style="font-size:21px;margin: 103px 0 0 auto;">Lists upto 4 most suitable electric two wheelers considering parameters <br>such as your daily travel, range, battery capacity <br>and price of the vehicle.</p>
            </div>
            </form>
            <?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $db = mysqli_connect($server, $username, $password);

            // Check connection
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

            // Get the input value
            if (isset($_POST['daily_travel'])) {
                $daily_travel = $_POST['daily_travel'];
                if ($daily_travel <= 45 && $daily_travel > 0) {
                    // Fetch the suitable bikes from the database
                    $sql = "SELECT * FROM `ev`.`electric_bikes` WHERE `real_range` >= $daily_travel * 3 ORDER BY `ex_showroom_price` ASC LIMIT 4";
                    $result = $db->query($sql);

                    // Display the data in an HTML table format
                    if ($result->num_rows > 0) {
                        echo "<h4>Most suitable electric two wheelers based on your requirements in increasing prices are:</h4>";
                        echo "<table>";
                        echo "<tr><th>Model Name</th><th>Battery Capacity</th><th>Real Range</th><th >Charging Time</th><th>Ex Showroom Price</th><th>More information</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["model_name"] . "</td><td>" . $row["battery_cap"] . "</td><td>" . $row["real_range"] . "</td><td >" . $row["charging_time"] . "</td><td >" . $row["ex_showroom_price"] . "</td><td ><a href='" . $row["website"] . "' target='_blank'>" . $row["website"] . "</a></td></tr>";
                        }
                        echo "</table><br><a href='showall.php'><button type='submit' class='btn'style='margin: 40px 0 0 55px;'>Show all</button></a>";
                        echo "<p class='info'><br><br> These vehicles ensure that you can travel atleast three days before needing to re-charge the
                battery, ensuring long life of the battery over it's lifecycle.<br><br>On average a 125cc or greater petrol scooter produces 83grams of Co2 per kilometre</p>";
                        // Source- https://calculator.carbonfootprint.com/calculator.aspx?tab=5
                        $petrol = 28 * (2.5 * $daily_travel); //2.5 rupees avg per km
                        $elec = 28 * (0.25 * $daily_travel); //0.25 rupee avg per km
                        $c_saving = 28 * (83 * $daily_travel);
                        $kg = $c_saving / 1000;
                        $kg = (int) $kg;
                        $gms = $c_saving % 1000;
                        $savings = $petrol - $elec;
                        $savings = round($savings, 2);
                        echo "<br><br><p class='info'><b>By switching to electric, you would save " . $kg . "kg " . $gms . "gms of direct Co2 emmisions per month.</b><br><br><br>For " . $daily_travel . "kms daily, petrol costs for a month = Rs." . $petrol . "<br>Electricty cost for charging over a month = Rs." . $elec . "<br>Total savings in just a month = Rs." . $savings . "</p>";

                    }
                } else if ($daily_travel > 45 && $daily_travel < 67) {
                    // Fetch the suitable bikes from the database
                    $sql = "SELECT * FROM `ev`.`electric_bikes` WHERE `real_range` >= $daily_travel * 2 ORDER BY `ex_showroom_price` ASC LIMIT 3";
                    $result = $db->query($sql);

                    // Display the data in an HTML table format
                    if ($result->num_rows > 0) {
                        echo "<table>";
                        echo "<tr><th>Model Name</th><th>Battery Capacity</th><th>Real Range</th><th >Charging Time</th><th>Ex Showroom Price</th><th>More information</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["model_name"] . "</td><td>" . $row["battery_cap"] . "</td><td>" . $row["real_range"] . "</td><td >" . $row["charging_time"] . "</td><td >" . $row["ex_showroom_price"] . "</td><td ><a href='" . $row["website"] . "' target='_blank'>" . $row["website"] . "</a></td></tr>";
                        }
                        echo "</table><br><a href='showall.php'><button type='submit' class='btn'style='margin: 40px 0 0 55px;'>Show all</button></a>";
                        echo "<p class='info'><br><br> These vehicles ensure that you can travel atleast two days before needing to re-charge the
                    battery, ensuring long life of the battery over it's lifecycle.<br><br>On average a 125cc or greater petrol scooter produces 83grams of Co2 per kilometre</p>";
                        // Source- https://calculator.carbonfootprint.com/calculator.aspx?tab=5
                        $petrol = 28 * (2.5 * $daily_travel); //2.5 rupees avg per km
                        $elec = 28 * (0.25 * $daily_travel); //0.25 rupee avg per km
                        $c_saving = 28 * (83 * $daily_travel);
                        $kg = $c_saving / 1000;
                        $kg = (int) $kg;
                        $gms = $c_saving % 1000;
                        $savings = $petrol - $elec;
                        $savings = round($savings, 2);
                        echo "<br><br><p class='info'><b>By switching to electric, you would save " . $kg . "kg " . $gms . "gms of direct Co2 emmisions per month.</b><br><br><br>For " . $daily_travel . "kms daily, petrol costs for a month = Rs." . $petrol . "<br>Electricty cost for charging over a month = Rs." . $elec . "<br>Total savings in just a month = Rs." . $savings . "</p>";

                    }
                } else {
                    echo "No electric vehicles found for " . $daily_travel . " kms daily travel.";
                }
            }
            $db->close();
            ?>
            <div class="row">
                <div class="col-2">
                    <h1>Plan trips<br>on your new EV</h1>
                    <p>Get the best navigation assist for your travel <br>
                        between cities</p>
                    <a href="dist_calc.php" class="btn">Try now</a>
                </div>
                <div class="col-2">
                <a href="dist_calc.php"><img src="images/trip.png" style="max-width:30vw;border-radius:30px;" alt="Trip planner">
        </a> </div>
            </div>
        </div>
    </div>

    <div class="facts">
        <h2>Myth :</h2>
        <p> Vehicle batteries pose a recycling problem.<br> </p>
        <h2>Fact :</h2>
        <p> Newer batteries for electric vehicles, such as those made of lithium-ion, include even more valuable and
            recyclable metals and will have a life well beyond the vehicle. The battery pack material can be recycled to
            produce an alloy which can further be refined into cobalt, nickel, and other valuable metals as well as
            special grades of concrete.</p>
    </div>

    <div class="footer">
        <div class="small_container">
            <div class="row">
                <h3>Follow Us</h3>
                <div class="footer-col">
                    <a href="https://facebook.com" target="_blank">
                        <img src="images/facebook_icon.png" alt="FaceBook">
                    </a>
                </div>
                <div class="footer-col">
                    <a href="https://instagram.com" target="_blank"><img src="images/insta_icon.png"
                            alt="Instagram"></a>
                </div>
                <div class="footer-col">
                    <a href="https://twitter.com" target="_blank">
                        <img src="images/twitter_icon.png" alt="Twitter">
                    </a>
                </div>
                <div class="footer-col">
                    <a href="https://youtube.com" target="_blank">
                        <img src="images/youtube_icon.png" alt="YouTube">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <script>
        var menuitems = document.getElementById("menuitems");
        menuitems.style.maxHeight = "0px"
        function menutoggle() {
            if (menuitems.style.maxHeight == "0px") {
                menuitems.style.maxHeight = "200px";
            }
            else {
                menuitems.style.maxHeight = "0px";
            }
        }
    </script>
</body>

</html>