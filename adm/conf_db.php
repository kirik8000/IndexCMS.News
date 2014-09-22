<?php
echo("<title>36Lan NEWS :: DEMO</title>");
echo('<style type="text/css">
</style>');
$dbhost = "localhost"; 
$dbuser = "index"; 
$dbpassword = "index";
$dbname = "index";
$link = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbname, $link);
