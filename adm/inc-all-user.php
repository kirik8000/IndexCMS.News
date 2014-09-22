<style type="text/css" media="screen">
	@import url("../img/style.css"); 
</style>
<?
function strcode($str, $passw="")
{
   $salt = "Dn8*#2n!9j";
   $len = strlen($str);
   $gamma = '';
   $n = $len>100 ? 8 : 2;
   while( strlen($gamma)<$len )
   {
      $gamma .= substr(pack('H*', sha1($passw.$gamma.$salt)), 0, $n);
   }
   return $str^$gamma;
}
$dbhost = "localhost";
$dbuser = "index"; 
$dbpassword = "index"; 
$dbname = "index"; 
$link = mysql_connect($dbhost, $dbuser, $dbpassword);
mysql_select_db($dbname, $link); 
?>

<a href='#' class='menu'><img src='../img/add.png'> Добавить пользователя</a><br />
<center><TABLE BORDER>
        <TR>
                <TD>ID</TD> <TD>Логин</TD> <TD>Пароль</TD><TD>IP</TD>
        </TR>
<? 
$result=mysql_query("SELECT * FROM users ORDER BY user_id DESC");
	while($user= mysql_fetch_array($result,MYSQL_ASSOC)) 
	{
	$pas= '*** Недоступно ***';
	printf("
        <TR>
                <TD>%d</TD> <TD>%s</TD> <TD>%s</TD> <TD>%s</TD>
        </TR>
",$user['user_id'],$user['user_login'],$pas,$user['user_ip']);
	}

mysql_close($link); 
echo('</TABLE></center>');