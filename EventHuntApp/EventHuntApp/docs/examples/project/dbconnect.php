

<?php
// this will avoid mysql_connect() deprecation error.
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );
 // but I strongly suggest you to use PDO or MySQLi.

 define('DBHOST', 'ec2-35-165-34-54.us-west-2.compute.amazonaws.com');
 define('DBUSER', 'dora');
 define('DBPASS', 'yuanyuan');
 define('DBNAME', 'eventgo');
//$con = new PDO("mysql:host=ec2-35-165-18-123.us-west-2.compute.amazonaws.com;dbname=eventgo","dora", "yuanyuan”);

 $conn = mysql_connect(DBHOST,DBUSER,DBPASS);
 $dbcon = mysql_select_db(DBNAME);

 if ( !$conn ) {
  die("Connection failed : " . mysql_error());
 }

 if ( !$dbcon ) {
  die("Database Connection failed : " . mysql_error());
 }
?>
