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
            <?php
            $server = "localhost";
            $username = "root";
            $password = "";
            $db = mysqli_connect($server, $username, $password);

            // Check connection
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

                    // Fetch the suitable bikes from the database
                    $sql = "SELECT * FROM `ev`.`electric_bikes` ORDER BY `ex_showroom_price` ASC";
                    $result = $db->query($sql);

                    // Display the data in an HTML table format
                    if ($result->num_rows > 0) {
                        echo "<h4 style='margin-top:50px;font-size:30px;'>All electric two wheelers in the database</h4>";
                        echo "<table>";
                        echo "<tr><th>Model Name</th><th>Battery Capacity</th><th>Real Range</th><th >Charging Time</th><th>Ex Showroom Price</th><th>More information</th></tr>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["model_name"] . "</td><td>" . $row["battery_cap"] . "</td><td>" . $row["real_range"] . "</td><td >" . $row["charging_time"] . "</td><td >" . $row["ex_showroom_price"] . "</td><td ><a href='" . $row["website"] . "' target='_blank'>" . $row["website"] . "</a></td></tr>";
                        }
                        echo "</table>";
                }
            $db->close();
            ?>
    
    <div class="facts">
        <h2>Myth :</h2>
        <p>The charging infrastructure must be built before people will adopt EVs.</p>
        <h2>Fact :</h2>
        <p>The charging infrastructure is already developed.  All you need to power your EV is an electric socket at home.  Most charging will be done at home, so a public charging infrastructure isn’t a prerequisite. Still, a robust infrastructure will help, especially for apartment dwellers and those regularly driving long distances</p>
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