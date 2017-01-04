<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
  header("Location: account.php");
  exit;
}

$userId = $_SESSION['user'];
$event_id = $_GET['id'];
//$_SESSION['event_id'] = $event_id;
//echo $_SESSION['event_id'];
$query=mysql_query("select r.event_ID, r.start_time, r.end_time, r.capacity, r.need_request,r.event_fee, r.rent_fee,r.introduction, r.status,l.location_name, l.address1,l.city,l.state,l.zip_code,t.type_name
								   from registered_event r, event_location l, event_type t
								   where event_ID = '$event_id' and l.location_ID = r.location and r.type = t.type_ID;");
if (!$query) { // add this check.
  die('Invalid query: ' . mysql_error());
}
//$userRow=mysql_fetch_array($query);

//$query=mysql_query( "insert into event_attendee(user,event_ID)
//                             values('$userId','$event_id')") or die(mysql_error());
//
$userRow=mysql_fetch_array($query);


 if ( isset($_POST['btn-update']) )  {
// clean user inputs to prevent sql injections
//   echo "!!!user id is !!!";
//   echo $_SESSION['event_id'];
//   echo "!!!user id is !!!".$_SESSION['event_id'];
   $eventID = trim($_POST['eventID']);
   $eventID = strip_tags($eventID);
   $eventID = htmlspecialchars($eventID);

  $capacity = trim($_POST['capacity']);
  $capacity = strip_tags($capacity);
  $capacity = htmlspecialchars($capacity);

  $fee = trim($_POST['fee']);
  $fee = strip_tags($fee);
  $fee = htmlspecialchars($fee);

  $intro = trim($_POST['intro']);
  $intro = strip_tags($intro);
  $intro = htmlspecialchars($intro);

  $rent = trim($_POST['rent']);
  $rent = strip_tags($rent);
  $rent = htmlspecialchars($rent);

  $request = trim($_POST['request']);
  $request = strip_tags($request);
  $request = htmlspecialchars($request);

  $status = trim($_POST['status']);
  $status = strip_tags($status);
  $status = htmlspecialchars($status);

  $query = "update registered_event 
    set event_fee = '$fee',
        capacity = '$capacity',
        introduction = '$intro',
        need_request = '$request',
        status = '$status'
    where event_ID = '$eventID'";

  $query2 = "update registered_event 
    set event_fee = '123'
    where event_ID = '$eventID'";

  $res = mysql_query($query);

  if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully updated";
//    echo $query;
    header('Location: OwnEvents.php');

  } else {

    $errTyp = "danger";
    $errMSG = "Something went wrong, try again";
  }

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
<!--<style type="text/css">-->
<!--  body { background-image: url("table.jpg");-->
<!--    background-size:cover  }-->
<!--</style>-->
<body>
<div class="container">
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

  <!--    <h1>Query Results</h1>-->
<!--    <div class="panel panel-default">-->
<!--        <!--        <div class="panel-heading">Panel heading without title</div>-->
<!--        <div class="panel-body">-->
<!--            <table class="table table-striped">-->
<!--                <tbody>-->
<!--                --><?php
//
//                try {
//                    // Connect to the database.
//                  $con = new PDO("mysql:host=localhost;dbname=eventgo","root", "phpMyAdmin");
//
//
//                    $con->setAttribute(PDO::ATTR_ERRMODE,
//                        PDO::ERRMODE_EXCEPTION);
//                        $event_fee = filter_input(INPUT_GET, "event_fee");
//                        $event_id = filter_input(INPUT_GET, "event_id");
//
//                        $query = " update registered_event set event_fee = $event_fee where event_ID = $event_id;";
//
//
//						$con->exec($query);
//						echo "The event has been modified successfully";
//
//
//                }
//                catch(PDOException $ex) {
//                    echo 'ERROR: '.$ex->getMessage();
//                }
//                ?>
<!--                </tbody>-->
<!--            </table>-->
<!--        </div>-->
<!--    </div>-->

  <div class="panel panel-default">
    <div class="panel-body">
      <h4>Event Information</h4>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

        <table class="table">
          <tbody>
          <tr>
            <th scope="row">Event ID</th>
            <td><input type="hidden" name="eventID" value="<?php echo $userRow['event_ID']?>"><?php echo $userRow['event_ID']?></td>
          </tr>
          <tr>
            <th scope="row">Start Time</th>
            <td><?php echo $userRow['start_time']?></td>
          </tr>
          <tr>
            <th scope="row">End Time</th>
            <td><?php echo $userRow['end_time']?></td>
          </tr>
          <tr>
            <th scope="row">Capacity</th>
            <td><input type="text" name="capacity" value="<?php echo $userRow['capacity']?>"></td>
          </tr>
          <tr>
            <th scope="row">Event Fee</th>
            <td><input type="text" name="fee" value="<?php echo $userRow['event_fee']?>"></td>
          </tr>
          <tr>
            <th scope="row">Need Request</th>
            <td><input type="text" name="request" value="<?php echo $userRow['need_request']?>"</td>
          </tr>

          <tr>
            <th scope="row">Introduction</th>
            <td><input type="text" name="intro" value="<?php echo $userRow['introduction']?>"></td>
          </tr>

          <tr>
            <th scope="row">Rent Fee</th>
            <td><<?php echo $userRow['rent_fee']?>></td>
          </tr>

          <tr>
            <th scope="row">Location Name</th>
            <td><?php echo $userRow['location_name']?></td>
          </tr>

          <tr>
            <th scope="row">Address</th>
            <td><?php echo $userRow['address1']?></td>
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
            <th scope="row">Zip Code</th>
            <td><?php echo $userRow['zip_code']?></td>
          </tr>

          <tr>
            <th scope="row">Event Type</th>
            <td><?php echo $userRow['type_name']?></td>
          </tr>

          <tr>
            <th scope="row">Status</th>
            <td><input type="text" name="status" value="<?php echo $userRow['status']?>"></td>
          </tr>
          </tbody>
        </table>

        <div >
<!--          <span class = "pull-right">-->
<!--            <button type="submit" name="btn-update" class="btn btn-default"><a href="OwnEvents.php">update</a></button>-->
                <a href="OwnEvents.php"><button type="submit" name="btn-update">update</button> </a>
<!--          </span>-->
          <!--          <a href="account.php"><button type="submit" name="btn-update">update</button> </a>-->

        </div>
        <div><?php echo $errMSG ?></div>

      </form>
    </div>
  </div>

</div>

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
