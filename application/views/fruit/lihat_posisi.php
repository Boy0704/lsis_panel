<!DOCTYPE html>
<html>
  <head>
    <title>Simple Markers</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>

    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->

    <script type="text/javascript">
      // function initMap() {
      //   const myLatLng = { lat: <?php echo $latitude ?>, lng: <?php echo $longitude ?> };
      //   const map = new google.maps.Map(document.getElementById("map"), {
      //     zoom: 18,
      //     center: myLatLng,
      //   });
      //   new google.maps.Marker({
      //     position: myLatLng,
      //     map,
      //     title: "<?php echo $latitude ?> <br> <?php echo $longitude ?> <br> <?php echo $date ?>",
      //   });
      // }

      function initMap() {
        const lokasi = { lat: <?php echo $latitude ?>, lng: <?php echo $longitude ?> };
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 18,
          center: lokasi,
        });
        const contentString =
          '<div id="content">' +
          '<div id="siteNotice">' +
          "</div>" +
          '<h1 id="firstHeading" class="firstHeading"><?php echo $nama ?></h1>' +
          '<div id="bodyContent">' +
          "Lokasi : <?php echo $address ?> <br>" +
          "Latitude : <?php echo $latitude ?> <br>" +
          "Longitude : <?php echo $longitude ?> <br>" +
          "Date : <?php echo $date ?> " +
          
          "</div>" +
          "</div>";
        const infowindow = new google.maps.InfoWindow({
          content: contentString,
        });
        const marker = new google.maps.Marker({
          position: lokasi,
          map,
          title: "Lokasi",
        });
        marker.addListener("click", () => {
          infowindow.open(map, marker);
        });
      }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAyfmnFvhRQqjFSW7euy935Pm8gVq9GE0&callback=initMap&libraries=&v=weekly"
      async></script>
  </body>
</html>