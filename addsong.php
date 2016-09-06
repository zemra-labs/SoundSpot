<?php
require('includes/config.inc.php');

ob_start();

// Initialize a session:
session_start();
?>

<?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

    // Need the database connection:
    require (MYSQL);
    
    // Trim all the incoming data:
    $trimmed = array_map('trim', $_POST);

    // Assume invalid values:
    $song_title = $song_year = $song_length = $album_name = FALSE;
        
    // Check for a password and match against the confirmed password:


      if (!empty($_POST['song_title'])) {
        $song_title = mysqli_real_escape_string ($dbc, $trimmed['song_title']);
    } else {
        echo '<p class="error">Please enter a song title!</p>';
    }

      if (!empty($_POST['song_year'])) {
        $song_year = mysqli_real_escape_string ($dbc, $trimmed['song_year']);
    } else {
        echo '<p class="error">Please enter a song year!</p>';
    }

      if (!empty($_POST['song_length'])) {
        $song_length = mysqli_real_escape_string ($dbc, $trimmed['song_length']);
    } else {
        echo '<p class="error">Please enter a song length!</p>';
    }
        if (!empty($_POST['album_name'])) {
        $album_name = mysqli_real_escape_string ($dbc, $trimmed['album_name']);
    } else {
        echo '<p class="error">Please enter an album name !</p>';
    }
 

    if ($song_title && $song_year && $song_length && $album_name) {

            // Add the user to the database
            
            $query2 = "SELECT album_id from album where album_name ='$album_name'";
            $result2 = mysqli_query ($dbc, $query2) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($dbc));
            if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result2)) {
                echo "id: " . $row["album_id"]. "<br>";
                $album_id = $row['album_id'];
             }
            } else {
                echo "0 results";
            }

            $query = "INSERT INTO songs ( song_title, song_year, song_length, album_id) VALUES ('$song_title', '$song_year', '$song_length', '$album_id')";
            $result = mysqli_query ($dbc, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($dbc));
            

            if (mysqli_affected_rows($dbc) > 0) { // If it ran OK.

                // Send the email:
             
                // Finish the page:
                header('Location: index.html');
                exit(); // Stop the page.
                
            } else { // If it did not run OK.
                
                echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
            }
        
    } else { // If one of the data tests failed.
        
        echo '<p class="error">Please try again.</p>';
    }

    mysqli_close($dbc);

}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Customer Registration</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
  </head>

  <body>

    <div id="login-page">
      <div class="container">
      
          <form class="" name="login" action="addsong.php" method="post">
            <h3>Add songs for SoundSpot</h3>
                <input type="text" class="form-control" name="song_title" id="song_title" required placeholder="Song Title">
                <br>
                <input type="date" class="form-control" name="song_year" id="song_year" required placeholder="Song Year">
                <br>
                <input type="text" class="form-control" name="song_length" id="song_length"  placeholder="Song Length">
                <br>
                 <input type="text" class="form-control" name="album_name" id="album_name" required placeholder="Album Name">
                <br>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i>Add Songs</button>
          </form>     
      </div>
    </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    
     <script type="text/javascript" src="js/jquery.backstretch.js"></script>
    <script>
        $.backstretch("img/music2.jpg", {speed: 500});
    </script>


  </body>
</html>
