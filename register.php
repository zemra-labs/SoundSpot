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
    $fname = $lname = $email = $password = $username = FALSE;
        
    // Check for a password and match against the confirmed password:
    if (preg_match ('/^\w{2,20}$/', $trimmed['password']) ) {
            $password = mysqli_real_escape_string ($dbc, $trimmed['password']);
    } else {
        echo '<p class="error">Please enter a valid password!</p>';
    }
    // Check for first name:
    if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['fname'])) {
        $fname = mysqli_real_escape_string ($dbc, $trimmed['fname']);
    } else {
        echo '<p class="error">Please enter your first name!</p>';
    }

      if (!empty($_POST['username'])) {
        $username = mysqli_real_escape_string ($dbc, $trimmed['username']);
    } else {
        echo '<p class="error">Please enter a username!</p>';
    }
    // Check for a last name:
    if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['lname'])) {
        $lname = mysqli_real_escape_string ($dbc, $trimmed['lname']);
    } else {
        echo '<p class="error">Please enter your last name!</p>';
    }
    
    // Check for an email address:
        if (!empty($_POST['email'])) {
        $email = mysqli_real_escape_string ($dbc, $trimmed['email']);
    } else {
        echo '<p class="error">Please enter a valid email address!</p>';
    }

  // Check for address 1:
   if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['address_1'])) {
        $address_1 = mysqli_real_escape_string ($dbc, $trimmed['address_1']);
    } else {
        echo '<p class="error">Please enter a valid address line 1!</p>';
    }
     // Check for address 1:
   if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['address_2'])) {
        $address_2 = mysqli_real_escape_string ($dbc, $trimmed['address_2']);
    } else {
        echo '<p class="error">Please enter a valid address line 2!</p>';
    }
        // Check for city:
   if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['city_name'])) {
        $city = mysqli_real_escape_string ($dbc, $trimmed['city_name']);
    } else {
        echo '<p class="error">Please enter a valid city!</p>';
    }
        // Check for state:
    if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['state_code'])) {
        $state = mysqli_real_escape_string ($dbc, $trimmed['state_code']);
    } else {
        echo '<p class="error">Please enter a valid state!</p>';
    }
            // Check for address 1:
       if (!empty($_POST['password'])) {
        $phone = mysqli_real_escape_string ($dbc, $trimmed['phone']);
    } else {
        echo '<p class="error">Please enter a valid phone number!</p>';
    }
      if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['country'])) {
        $country = mysqli_real_escape_string ($dbc, $trimmed['country']);
    } else {
        echo '<p class="error">Please enter a valid country!</p>';
    }
        $password = md5($password);
        $password = sha1($password);
        $password = crypt($password,njit);
        //$sso = (int)$sso;
        
    
    if ($fname && $lname && $email && $password && $username) {

            // Add the user to the database:
            $query = "INSERT INTO address ( address_1, address_2, city_name, state_code, country) VALUES ('$address_1', '$address_2', '$city', '$state', '$country')";
            $result = mysqli_query ($dbc, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($dbc));
            
            $query2 = "SELECT address_id from address where address_1='$address_1'";
            $result2 = mysqli_query ($dbc, $query2) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($dbc));
            if (mysqli_num_rows($result2) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result2)) {
                echo "id: " . $row["address_id"]. "<br>";
                $address_id = $row['address_id'];
             }
            } else {
                echo "0 results";
            }

            $query3 = "INSERT INTO customer (customer_lname, customer_fname, customer_email, customer_phone, address_id) VALUES ('$lname', '$fname', '$email', '$phone', '$address_id')";
            $result3 = mysqli_query ($dbc, $query3) or trigger_error("Query: $query2\n<br />MySQL Error: " . mysqli_error($dbc));


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
      
          <form class="" name="login" action="register.php" method="post">
            <h3>Register for SoundSpot</h3>
                <input type="text" class="form-control" name="username" id="username"placeholder="Enter Your Username" required autofocus autocomplete="off">
                <br>
                <input type="password" class="form-control" name="password" id="password" required placeholder="Enter Your Password">
                <br>
                <input type="text" class="form-control" name="fname" id="fname" required placeholder="Enter First Name">
                <br>
                <input type="text" class="form-control" name="lname" id="lname" required placeholder="Enter Last Name">
                <br>
                <input type="email" class="form-control" name="email" id="email" required placeholder="Enter Your Email">
                <br>
                <input type="text" class="form-control" name="phone" id="phone" required placeholder="Enter Phone Number">
                <br>
                <input type="text" class="form-control" name="address_1" id="address_1" required placeholder="Address Line 1">
                <br>
                 <input type="text" class="form-control" name="address_2" id="address_2" required placeholder="Address Line 2">
                <br>
                <input type="text" class="form-control" name="city_name" id="city_name" required placeholder="City">
                <br>
                <input type="text" class="form-control" name="state_code" id="state_code" maxlength=2 required placeholder="State">
                <br>
                <input type="text" class="form-control" name="country" id="country" maxlength=3 required placeholder="Country">
                <br>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> Register</button>
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
