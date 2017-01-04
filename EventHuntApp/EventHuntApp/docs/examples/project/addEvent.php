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
$location_id = $_GET['location_id'];

$query=mysql_query("select l.location_ID,l.location_name, l.address1,l.city,l.state,l.zip_code,l.rent_fee_per_hour
								   from event_location l
								   where l.location_ID = '$location_id';");

if (!$query) { // add this check.
  die('Invalid query: ' . mysql_error());
}

$userRow=mysql_fetch_array($query);


 if ( isset($_POST['btn-update']) )  {

  $capacity = trim($_POST['capacity']);
  $capacity = strip_tags($capacity);
  $capacity = htmlspecialchars($capacity);


  $fee = trim($_POST['fee']);
  $fee = strip_tags($fee);
  $fee = htmlspecialchars($fee);

  $intro = trim($_POST['intro']);
  $intro = strip_tags($intro);
  $intro = htmlspecialchars($intro);


  $request = trim($_POST['request']);
  $request = strip_tags($request);
  $request = htmlspecialchars($request);

  $status = trim($_POST['status']);
  $status = strip_tags($status);
  $status = htmlspecialchars($status);
  
  $location_id = trim($_POST['locationid']);
  $location_id = strip_tags($location_id);
  $location_id = htmlspecialchars($location_id);
  
  $type = trim($_POST['type']);
  $type = strip_tags($type);
  $type = htmlspecialchars($type);


  $time = trim($_POST['time']);
  $time = strip_tags($time);
  $time = htmlspecialchars($time);
  $timearray = explode('-', $time);


  $rent_fee = trim($_POST['rent_fee']);
  $rent_fee = strip_tags($rent_fee);
  $rent_fee = htmlspecialchars($rent_fee);
  
  $start_time = strtotime($timearray[0]);
  $end_time = strtotime($timearray[1]);

$start_timeformat = date("Y/m/d h:i:s", $start_time);
$end_timeformat = date("Y/m/d h:i:s",$end_time);

$interval = $end_time - $start_time;

$rent  = $interval/60/60 * $rent_fee; 

$querytype = "select type_ID from event_type where type_name = '$type';";

$typeresult=mysql_query($querytype);

if (!$typeresult) { // add this check.
  die('Invalid query: ' . mysql_error());
}else{
  $typeRow=mysql_fetch_array($typeresult);
  $type_id = $typeRow['type_ID'];
}



$query = "insert into registered_event 
   (start_time,end_time,capacity,event_fee,need_request,introduction,rent_fee,organizer,location,type,status) values ('$start_timeformat','$end_timeformat','$capacity','$fee','$request','$intro','$rent','$userId','$location_id','$type_id','Active')";

$querybalance = "update purse set balance = balance-$rent where user = '$userId';";
  
  $res = mysql_query($query);
   $res2 = mysql_query($querybalance);

  if ($res && $res2) {
    $errTyp = "success";
    $errMSG = "Successfully updated";
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
            <th scope="row">Time</th>
            <td>
                <input type="text" name="time" value="12/10/2016 1:30 PM - 12/10/2016 2:00 PM" />
 
            </td>
          </tr>
          <tr>
            <th scope="row">Capacity</th>
            <td><input type="text" name="capacity"></td>
          </tr>
          <tr>
            <th scope="row">Event Fee</th>
            <td><input type="text" name="fee" ></td>
          </tr>
          <tr>
            <th scope="row">Need Request</th>
            <td>
                <select name="request" class="form-control" maxlength="20" >
                <option value="">select</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
                </select>
            </td>
          </tr>

          <tr>
            <th scope="row">Introduction</th>
            <td><input type="text" name="intro" ></td>
          </tr>

          <tr>
            <th scope="row">Location ID</th>
            <td><input type="hidden" name="locationid" value="<?php echo $userRow['location_ID']?>"><?php echo $userRow['location_ID']?></td>
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
            <th scope="row">Rent Fee Per Hour</th>
            <td><input type="hidden" name="rent_fee" value="<?php echo $userRow['rent_fee_per_hour']?>"><?php echo $userRow['rent_fee_per_hour']?></td>
          </tr>
          
          <tr>
            <th scope="row">Zip Code</th>
            <td><?php echo $userRow['zip_code']?></td>
          </tr>

          <tr>
            <th scope="row">Event Type</th>
            <td>
                <select name="type" class="form-control" maxlength="20" >
                <option value="">select</option>
                <option value="Erotic events">Erotic events</option>
                <option value="Reunions">Reunions</option>
                <option value="Conferences">Conferences</option>
                <option value="Golf Tournament">Golf Tournament</option>
                <option value="Ceremonies">Ceremonies</option>
                <option value="Clothing-free event">Clothing-free event</option>
                <option value="Art or Museum Gathering">Art or Museum Gathering</option>
                <option value="Feminist events">Feminist events</option>
                <option value="Outdoor">Outdoor</option>
                <option value="Fashion Show">Fashion Show</option>
                <option value="Party">Party</option>
                <option value="Anniversary Celebration">Anniversary Celebration</option>
                <option value="Exhibitions">Exhibitions</option>
                <option value="Wine-tasting and Pairing Meals"> Wine-tasting and Pairing Meals</option>
                <option value="Exhibitions">Exhibitions</option>
                <option value="Debates">Debates</option>
                <option value="Tech ¡®n Show">Tech ¡®n Show</option>
                <option value="Competition">Competition</option>
                <option value="Weddings">Weddings</option>
                <option value="Trade Shows">Trade Shows</option>
                <option value="Cocktail Parties">Cocktail Parties</option>
                <option value="Balls (dance party)">Balls (dance party)</option>
                </select>
            </td>
          </tr>
          </tbody>
        </table>

        <div >
<!--          <span class = "pull-right">-->
<!--            <button type="submit" name="btn-update" class="btn btn-default"><a href="OwnEvents.php">update</a></button>-->
                <a href="OwnEvents.php"><button type="submit" name="btn-update">Add Event</button> </a>
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
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<script type="text/javascript">
$(function() {
    $('input[name="time"]').daterangepicker({
        timePicker: true,
        timePicker24Hour: true,
        timePickerIncrement: 30,
        locale: {
            format: 'MM/DD/YYYY h:mm:ss'
        }
    });
});
</script>
</body>
</html>