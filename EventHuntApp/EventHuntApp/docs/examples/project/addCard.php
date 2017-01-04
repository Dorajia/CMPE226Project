
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
 

 if ( isset($_POST['btn-update']) ) {

// clean user inputs to prevent sql injections
  $cardholder = trim($_POST['cardholder']);
  $cardholder = strip_tags($cardholder);
  $cardholder = htmlspecialchars($cardholder);
  
  $cardno = trim($_POST['cardno']);
  $cardno = strip_tags($cardno);
  $cardno = htmlspecialchars($cardno);

  $valid = trim($_POST['valid']);
  $valid = strip_tags($valid);
  $valid = htmlspecialchars($valid);

  $cardtype = trim($_POST['cardtype']);
  $cardtype = strip_tags($cardtype);
  $cardtype = htmlspecialchars($cardtype);
  
if (empty($cardholder)) {
   $error = true;
   $nameError = "Please enter card holder.";
  } else if (!preg_match("/^[a-zA-Z]+$/",$cardholder)) {
   $error = true;
   $nameError = "Name must contain alphabets only.";
  }

  if (empty($cardno)) {
   $error = true;
   $cardError = "Please enter valid card number.";
  } else if (!preg_match("#^[0-9]{14}$#",$cardno)) {
   $error = true;
   $cardError = "card number must be numbers only and contain 14 numbers.";
  }
   if (empty($valid)) {
   $error = true;
   $validError = "Please enter valid validate until.";
  } else if (!preg_match("/^(0[1-9]|1[0-2])-[0-9]{4}$/",$valid)) {
   $error = true;
   $validError = "Date format must be mm-yyyy";
  }
  
  if( !$error ) {
   $query = "insert into card(card_NO,card_holder,validate_until,card_type,purse_ID) select '$cardno','$cardholder','$valid','$cardtype', purse.purse_ID from purse where purse.user = '$userId';";
   
   $res = mysql_query($query);  
   //
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully added";
    unset($cardholder);
    unset($cardno);
    unset($valid);
    unset($cardtype);

     header('Location: purse.php');

   } else {

    $errTyp = "danger";
    $errMSG = "Something went wrong, try again";
   }

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
            <th scope="row">Card Holder</th>
            <td><input type="text" name="cardholder" value="<?php echo $cardholder ?>"></td>
            <span class="text-danger"><?php echo $nameError; ?></span>
          </tr>
          <tr>
            <th scope="row">Card Number</th>
            <td><input type="text" name="cardno" value= "<?php echo $cardno ?>"></td>
            <span class="text-danger"><?php echo $cardError; ?></span>
          </tr>
          <tr>
            <th scope="row">valid until</th>
            <td><input type="text" name="valid" placeholder="mm-yyyy" value="<?php echo $valid ?>" ></td>
            <span class="text-danger"><?php echo $validError; ?></span>
          </tr>
          <tr>
            <th scope="row">Card Type</th>
            <td>
                <select name="cardtype" class="form-control">
                <option value="VISA" class="form-control" maxlength="50">VISA</option>
                <option value="American Express" class="form-control" maxlength="50">American Express</option>
                <option value="Diners Club" class="form-control" maxlength="50">Diners Club</option>
                <option value="MasterCard" class="form-control" maxlength="50">MasterCard</option>
                <option value="Cirrus" class="form-control" maxlength="50">Cirrus</option>
                <option value="Maestro" class="form-control" maxlength="50">Maestro</option>
                <option value="China UnionPay" class="form-control" maxlength="50">China UnionPay</option>
                <option value="Octopus card" class="form-control" maxlength="50">Octopus card</option>
                <option value="Mondex" class="form-control" maxlength="50">Mondex</option>
                <option value="Redecard" class="form-control" maxlength="50">Redecard</option>
                <option value="Japan Credit Bureau" class="form-control" maxlength="50">Japan Credit Bureau</option>
                </select>
            </td>
          </tr>
          
          
          </tbody>
        </table>

        <div >
<!--          <span class = "pull-right"><button type="submit" name="btn-update" class="btn btn-default"><a href="account.php">update</a></button></span>-->
          <a href="purse.php"><button type="submit" name="btn-update">Add</button> </a>

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



