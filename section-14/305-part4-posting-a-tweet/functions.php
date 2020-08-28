<?php
	session_start();

	include("../../database-credentials.php");

	$link = mysqli_connect(DATABASE_PATH, DATABASE_USER, DATABASE_PASSWORD, DATABASE_NAME);
        
  if (mysqli_connect_error()) {
    echo print_r("Database Connection Error");
    exit();
  }

  if(array_key_exists('function', $_GET) && $_GET['function'] == "logout") {
  	session_unset();
  }

  function convertToTimeAgo($time) {   
    $timeString = "";
    $timeAgo = (time() - strtotime($time));

    $minutes = 60;
    $hours = 60 * 60;
    $days = 60 * 60 * 24;
    $months = 60 * 60 * 24 * 30;
    $years = 60 * 60 * 24 * 30 * 12;

    if ($timeAgo < $minutes) {
      $timeString = $timeAgo . " seconds ago.";
    } elseif ($timeAgo < $hours) {
      $timeString = (($timeAgo - ($timeAgo % $minutes)) / $minutes)." minutes ago.";
    } elseif ($timeAgo < $days) {     
      $timeString = (($timeAgo - ($timeAgo % $hours)) / $hours)." hours ago.";
    } elseif ($timeAgo < $months) {
      $timeString = (($timeAgo - ($timeAgo % $days)) / $days)." days ago.";
    } elseif ($timeAgo < $years) {
      $timeString = (($timeAgo - ($timeAgo % $months)) / $months)." months ago.";
    } else {
      $timeString = (($timeAgo - ($timeAgo % $years)) / $years)." years ago.";
    }

    return $timeString;
  }


  function displayTweets($visibility) {
    global $link;

    if ($visibility == 'public') {
      $whereClause = "";
    } else if ($visibility == 'isFollowing') {

      $query = "SELECT * FROM isfollowing WHERE follower = ".mysqli_real_escape_string($link, $_SESSION['id']);
      $result = mysqli_query($link, $query);

      $whereClause = "";

      while ($row = mysqli_fetch_assoc($result)) {
        if ($whereClause == "") $whereClause = "WHERE";
        else $whereClause.= " OR";

        $whereClause .= " userid = ".$row['isFollowing'];
      }
    } else if ($visibility == "yourtweets") {
      $whereClause = "WHERE userid = ".mysqli_real_escape_string($link, $_SESSION['id']);
    }

    $query = "SELECT * FROM tweets $whereClause ORDER BY tweets.datetime DESC LIMIT 10";
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) == 0) {
      echo "There are no tweets to display.";
    } else {
      while($row = mysqli_fetch_assoc($result)) {
        $userQuery = "SELECT * FROM users WHERE id = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
        $userResult = mysqli_query($link, $userQuery);
        $user = mysqli_fetch_assoc($userResult);

        echo "<div class='tweet'><p>".$user['email']."   <span class='time'>".convertToTimeAgo($row['datetime'])."</span></p>";
        echo "<p>".$row['tweet']."</p>";

        if (array_key_exists('id', $_SESSION)) {
          echo '<p><button type="button" class="btn bg-transparent follow-button" data-userId="'.$row['userid'].'">';

          $isFollowingQuery = "SELECT * FROM isFollowing WHERE follower = ".mysqli_real_escape_string($link, $_SESSION['id'])." AND isFollowing = ".mysqli_real_escape_string($link, $row['userid'])." LIMIT 1";
          $isFollowingResult = mysqli_query($link, $isFollowingQuery);
          
          if (mysqli_num_rows($isFollowingResult) > 0) {
            echo 'Unfollow';
          } else {
            echo 'Follow';
          }

          echo '</button></p>';
        }

        echo '</div>';
      }
    }
  }

  function displaySearch() {
    echo '<form class="form-inline"><div class="form-group"><input class="form-control" type="search" placeholder="Search" aria-label="Search"> <button class="btn btn-outline-success" id="search-button" type="button">Search</button></div></form>';
  }

  function displayTweeterBox() {
    if (array_key_exists('id', $_SESSION) && $_SESSION['id'] > 0) {
      echo '<div class="tweeter-div"><p>Post a Tweeter</p><div id="tweeter-success" class="alert alert-success">Your tweeter was tweetered successfully.</div><div id="tweeter-error" class="alert alert-danger"></div><form class="form"><textarea class="form-control" id="tweeter-post" rows="3"></textarea><button class="btn btn-outline-success" type="button" id="tweeter-button">Tweeter-ing</button></form></div>';
    }
  }
?>