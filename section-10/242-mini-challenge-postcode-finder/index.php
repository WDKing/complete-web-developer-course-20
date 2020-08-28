<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <title>Google API - Postcode Finder </title>

  <style type="text/css">
    
    body {
      background-image: url(./images/mathyas-kurmann-fb7yNPbT0l8-unsplash.jpg) !important;
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      height: 100%;
      display: flex;
    }

    .container-fluid {
      color: #FFFFFF;
    }

    #form-container {
      margin-top: 100px;
    }

    #address,#success-notice,#error-notice {
      width: 80%;
      margin: auto;
    }

  </style>
</head>
<body>

  <div class="container-fluid text-center" id="form-container">
    <h3>Postcode Finder</h3>
    <form>
      <div class="form-group">
        <label for="address">
          Enter a portion of the address to search for the postal code:<br>
        </label>
        <input type="text" class="form-control" name="address" id="address">
      </div>
      <div class="form-group">
        <input type="button" class="btn btn-light" name="submit" id="submit" value="Submit">
      </div>
    </form>  
    <div class="alert-success" id="success-notice"></div>
    <div class="alert-danger" id="error-notice"></div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  <script type="text/javascript">
    var API_KEY = "";
    var zipLocated = false;

    $("#submit").click(function() {   
      $("#success-notice").html("");
      $("#error-notice").html("");
      zipLocated = false;

      $.ajax({
        url: "https://maps.googleapis.com/maps/api/geocode/json?",
        type: "GET",
        data: { address: $("#address").val(), key: API_KEY },
        success: function (data) {
          if(data["status"] == "OK") {          
            $.each(data["results"][0]["address_components"], function(key, value) {
                if(value["types"] == "postal_code") {
                  $("#success-notice").html("Your postal code is: " + value["long_name"]);
                  zipLocated = "true";
                }
            });
          } else {
            alert("Data not ok");
            $("#error-notice").html("There was a problem getting results.  Try again later.");
          } 
        },
        complete: function (xhr, status) {
          if(!zipLocated) {
            $("#error-notice").html("Not enough information, please enter more of the address.");
          }
        }
      });   
    });

  </script>
</body>
</html>