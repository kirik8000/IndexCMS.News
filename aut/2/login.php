<?

// Страница авторизации



# Функция для генерации случайной строки
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



# Соединямся с БД

mysql_connect("localhost", "track", "track098");

mysql_select_db("track");


if(isset($_POST['submit']))

{

    # Вытаскиваем из БД запись, у которой логин равняеться введенному

    $query = mysql_query("SELECT user_id, user_password FROM users WHERE user_login='".mysql_real_escape_string($_POST['login'])."' LIMIT 1");

    $data = mysql_fetch_assoc($query);

    

    # Соавниваем пароли
	// $passus = strcode(base64_decode($_POST['password']), '36LanRu'); раскодировать
	$passus=base64_encode(strcode($_POST['password'], '36LanRu')); // шифруем))))
    if($data['user_password'] === $passus)

    {

        # Генерируем случайное число и шифруем его

        $hash = md5(generateCode(10));

                   

        # Записываем в БД новый хеш авторизации и IP

        mysql_query("UPDATE users SET user_hash='".$hash."' ".$insip." WHERE user_id='".$data['user_id']."'");

        

        # Ставим куки

        setcookie("id", $data['user_id'], time()+60*60*24*30);

        setcookie("hash", $hash, time()+60*60*24*30);

        

        # Переадресовываем браузер на страницу проверки нашего скрипта

        header("Location: check.php"); exit();

    }

    else

    {

        print "Вы ввели неправильный логин/пароль";

    }

}

?>

<form method="POST">

Логин <input name="login" type="text"><br>

Пароль <input name="password" type="password"><br>

Не прикреплять к IP(не безопасно) <input type="checkbox" name="not_attach_ip"><br>

<input name="submit" type="submit" value="Войти">

</form>