<?php
session_start();
$donors = isset($_SESSION['donors']) ? $_SESSION['donors'] : [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Donor Locator</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        #map {
            height: 500px;
            width: 100%;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
        }
        .highlight {
            background-color: yellow;
            border: 2px solid red;
        }
        .centered-button {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .popup-content {
            width: 200px;
        }
        .popup-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .popup-body {
            padding: 10px;
        }
        .popup-footer {
            text-align: center;
            padding: 10px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
    </style>
</head>
<body>
    <h1 class="text-center mt-3">Find Donors Near You</h1>
    <div id="map"></div>
    <div class="centered-button">
        <button onclick="getUserLocation()" class="btn btn-primary">Get My Location</button>
    </div>

    <script>
        var map;

        function initMap() {
            map = L.map('map').setView([17.3850, 78.4867], 12); // Default center for Hyderabad

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            fetchDonorData();
        }

        function fetchDonorData() {
            var donors = <?php echo json_encode($donors); ?>;
            console.log('Fetched donor data:', donors); // Debug log
            donors.forEach(donor => {
                var marker = L.marker([donor.latitude, donor.longitude])
                    .addTo(map)
                    .bindPopup(getPopupHTML(donor))
                    .on('click', function(e) {
                        this.getElement().classList.add('highlight');
                    });

                marker.on('popupclose', function(e) {
                    this.getElement().classList.remove('highlight');
                });
            });
        }

        function getPopupHTML(donor) {
            return `
                <div class="popup-content">
                    <div class="popup-header">
                        <h5>${donor.FullName}</h5>
                    </div>
                    <div class="popup-body">
                        <p ><strong>Blood Type:</strong> ${donor.BloodGroup}</p>
                        <p><strong>Age:</strong> ${donor.Age}</p>
                        <p><strong>Contact:</strong> ${donor.MobileNumber}</p>
                    </div>
                    <div class="popup-footer">
                        <button class="btn btn-sm btn-primary">Contact</button>
                    </div>
                </div>
            `;
        }

        function getUserLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var userLat = position.coords.latitude;
                    var userLng = position.coords.longitude;

                    var userMarker = L.marker([userLat, userLng])
                        .addTo(map)
                        .bindPopup('Your Location')
                        .openPopup();

                    map.setView([userLat, userLng], 12);
                }, function(error) {
                    alert('Error getting your location: ' + error.message);
                });
            } else {
                alert('Geolocation is not supported by your browser.');
            }
        }

        window.onload = function() {
            initMap();
        };
    </script>
</body>
</html>
