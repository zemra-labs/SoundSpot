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
    $name = $dob = FALSE;
        
    // Check for a password and match against the confirmed password:


      if (!empty($_POST['name'])) {
        $name = mysqli_real_escape_string ($dbc, $trimmed['name']);
    } else {
        echo '<p class="error">Please enter a name!</p>';
    }

    // Check for an email address:
        if (!empty($_POST['dob'])) {
        $dob = mysqli_real_escape_string ($dbc, $trimmed['dob']);
    } else {
        echo '<p class="error">Please enter a valid Date of Birth!</p>';
    }

    
    if($name && $dob) {

            // Add the user to the database:
            $query = "INSERT INTO artist (artist_name, artist_dob) VALUES ('$name', '$dob')";
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
      
          <form class="" name="login" action="addartist.php" method="post">
            <h3>Add an artist for SoundSpot</h3>
                <input type="text" class="form-control" name="name" id="name" placeholder="Artist Name" required autofocus autocomplete="off">
                <br>
                <input type="date" class="form-control" name="dob" id="dob" required placeholder="Artist Date of Birth">
                <br>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> Add Artist</button>
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
