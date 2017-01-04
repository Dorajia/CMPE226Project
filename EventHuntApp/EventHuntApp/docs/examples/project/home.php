
<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
$userId = $_SESSION['user'];
 
 $query=mysql_query("SELECT * FROM registered_user, user_address WHERE registered_user.user_ID=user_address.user_ID and registered_user.user_ID= '$userId'");
  if (!$query) { // add this check.
    die('Invalid query: ' . mysql_error());
  }
 
 $userRow=mysql_fetch_array($query);
 $result = "update";
 
 if($userRow==null)
 {
      $query=mysql_query("SELECT * FROM registered_user WHERE user_ID=".$_SESSION['user']);
      $userRow=mysql_fetch_array($query);
      $result = "insert";
 }

 if ( isset($_POST['btn-update']) ) {

// clean user inputs to prevent sql injections
  $bday = trim($_POST['bday']);
  $bday = strip_tags($bday);
  $bday = htmlspecialchars($bday);
  $time = strtotime($bday);
  $newformat = date('Y-m-d',$time);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);

  $phone = trim($_POST['phone']);
  $phone = strip_tags($phone);
  $phone = htmlspecialchars($phone);

  $address1 = trim($_POST['address1']);
  $address1 = strip_tags($address1);
  $address1 = htmlspecialchars($address1);
  
  $address2 = trim($_POST['address2']);
  $address2 = strip_tags($address2);
  $address2 = htmlspecialchars($address2);
  
  $city = trim($_POST['city']);
  $city = strip_tags($city);
  $city = htmlspecialchars($city);
  
  $state = trim($_POST['state']);
  $state = strip_tags($state);
  $state = htmlspecialchars($state);
  
  $zip = trim($_POST['zip']);
  $zip = strip_tags($zip);
  $zip = htmlspecialchars($zip);

   $query = "update registered_user t1
   set 
   t1.date_of_birth='$newformat',
   t1.phone_number='$phone',
   t1.password = '$pass'
   where user_ID='$userId'";
   
if($result == 'insert')
{
   $query2 = "insert into user_address (user_ID,address1,address2, city,state,zip_code) values ('$userId','$address1','$address2','$city','$state','$zip')";
}
else{
   $address_ID=$userRow['address_ID'];
   $query2 = "update user_address
   set 
   address1='$address1',
   address2='$address2',
   city = '$city',
   state = '$state',
   zip_code = '$zip'
   where address_ID='$address_ID'";
}
   $res = mysql_query($query);  
   $response = mysql_query($query2);
   //
   if ($res && $response) {
    $errTyp = "success";
    $errMSG = "Successfully updated";

     header('Location: account.php');

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

<body>
<style type="text/css">
  body { background-image: url("table.jpg");
    background-size:cover  }
</style>
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
      <h4>Personal Information</h4>
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
            <td><input type="text" name="bday" value="<?php echo $userRow['date_of_birth']?>"></td>
          </tr>
          <tr>
            <th scope="row">Email</th>
            <td><?php echo $userRow['email_address']?></td>
          </tr>
          <tr>
            <th scope="row">Password</th>
            <td><input type="text" name="pass" value="<?php echo $userRow['password']?>"></td>
          </tr>
          <tr>
            <th scope="row">Phone</th>
            <td><input type="text" name="phone" value="<?php echo $userRow['phone_number']?>"></td>
          </tr>

          <tr>
            <th scope="row">Address 1</th>
            <td><input type="text" name="address1" value="<?php echo $userRow['address1']?>"></td>
          </tr>

          <tr>
            <th scope="row">Address 2</th>
            <td><input type="text" name="address2" value="<?php echo $userRow['address2']?>"></td>
          </tr>

          <tr>
            <th scope="row">City</th>
            <td><input type="text" name="city" value="<?php echo $userRow['city']?>"></td>
          </tr>

          <tr>
            <th scope="row">State</th>
                <td> <select name="state" class="form-control">
                <option value="<?php echo $userRow['state']?>"><?php echo $userRow['state']?></option>
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
           <!--  <td><input type="text" name="state" value="<?php echo $userRow['state']?>">-->
           </td>
          </tr>

          <tr>
            <th scope="row">Zip</th>
            <td><input type="text" name="zip" value="<?php echo $userRow['zip_code']?>"></td>
          </tr>
          </tbody>
        </table>

        <div >
<!--          <span class = "pull-right"><button type="submit" name="btn-update" class="btn btn-default"><a href="account.php">update</a></button></span>-->
          <a href="account.php"><button type="submit" name="btn-update">update</button> </a>

        </div>
        <div><?php echo $errMSG ?></div>

      </form>
    </div>
</div>
<!--  <a href="logout.php?logout">Sign Out</a>-->


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



