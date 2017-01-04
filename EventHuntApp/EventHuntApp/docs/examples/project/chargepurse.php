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
$user_id = $_SESSION['user'];
$cardNo =$_GET['cardNo'];

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
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
  </nav>

            
  <h1>Input charge amount and choose a card to pay or add a new card</h1>
    <div class="panel panel-default">
        <!--        <div class="panel-heading">Panel heading without title</div>-->
        <div class="panel-body">
            <form method="post" action="paybyCardForCharge.php">
             <h2>Input Charge Amount</h2>
                <div class="panel panel-default">
                    <!--        <div class="panel-heading">Panel heading without title</div>-->
                    <div class="panel-body">
                        <input type="text" name="amount" placeholder= ">0">
                    </div>
                </div>
            <h2>Add a new card</h2>
                <div class="panel panel-default">
                    <!--        <div class="panel-heading">Panel heading without title</div>-->
                    <div class="panel-body">
                        <button type="button" class="btn btn-default"><a href='addCard.php?'>add new card</a></button>
                    </div>
                </div>
                
            <h2>Choose a card to pay</h2>
            <table class="table table-striped">
                <tbody>
                <?php

                try {
                    // Connect to the database.
                  $con = new PDO("mysql:host=ec2-35-165-34-54.us-west-2.compute.amazonaws.com;dbname=eventgo","dora", "yuanyuan");


                    $con->setAttribute(PDO::ATTR_ERRMODE,
                        PDO::ERRMODE_EXCEPTION);

                        $user_id = $_SESSION['user'];
                        $query = " select c.card_NO,c.card_holder,c.validate_until,c.card_type from card c,purse p where c.purse_id = p.purse_id and p.user = :user_id ";

                        $ps = $con->prepare($query);
                        // Fetch the matching row.
                        $ps->execute(array(':user_id' => $user_id));
                        $data = $ps->fetchAll(PDO::FETCH_ASSOC);

                    $doHeader = true;
                    foreach ($data as $row) {

                        // The header row before the first data row.
                        if ($doHeader) {
                            print "        <tr>\n";
                            foreach ($row as $name => $value) {
                                print "            <th>$name</th>\n";
                            }
                            print "<th>operation</th>";
                            print "        </tr>\n";

                            $doHeader = false;
                        }
          
                      $cardNo = "";
                      $count = 0;
                        print "            <tr>\n";
                        foreach ($row as $name => $value) {
                          if($count == 0){
                            $cardNo = $value;
                          }
                          $count ++;
                            print "                <td>$value</td>\n";
                        }
                      print "<td><button type=\"submit\" name = \"update\" class=\"btn btn-default\"><a href='paybyCardForCharge.php?cardNo=$cardNo&amount=$amount'>pay</a></button></td>";

                      print "            </tr>\n";
                    }
                }
                catch(PDOException $ex) {
                    echo 'ERROR: '.$ex->getMessage();
                }
                ?>
                </tbody>
            </table>
        
        </form>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
