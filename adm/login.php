<style type="text/css" media="screen">
	@import url("../img/style.css"); 
</style>
<?
include("../menu.php");
if(!empty($_GET['no_login'])) 
{
print "Вы ввели неправильный логин/пароль"; 
}
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
function generateCode($length=6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";

    $code = "";

    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }

    return $code;

}

mysql_connect("localhost", "index", "index");

mysql_select_db("index");


if(isset($_POST['submit']))

{
    $query = mysql_query("SELECT user_id, user_password FROM users WHERE user_login='".mysql_real_escape_string($_POST['login'])."' LIMIT 1");
    $data = mysql_fetch_assoc($query);
	$passus=base64_encode(strcode($_POST['password'], '36LanRu')); // шифруем))))
    if($data['user_password'] === $passus)

    {
        $hash = md5(generateCode(10));
        mysql_query("UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");
        setcookie("id", $data['user_id'], time()+60*60*24*30);
        setcookie("hash", $hash, time()+60*60*24*30);
        header("Location: panel.php"); //exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
<form method="POST">
<CENTER><TABLE BORDER>
        <TR>
                <TD>Логин</TD> <TD><input name="login" type="text"></TD>
        </TR>
        <TR>
                <TD>Пароль</TD> <TD> <input name="password" type="password"></TD>
        </TR>
		<TR>
                <TD ROWSPAN=2><input name="submit" type="submit" value="Войти"></TD>
        </TR>
</TABLE></CENTER>
</form>