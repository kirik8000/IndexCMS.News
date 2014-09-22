<?php
include("conf_db.php");
$name=$_POST['name'];
$mac=$_POST['mac'];
$mail=$_POST['mail'];
echo('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> ');
$dt=date('d:m:Y');
$query = 'insert into customer values(0,"'.$name.'","'.$mac.'", "0", "Ждет обработки менеджером")';
mysql_query($query, $link);
mysql_close($link);
echo $mac;
mail($mail, "Заявка принята.", "Данные отправлены, ожидайте письмо с подтверждением от администратора.",
     "From:  \r\n"
    ."X-Mailer: PHP/" . phpversion()); 
header("Location: stat.php");
?>