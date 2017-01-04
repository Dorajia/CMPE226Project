<?php
ob_start();
session_start();
require_once 'dbconnect.php';

// it will never let you open index(login) page if session is set
if (isset($_SESSION['user']) != "") {
  header("Location: account.php");
  exit;
}

$error = false;

if (isset($_POST['btn-login'])) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs

  if (empty($email)) {
    $error = true;
    $emailError = "Please enter your email address.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = true;
    $emailError = "Please enter valid email address.";
  }

  if (empty($pass)) {
    $error = true;
    $passError = "Please enter your password.";
  }

  // if there's no error, continue to login
  if (!$error) {


    $res = mysql_query("SELECT user_ID, password FROM registered_user WHERE email_address='$email'");
    $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
    $row = mysql_fetch_array($res);
    if ($count == 1 && $row['password'] == $pass) {
      $_SESSION['user'] = $row['user_ID'];
      header("Location: account.php");
    } else {
      $errMSG = "Email Address or password is incorrect";
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

  <title>Signin Template for Bootstrap</title>

  <!-- Bootstrap core CSS -->
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="../signin/signin.css" rel="stylesheet">

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
<div class="container">

  <div id="login-form">
    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
      <h2 class="form-signin-heading">Please sign in</h2>
        <?php
        if (isset($errMSG)) {

          ?>
          <div class="form-group">
            <div class="alert alert-danger">
              <span class="glyphicon glyphicon-info-sign"></span>

          <?php echo $errMSG; ?>
            </div>
          </div>
          <?php
        }
        ?>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1" ><span class="glyphicon glyphicon-envelope"></span></span>
            <input type="text" name="email" class="form-control" placeholder="Your Email"
                   value="<?php echo $email; ?>" maxlength="40" aria-describedby="basic-addon1"/>
          </div>
          <span class="text-danger"><?php echo $emailError; ?></span>
        </div>

        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-lock"></span></span>
            <input type="text" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
          </div>
          <span class="text-danger"><?php echo $passError; ?></span>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
        </div>

        <div class="form-group">
          <a href="register.php">Sign Up Here</a>
        </div>
    </form>
  </div>

</div>


<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>
