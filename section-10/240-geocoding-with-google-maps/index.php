

<!DOCTYPE html>
<html>
<head>
  <!-- JQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <title>Google API - Geocoding</title>
</head>
<body>
  <script type="text/javascript">
    $.ajax({
      url: "https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=API_KEY",
      type: "GET",
      success: function (data) {
        $.each(data["results"][0]["address_components"], function(key, value) {
          //alert(value["types"]);

          if(value["types"][0] == "country") {
            alert("Country: "+value["long_name"]);
          }

        })
      }
    })
  </script>
</body>
</html>