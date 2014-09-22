<?php 
function crdb()
{
    // Подключаемся к серверу, 
	// на котором будем создавать базу данных.
	// В данном случаи это локальный кеомпьютер на котором вы работаете.
	// Его имя всегда localhost (если его специально не изменили).
	// имя сервера
	$HOST = htmlspecialchars($_POST['name_server']); 
	// пользователь базы данных MySQL 
	$USER = htmlspecialchars($_POST['login']);
	// пароль для доступа к серверу MySQL
	$PASS = htmlspecialchars($_POST['pass']);
	// название создаваемой базы данных
	$DB = htmlspecialchars($_POST['name_db']); 
	// Файл конфигурации подключения создаётся автоматом,
	// при удачном создании базы данных.
	// Название файла конфигурации 
	$CONFIG = htmlspecialchars($_POST['confg']); 
    if(!empty($HOST) && !empty($USER) && !empty($DB) && !empty($CONFIG))
	{
		if(@!mysql_connect("$HOST", "$USER", "$PASS"))
		{
			return "<strong>Невозможно подключение к серверу.</strong><br> <br>
                   <p align=left><b> Возможные причины:</b><br>
					1. Не правильно введён пароль. (по умолчанию пороль отсутствует)<br>
                    2. Имя сервера введено не верно.<br>
                    3. Логин доступа к серверу базы данных MySQL не идентифицирован.</p>";
		}
		$r = mysql_query("CREATE DATABASE $DB");
		if(!$r)
		{
			return "<strong>Невозможно создать базу данных.</strong><br> <br>
                   <p align=left><b> Возможные причины:</b><br>
					База данных уже существует, создана ранее.</p>";
		}
?>
<?php
		if (!mysql_select_db($DB))
		{
			return mysql_error();
		}
		mysql_query('SET NAMES cp1251;');
// Создаём конфигурационный файл		
$data = "<?php
\$HOST = '$HOST';
\$USER = '$USER';
\$PASS = '$PASS';
\$DB = '$DB';

if(@!mysql_connect(\$HOST, \$USER, \$PASS)) exit(mysql_error());
if (@!mysql_select_db(\$DB)) exit(mysql_error());
mysql_query('SET NAMES cp1251;');
?>";
		$hd = fopen($CONFIG,"w");
		$e = fwrite($hd, $data);
		if($e == -1)
		{
		   return "Ошибка. Конфигурационный файл не создан.";	
		}
		return "<span class='green'>База данных \"$DB\" успешно создана.</span><br>
                                    <a href='create-tab.php?config=$CONFIG'>Далее</a>";
	}
	else
	{
	   return "Не все поля заполнены.";	
	}
}
if($_POST['button'] == "Создать")
{
 $err = crdb();
}
?>
<link href="/create/st.css" rel="stylesheet" type="text/css">


<form method="post" action="">
  <div class="centers">
    <!--<p align="left">Поля отмеченные звёздочкой (<span class='red'>*</span>), обязательны к заполнению.</p>--><br>
    <br>
     <table align="center" width="483" border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td colspan="2" align="center"><strong> СОЗДАТЬ БАЗУ ДАННЫХ </strong></td>
      </tr>
      <tr>
        <td width="224" align="right"><span class='red'>*</span>Имя сервера:</td>
        <td width="227" align="left"><input name="name_server" type="text" value="localhost" size="30" maxlength="45"></td>
      </tr>
      <tr>
        <td align="right"><span class='red'>*</span>Логин :</td>
        <td><input name="login" type="text"  value="root"  size="20" maxlength="25"></td>
      </tr>
      <tr>
        <td align="right">Пароль:</td>
        <td><input name="pass" type="text" size="20" maxlength="20"></td>
      </tr>
      <tr>
        <td align="right"><span class='red'>*</span>Имя БД:</td>
        <td><input name="name_db" type="text" value="<?php echo $DB; ?>" size="30" maxlength="30"></td>
      </tr>
      <tr>
        <td align="right"><span class='red'>*</span>Имя config:</td>
        <td><input name="confg" type="text" value="config_test.php" size="30" maxlength="30"></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="Создать" class="buts">
        </label></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><span class='red'><?php echo $err; ?></span></td>
      </tr>
    </table>
  </div>
</form>
