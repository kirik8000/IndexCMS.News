<style type="text/css" media="screen">
	@import url("../img/style.css"); 
</style>
<?

// Скрипт проверки

if(!empty($_GET['exit_all'])) 
{ 
echo("ooooyyy");
 setcookie('id', '', time() - 3600);
 setcookie('hash', '', time() - 3600);
 header("Location: login.php"); exit();
}
# Соединямся с БД
mysql_connect("localhost", "track", "track098");

mysql_select_db("track");


if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

{   

    $query = mysql_query("SELECT *,INET_NTOA(user_ip) FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");

    $userdata = mysql_fetch_assoc($query);


    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
 or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0")))

    {

        setcookie("id", "", time() - 3600*24*30*12, "/");

        setcookie("hash", "", time() - 3600*24*30*12, "/");

        print "Хм, что-то не получилось";

    }

    else

    {

        print "Привет, ".$userdata['user_login'].". <a href='check.php?exit_all=1'>Выйти из панели</a>";
		

		

    }

}

else

{

    print "Включите куки";
 header("Location: login.php?no_login=1"); exit();
}