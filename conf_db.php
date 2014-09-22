<?php
echo("<title>IndexCMS :: DEMO</title>");
echo('
<link rel="stylesheet" type="text/css" href="img/style.css" />
');
$dbhost = "localhost"; 
$dbuser = "index";
$dbpassword = "index"; 
$dbname = "index"; 
$link = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbname, $link);
