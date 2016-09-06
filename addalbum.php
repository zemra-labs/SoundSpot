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
    $album_name = $album_year = $album_genre = $album_artist = FALSE;
        
    // Check for a password and match against the confirmed password:


      if (!empty($_POST['album_name'])) {
        $album_name = mysqli_real_escape_string ($dbc, $trimmed['album_name']);
    } else {
        echo '<p class="error">Please enter an album name!</p>';
    }

      if (!empty($_POST['album_genre'])) {
        $album_genre = mysqli_real_escape_string ($dbc, $trimmed['album_genre']);
    } else {
        echo '<p class="error">Please enter an album genre!</p>';
    }

      if (!empty($_POST['album_year'])) {
        $album_year = mysqli_real_escape_string ($dbc, $trimmed['album_year']);
    } else {
        echo '<p class="error">Please enter an album year!</p>';
    }
     if (!empty($_POST['album_artist'])) {
        $album_artist = mysqli_real_escape_string ($dbc, $trimmed['album_artist']);
    } else {
        echo '<p class="error">Please enter an album artist!</p>';
    }

    if ($album_name && $album_artist && $album_genre && $album_year) {

            // Add the user to the database
            
            $query2 = "SELECT artist_id from artist where artist_name='$album_artist'";
            $result2 = mysqli_query ($dbc, $query2) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($dbc));
            if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result2)) {
                echo "id: " . $row["artist_id"]. "<br>";
                $artist_id = $row['artist_id'];
             }
            } else {
                echo "0 results";
            }

            $query = "INSERT INTO album ( album_name, album_year, album_genre, artist_id) VALUES ('$album_name', '$album_year', '$album_genre', '$artist_id')";
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
      
          <form class="" name="login" action="addalbum.php" method="post">
            <h3>Add an album for SoundSpot</h3>
                <input type="text" class="form-control" name="album_name" id="album_name" required placeholder="Album Name">
                <br>
                <input type="date" class="form-control" name="album_year" id="album_year" required placeholder="Album Year">
                <br>
                <input type="text" class="form-control" name="album_genre" id="album_genre" required placeholder="Album Genre">
                <br>
                 <input type="text" class="form-control" name="album_artist" id="album_artist" required placeholder="Album Artist">
                <br>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i>Add Album</button>
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
