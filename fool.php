<?

echo("<hr><b>Версия 0.БетаА3</b> 
<br>
<div id='wind'>
Переходя в панель администратора, вы подтверждаете свои обдуманные действия и не являетесь спамером. Вы действительно хотите перейти в панель ?<br><center><a href='/index/adm/login.php'>Да! Очень сильно хочу!</a></center>
");
echo("<br>
<center><button type='button' value='Закрыть' onclick='"); echo('document.getElementById("wind").style.display="none"; return false;'); echo(">
Не... я передумал.</button></center>
</div>
</html>
");
?>