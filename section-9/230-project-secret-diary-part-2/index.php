<?php
  include 'postKeyAccept.php';

  session_start();

  if(array_key_exists('secretDiary',$_COOKIE) && $_COOKIE['secretDiary']
      || array_key_exists('secretDiary',$_SESSION) && $_SESSION['secretDiary']){
    header("Location: diary.php");
  }

  $error = "";

  if(array_key_exists('submit',$_POST)) {

    // Verify that email address and password ahve been submitted
    if(!postKeyAccept('email')) {
      $error .= "<p>Email address is required<p>";
    }
    if(!postKeyAccept('password')) {
      $error .= "<p>Password field is required<p>";
    }

    if($error != "") {
      $error = "<p>There were problems with your form submission:</p>".$error;
    } else {
      $link = mysqli_connect("","","","");

      if(mysqli_connect_error()) {
        die('Connection unsuccessful.');
      } 

      if(postKeyAccept('login') == 'true') {
        if($_POST['login'] == 'true') {
          $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";

          $result = mysqli_query($link, $query);

          // If there are query results, the email address exists
          if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);

            if(password_verify($_POST['password'], $row['password'])) {
              // If the login is successful, and the user wants to be remembered, create a cookie
              if(array_key_exists('remember', $_POST)) {
                setcookie("secretDiary", '"'.$_POST['email'].'"', time() + 60 * 60 * 24);
              }
              $_SESSION['secretDiary'] = $_POST['email'];
              header("Location: diary.php");
            } else {
              // Else - there was a problem with the password, alert to error
              $error .= "<p>Invalid email address or password, please try again.</p>";
            }
          // Else no email address found
          } else {
            $error .= "<p>Invalid email address or password, please try again.</p>";
          }
        } else {

          $query = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
          $result = mysqli_query($link, $query);

          if(mysqli_num_rows($result) == 0) {

            $query = "INSERT INTO users (email, password) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".password_hash($_POST['password'], PASSWORD_DEFAULT)."');";

            if(mysqli_query($link, $query)) {
              // If the login is successful, and the user wants to be remembered, create a cookie
              if(array_key_exists('remember', $_POST)) {
                setcookie("secretDiary", '"'.$_POST['email'].'"', time() + 60 * 60 * 24);
              }
              $_SESSION['secretDiary'] = $_POST['email'];
              header("Location: diary.php");
            } else {
              $error .= 'A problem occurred creating the account.  Please try again later.';
            }
          } else {
            $error .= 'Email address is already taken.';     
          }
        }
      } else {
        $error .= "<p>An error occurred. Please try again later.</p>";
      }
    }
  }
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <!-- jQuery CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <title>mySQL - Secret Diary Project - Part 2</title>

  <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="body.css">
</head>
<body>
  <div class="text-center" id="outer-container">
    <h1 class="contrast-text">Secret Diary</h1>
    <b class="contrast-text">Store your thoughts permanently and securely.</b>
    <div class="form-group alert-danger" id="error-alert"><?php echo $error ?> </div>
    <form id="login-form" method="post">
      <p class="contrast-text">Log into your account.</p>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email Address">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <div class="form-group text-center">
        <label for="rememberMe" class="contrast-text">Stay logged in:</label>
        <input type="checkbox" class="alighn-middle" name="rememberMe">
      </div>
      <div class="form-group">
        <input type="hidden" class="form-control" name="login" value="true">
        <input type="submit" class="btn-primary" name="submit" value="Login">
      </div>
    </form>
    <form id="register-form" method="post">
      <p class="contrast-text">Interested? Sign up now.</p>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email Address">
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password">
      </div>
      <div class="form-group text-center">
        <label for="rememberMe" class="contrast-text">Stay logged in:</label>
        <input type="checkbox" class="alighn-middle" name="rememberMe">
      </div>
      <div class="form-group">
        <input type="hidden" class="form-control" name="login" value="false">
        <input type="submit" class="btn-primary" name="submit" value="Register">
      </div>
    </form>
    <div>
      <button class="btn bg-transparent contrast-text" id="register-toggle">Register an account</button>
      <button class="btn bg-transparent contrast-text" id="login-toggle">Log into your account</button>
    </div>
  </div>

  <script type="text/javascript">
    function toggleForms() {
      $("#register-form").toggle();
      $("#login-form").toggle();
      $("#register-toggle").toggle();
      $("#login-toggle").toggle();
    }

    $("#login-form").hide();
    $("#register-toggle").hide();

    $("#register-toggle").click( toggleForms );
    $("#login-toggle").click( toggleForms );
  </script>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>