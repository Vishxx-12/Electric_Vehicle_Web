<?php
$server = "localhost";
$username = "root";
$password = "";
$db = mysqli_connect($server, $username, $password);
if (isset($_POST['battery_cap']) && isset($_POST['real_range']) && isset($_POST['charging_time'])) {
              $battery_cap = $_POST['battery_cap'];
              $real_range = $_POST['real_range'];
              $charging_time = $_POST['charging_time'];
          echo "<script>";
          echo "real_range = '$real_range';";
          echo "battery_cap = '$battery_cap';";
          echo "charging_time = '$charging_time';";
          echo "</script>";
              } else {
                echo "Error adding vehicle";
              }
          $db->close();
?>
<!DOCTYPE html>
<html>

<head>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <title>Driving Distance Calculator</title>
  <link rel="stylesheet" href="style.css">

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
      </div><br>
      <div class="forms" style="display:flex;justify-content:space-evenly;">
        <form id="trip-form" style="margin: 20px 0 0 20px;">
          <h1 style="margin:5px 0 0 25px; font-size:35px;text-align: center;width: 1100px;">Driving Distance and charge time calculator for vehicles not present in the database</h1>
          <div class="form">
            <ul style="font-size: 25px;">
              <li>
                <label for="start-location">Starting Location:</label>
                <input type="text" id="start-location" name="start-location" required style="font-size: 18px;">
              </li>
              <li>
                <label for="end-location">Destination Location: </label>
                <input type="text" id="end-location" name="end-location" required style="font-size: 18px;">
              </li>
              <li>
                <button type="submit" class="btn"
                  style="font-size: 18px;padding:8px 30px;margin:60px 0;">Calculate</button>
              </li>
            </ul>
          </div>
        </form>
      </div>
      <?php
      echo '<p style="font-size:20px;margin:60px 0 0 100px;">Vehicle Selected : Other</p>';
      ?>
      <div id="result" class='result' style="font-size: 25px;margin:40px 0 0 50px;"></div>
      <div id="result2" class='result2' style="font-size: 27px;margin:30px 0 120px 50px;"></div>
      <div class="row">
        <div class="col-2">
          <h1>Purchase <br>Assist</h1>
          <p>Get to know the best suited Electric Scooter<br> for your daily commute.</p>
          <a href="" class="btn">Try now</a>
        </div>
        <div class="col-2">
          <img src="images/buying.webp" alt="Electric two wheelers"
            style="height: 320px;width: 596px;border-radius:30px;">
        </div>
      </div>
    </div>
  </div>
  <div class="facts">
    <h2>Myth :</h2>
    <p> Switching to an electric vehicle will ensure that the electricity grid will collapse.</p>
    <h2>Fact :</h2>
    <p> Even if the majority of drivers switched to electric, the existing electrical grid's off-peak/nighttime
      capacity for power generation is sufficient without building a single new power plant. Studies have shown that
      electric vehicle owners will largely charge their vehicles at night when there is plenty of capacity on the
      grid.</p>
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
          <a href="https://instagram.com" target="_blank"><img src="images/insta_icon.png" alt="Instagram"></a>
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
    function trip(startLocation, endLocation) {
      // Define API key and URLs
      const API_KEY = '5b3ce3597851110001cf62489aee5fd792b74df4b634f74ae17dc87b';
      const geocodingUrl = 'https://api.openrouteservice.org/geocode/search';
      const directionsUrl = 'https://api.openrouteservice.org/v2/directions/driving-car';

      // Construct URL for geocoding API
      const startGeocodingUrl = new URL(geocodingUrl);
      startGeocodingUrl.searchParams.append('api_key', API_KEY);
      startGeocodingUrl.searchParams.append('text', startLocation);
      startGeocodingUrl.searchParams.append('size', '1');

      const endGeocodingUrl = new URL(geocodingUrl);
      endGeocodingUrl.searchParams.append('api_key', API_KEY);
      endGeocodingUrl.searchParams.append('text', endLocation);
      endGeocodingUrl.searchParams.append('size', '1');

      // Make requests to geocoding APIs
      Promise.all([
        fetch(startGeocodingUrl.toString()),
        fetch(endGeocodingUrl.toString()),
      ]).then(responses => Promise.all(responses.map(response => response.json())))
        .then(jsons => {
          const startData = jsons[0].features[0].geometry;
          const endData = jsons[1].features[0].geometry;

          // Construct URL for directions API
          const directionsParams = new URLSearchParams({
            api_key: API_KEY,
            start: `${startData.coordinates[0]},${startData.coordinates[1]}`,
            end: `${endData.coordinates[0]},${endData.coordinates[1]}`,
            instructions: 'true',
            geometry_format: 'geojson',
          });
          const directionsUrlWithParams = `${directionsUrl}?${directionsParams}`;

          // Make request to directions API
          return fetch(directionsUrlWithParams);
        })
        .then(response => response.json())
        .then(data => {
          // Check for error
          if ('error' in data) {
            throw new Error('Failed to retrieve directions.');
          }

          // Get distance in kilometers
          const distance = (data.features[0].properties.segments[0].distance / 1000).toFixed(2);

          // Display result
          const resultDiv = document.getElementById('result');
          resultDiv.innerHTML = `<p style="font-size:24px;color:rgb(0, 99, 0);">This charging time estimate is calculated for a single rider only!</p><br>Driving distance between ${startLocation} and ${endLocation} is ${distance} km.<br> Range of vehicle selected = ${real_range}km<br>Battery Capacity = ${battery_cap}kW<br>Charging time = ${charging_time}`;
          const resultDiv2 = document.getElementById('result2');
          if (parseInt(distance) <= parseInt(real_range)) {
            resultDiv2.innerHTML = `You will reach your destination with a single charge!`;
          }
          else {
            //converting vehicle chg_time in hh:mm:ss to hours
            charging_time_str = charging_time.toString();
            const [hours, minutes, seconds] = charging_time_str.split(":").map(Number);   //destructuring assignment and .map() function with Number() function.
            const totalHours = hours + (minutes / 60) + (seconds / 3600);

            chg_rate = battery_cap / totalHours;
            charging_el = (((distance / real_range) * battery_cap) - battery_cap).toFixed(2);
            charging_time_trip = charging_el / chg_rate;
            hour = charging_time_trip;

            //converting chg_time_trip to hh:mm:ss
            const second = Math.round(hour * 3600);
            const hoursInTime = Math.floor(second / 3600);
            const remainder = second % 3600;
            const minute = Math.floor(remainder / 60);
            const secondsLeft = 00;
            const time_str = `${hoursInTime.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}:${secondsLeft.toString().padStart(2, '0')}`;
            //Displaying chg_time_trip
            resultDiv2.innerHTML = `You'll have to charge for atleast ${time_str} during the trip to reach your destination.<br>Total electricity required for charging on the trip = ${charging_el} kWh.`;
          }

        })
        .catch(error => {
          const resultDiv = document.getElementById('result');
          resultDiv.innerHTML = `Error: ${error.message}`;
        });
    }

    const tripForm = document.getElementById('trip-form');
    tripForm.addEventListener('submit', event => {
      event.preventDefault();
      // Get the start and end locations
      const startLocation = document.getElementById('start-location').value;
      const endLocation = document.getElementById('end-location').value;

      // Calling the trip function with the start and end locations
      trip(startLocation, endLocation);
    });

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
    const form = document.getElementById('vehicle-form');
    const submitButton = form.querySelector('button[type="submit"]');
  </script>
</body>

</html>