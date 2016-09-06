<?php  // Handle the form.

    // Need the database connection:

    require('conn2.php');
           $query2 = "SELECT * from artist";
            $result2 = mysqli_query ($dbc, $query2) or trigger_error("Query: $query2\n<br />MySQL Error: " . mysqli_error($dbc));



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SoundSpot</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SoundSpot</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="album.php">Albums</a>
                    </li>
                    <li>
                        <a href="song.php">Songs</a>
                    </li>
                    <li>
                        <a href="artist.php">Artists</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Header -->
    <div class="intro-header">

        <div class="container">

            <div class="row">
                <div class="herecol-lg-12">
                    <div class="here intro-message">
                        <h3 class="">List of Artists</h3>
                        <hr class="intro-divider">
                 <?php
                        echo '<table class="table table-striped table-bordered table-hover">'; 
                        echo"<TR><TD>Artist ID</TD><TD>Artist Name</TD><TD>Artist DOB</TD></TR>"; 
                        while($row = mysqli_fetch_assoc($result2)){
                        echo "<tr><td>"; 
                        echo $row['artist_id'];
                        echo "</td><td>";   
                        echo $row['artist_name'];
                        echo "</td><td>";    
                        echo $row['artist_dob'];
                            
                        }
                        echo "</TD></tr>";  
                        echo "</table>";

                        ?>     
                        <ul class="list-inline intro-social-buttons">
                            
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container -->

    </div>
    <!-- /.intro-header -->

    <!-- Page Content -->


    <div class="content-section-a">

        <div class="container">

            <div class="row">
                <div class="col-lg-5 col-sm-6">
                    <hr class="section-heading-spacer">
                    <div class="clearfix"></div>
                    <h2 class="section-heading">SoundSpot</h2>
                    <p class="lead">SoundSpot is an online music store that sells your favorite album at reduced prices. Register now and get it here first!</p>
                </div>
            
            </div>

        </div>
        <!-- /.container -->

    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="album.php">Albums</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="song.php">Songs</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="artist.php">Artists</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; SoundSpot 2014. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
