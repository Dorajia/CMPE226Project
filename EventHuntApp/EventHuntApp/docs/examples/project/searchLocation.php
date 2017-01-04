
<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// if session is not set this will redirect to login page
if( !isset($_SESSION['user']) ) {
  header("Location: account.php");
  exit;
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

  <!-- Main component for a primary marketing message or call to action -->

  <div class="panel panel-default">
    <div class="panel-body">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Search Event Location</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-right" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
              <select name="state" class="form-control">
                <option value="Alabama">Alabama</option>
                <option value="Alaska">Alaska</option>
                <option value="Arizona">Arizona</option>
                <option value="Arkansas">Arkansas</option>
                <option value="California">California</option>
                <option value="Colorado">Colorado</option>
                <option value="Connecticut">Connecticut</option>
                <option value="Delaware">Delaware</option>
                <option value="District Of Columbia">District Of Columbia</option>
                <option value="Florida">Florida</option>
                <option value="Georgia">Georgia</option>
                <option value="Hawaii">Hawaii</option>
                <option value="Idaho">Idaho</option>
                <option value="Illinois">Illinois</option>
                <option value="Indiana">Indiana</option>
                <option value="Iowa">Iowa</option>
                <option value="Kansas">Kansas</option>
                <option value="Kentucky">Kentucky</option>
                <option value="Louisiana">Louisiana</option>
                <option value="Maine">Maine</option>
                <option value="Maryland">Maryland</option>
                <option value="Massachusetts">Massachusetts</option>
                <option value="Michigan">Michigan</option>
                <option value="Minnesota">Minnesota</option>
                <option value="Mississippi">Mississippi</option>
                <option value="Missouri">Missouri</option>
                <option value="Montana">Montana</option>
                <option value="Nebraska">Nebraska</option>
                <option value="Nevada">Nevada</option>
                <option value="NewHampshire">New Hampshire</option>
                <option value="NewJersey">New Jersey</option>
                <option value="NewMexico">New Mexico</option>
                <option value="NewYork">New York</option>
                <option value="NorthCarolina">North Carolina</option>
                <option value="NorthDakota">North Dakota</option>
                <option value="Ohio">Ohio</option>
                <option value="Oklahoma">Oklahoma</option>
                <option value="Oregon">Oregon</option>
                <option value="Pennsylvania">Pennsylvania</option>
                <option value="RhodeIsland">Rhode Island</option>
                <option value="SouthCarolina">South Carolina</option>
                <option value="SouthDakota">South Dakota</option>
                <option value="Tennessee">Tennessee</option>
                <option value="Texas">Texas</option>
                <option value="Utah">Utah</option>
                <option value="Vermont">Vermont</option>
                <option value="Virginia">Virginia</option>
                <option value="Washington">Washington</option>
                <option value="WestVirginia">West Virginia</option>
                <option value="Wisconsin">Wisconsin</option>
                <option value="Wyoming">Wyoming</option>
              </select>
              <input name="city" type="text" class="form-control" placeholder="City">
              <input name="minimum" type="text" class="form-control" placeholder="Min Rent Fee"> TO
              <input name="maximum" type="text" class="form-control" placeholder="MAX Rent Fee">
              <button type="submit" name="btn_submit" class="btn btn-default">Search</button>
            </form>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>

    </div>
      <!--        <div class="panel-heading">Panel heading without title</div>-->
        <table class="table">
          <?php
          try {
            // Connect to the database.
            $con = new PDO("mysql:host=ec2-35-165-34-54.us-west-2.compute.amazonaws.com;dbname=eventgo","dora", "yuanyuan");


            $con->setAttribute(PDO::ATTR_ERRMODE,
              PDO::ERRMODE_EXCEPTION);

            $min=filter_input(INPUT_POST,"minimum");
            $max=filter_input(INPUT_POST,"maximum");
            $state=filter_input(INPUT_POST,"state");
            $city=filter_input(INPUT_POST,"city");

            if ( isset($_POST['btn_submit']) ) {

              $query="SELECT location_ID,location_name,address1,city,state,zip_code,rent_fee_per_hour, capacity,Open_hour FROM event_location WHERE state='$state' AND city='$city' HAVING rent_fee_per_hour<'$max' and rent_fee_per_hour>'$min'";
              $data=$con->query($query);
              $data->setFetchMode(PDO::FETCH_ASSOC);
              $rowNum = 1;
              $doHeader = true;
              $doBody = true;
              foreach ($data as $row) {

                // The header row before the first data row.
                if ($doHeader) {
                  print "<thead>";
                  print "<tr>";
                  print "<th>#</th>";
                  print "<th>Location Name</th>";
                  print "<th>Address</th>";
                  print "<th>City</th>";
                  print "<th>State</th>";
                  print "<th>City</th>";
                  print "<th>RentFee/h</th>";
                  print "<th>Capacity</th>";
                  print "<th>Open_hour</th>";
                  print "<th></th>";
                  print "<tr>";
                  print "</thead>";
                  $doHeader = false;
                }
                if($doBody){
                  print "<tbody>";
                  $doBody = false;
                }
                // Data row.
                print "            <tr>\n";
                print '<th scope="row">';
                print $rowNum;
                $rowNum ++;
                print "</th>";
                $count = 0;
                $status = "";
                $event_id = "";
                foreach ($row as $name => $value) {
                  if($count < 9 && $count > 0){
                    print "                <td>$value</td>\n";
                  }else if($count == 0){
                    $location_id = $value;
                  }
                  $count ++;
                }
                  print "<td><button type=\"button\" class=\"btn btn-default\"><a href='addEvent.php?location_id=$location_id'>Choose</a></button></td>";
                
              }
              print "    </table>\n";
            }
          }catch(PDOException $ex) {
            echo 'ERROR: '.$ex->getMessage();
          }
          ?>
          </tbody>
        </table>
  </div>
  </div>


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
