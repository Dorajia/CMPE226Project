<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: account.php");
  exit;
 }
 // select loggedin users detail
$userId = $_SESSION['user'];
 $query=mysql_query("SELECT * FROM registered_user, user_address WHERE registered_user.user_ID=user_address.user_ID and registered_user.user_ID='$userId'");
  if (!$query) { // add this check.
    die('Invalid query: ' . mysql_error());
  }
 $userRow=mysql_fetch_array($query);
 if($userRow==null)
 {
      $query=mysql_query("SELECT * FROM registered_user WHERE user_ID=".$_SESSION['user']);
   if (!$query) { // add this check.
     die('Invalid query: ' . mysql_error());
   }
 $userRow=mysql_fetch_array($query);
 }




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../favicon.ico">

  <title>Navbar Template for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="navbar.css" rel="stylesheet">

  <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
  <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style type="text/css">
  body { background-image: url("table.jpg");
          background-size:cover  }
</style>
<body>

<div class="container">

  <!-- Static navbar -->
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">CMPE226-SuperDB</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <li><a href="account.php">Profile</a></li>
          <li><a href="OwnGroups.php">Group</a></li>
          <li><a href="OwnEvents.php">Event</a></li>
          <li><a href="purse.php">Purse</a></li>
          <li><a href="Payment.php">Payment History</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Settings <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="logout.php?logout">Log Out</a></li>
              <!--              <li><a href="#">Create Group</a></li>-->
              <!--              <li><a href="#">Find Groups</a></li>-->
              <!--              <li role="separator" class="divider"></li>-->
              <!--              <!--<li class="dropdown-header">Nav header</li>-->
              <!--              <li><a href="#">Create Event</a></li>-->
              <li><a href="searchEvent.php">Find Events</a></li>
              <li><a href="searchLocation.php">Add Events</a></li>
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </nav>

  <div class="panel panel-default">
        <div class="panel-body">
          <h4>Personal Information<span class = "pull-right"><button type="button" class="btn btn-default"><a href = "home.php">Update Profile</a></button></span></h4>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <table class="table">
    <tbody>
    <tr>
      <th scope="row">First Name</th>
      <td><?php echo $userRow['first_name']?></td>
    </tr>
    <tr>
      <th scope="row">Last Name</th>
      <td><?php echo $userRow['last_name']?></td>
    </tr>
    <tr>
      <th scope="row">Date of Birth</th>
      <td><?php echo $userRow['date_of_birth']?></td>
    </tr>
    <tr>
      <th scope="row">Email</th>
      <td><?php echo $userRow['email_address']?></td>
    </tr>
    <tr>
      <th scope="row">Password</th>
      <td><?php echo $userRow['password']?></td>
    </tr>
    <tr>
      <th scope="row">Phone</th>
      <td><?php echo $userRow['phone_number']?></td>
    </tr>

    <tr>
      <th scope="row">Address 1</th>
      <td><?php echo $userRow['address1']?></td>
    </tr>

    <tr>
      <th scope="row">Address 2</th>
      <td><?php echo $userRow['address2']?></td>
    </tr>

    <tr>
      <th scope="row">City</th>
      <td><?php echo $userRow['city']?></td>
    </tr>

    <tr>
      <th scope="row">State</th>
      <td><?php echo $userRow['state']?></td>
    </tr>

    <tr>
      <th scope="row">Zip</th>
      <td><?php echo $userRow['zip_code']?></td>
    </tr>
    </tbody>
  </table>
          </form>

        </div>

  </div>
<!--  <a href="home.php">home</a>-->

</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>

