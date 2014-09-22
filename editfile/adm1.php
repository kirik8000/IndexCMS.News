<style type="text/css" media="screen">
	@import url("../img/style.css"); 
</style>
<? 
include("../menu.php");
?>
<TABLE BORDER WIDTH="100%">
        <TR><TD WIDTH=15% valign='top'>
		<center><h3>МЕНЮ</h3></center>
<a href="adm1.php?new_news=1" class='menu'>Добавить новость</a><br>
<a href="adm1.php?new_rub=1" class='menu'>Добавить рубрику</a><br>
<a href="adm1.php?all_news=1" class='menu'>Показать новости</a><br>
<a href="adm1.php?all_rub=1" class='menu'>Показать рубрики</a><br>
<a href="adm1.php?all_user=1" class='menu'>Показать пользователей</a><br>
<a href="adm1.php?dfile=1" class='menu'>Редактор файлов</a><br>
</TD><TD>
<?
if(!empty($_GET['new_news'])) 
{ 
header("Location: ../adm/panel.php?new_news=1");
}
if(!empty($_GET['new_rub'])) 
{ 
header("Location: ../adm/panel.php?new_rub=1");
}
if(!empty($_GET['all_news'])) 
{ 
header("Location: ../adm/panel.php?all_news=1");
}
if(!empty($_GET['all_rub'])) 
{ 
header("Location: ../adm/panel.php?all_rub=1");
}
if(!empty($_GET['all_user'])) 
{ 
header("Location: ../adm/panel.php?all_user=1");
}
if(!empty($_GET['dfile'])) 
{ 
header("Location: adm1.php");
}
?>
<p class='text'>Редактор <b>DFile</b> - внутренний текстовый редактор, написанный специально для нашей админки. Выполняет самые простые
функции редактирования. Сохранение по нажатию кнопки, без функции автосохранения.<br>Принцип работы, очень прост. 
Выбираем папку -> нажимаем Показать -> выбираем файл, нажатием Редактировать. Если ссылки редактировать нет - значит это папка или запрещенный файл.</p>
<hr>
 <form action='adm1.php?dir=1' method=post>
<select name='namedir'> 
<option value='#'>Выбери папку</option>
<option value=''>Корневая</option>
 <?

$sub1='.php';
$sub2='.'; // ищем в названии 
 $dir = "..";
$skip = array('.', '..');
$files = scandir($dir);
foreach($files as $filename) 
{
$pos1=strpos($filename,$sub1); // проверяет есть ли что то
if ($pos1 > 0) {} else {
    if(!in_array($filename, $skip) && $filename!="editfile" && $filename!="." && $filename!="img" && $filename!="logo.png" && $filename!=".." && $filename!="@eaDir" && $filename!=".DS_Store")  // добавляем каталоги чтобы их небыло видно     
echo("
<option value='$filename'>$filename</option>
");}
}

echo('
</select>
<input type="submit" value="Показать"> 
</form>');

//------------------------------Сохранение------------------
if(!empty($_GET['save'])) 
{ 
$d=$_POST['a'];
$addres=$_POST['addres'];
$fil="$addres";
$fp=fopen($fil,'w');
fwrite($fp,$d);
fclose($fp);
echo("<META HTTP-EQUIV='REFRESH' CONTENT='3; URL=adm1.php'>");
echo("<br>Файл лежит в: $addres <br> Переадресация через 3 секунды."); 
};
//----------------------------------------------------------
//-----------------------ЧТЕНИЕ ПАПКИ-----------------------
if(!empty($_GET['dir'])) // читаем что находится в папке
{ 

echo("<TABLE BORDER>");
$nfile= $_POST['namedir'];
echo("Папка: $nfile");
if($handle=opendir('../'.$nfile))
{
  while(false!==($file=readdir($handle)))
  {
  	$pos2=strpos($file,$sub2); // проверяем на папки
  	if ($pos2 > 0) {$okred='Редактировать';} else {$okred='';}
    if ($file!="." && $file!=".." && $file!="editfile" && $file!="@eaDir" && $file!=".DS_Store")
    {  
  echo("  
    
        <TR>
                <TD>$file</TD> <TD><a href='adm1.php?edit=$nfile/$file'>$okred</a></TD> 
        </TR>
        
");

    }   
  }
closedir($handle);  
}
echo("</TABLE>");
};
//----------------------------------------------------------
//-----------------Редактирование файла---------------------
// начинаем редактировать файл
if(!empty($_GET['edit']))
{ 
$x=$_GET['edit'];
echo $x;
$a=file_get_contents("../".$x);
echo("
<TABLE >
        <TR>
                <TD>
<form action=adm1.php?save=1 method=post>
<input type='hidden' name='addres' value='../$x'>
<textarea type=text rows=20 cols=80 name='a'>$a</textarea><br>
<input name='Submit' type=submit value='Сохранить'>  
</TD>
                <TD VALIGN=top>");

 echo '<h3>Данные о файле: '.$x.'</h3>';
 $fi = '../'.$x;
 echo 'Последнее обращение: '.date('j F Y H:i', fileatime($fi)).'<br />';
 echo 'Последняя модификация: '.date('j F Y H:i', filemtime($fi)).'<br />';
 $user = posix_getpwuid(fileowner($fi));
 echo 'Владелец файла: '.$user['name'].'<br />';
 $group = posix_getgrid(filegroup($fi));
 echo 'Группа файла: '.$group['name'].'<br />';
 echo 'Права доступа: '.decoct(fileperms($fi)).'<br />';
 echo 'Тип файла: '.filetype($fi).'<br />';
 echo 'Размер файла: '.filesize($fi).' байтов<br />';
 echo '<h2>Статус файла</h2>';
 echo 'Каталог: '.(is_dir($fi)? 'да' : 'нет').'<br />';
 echo 'Исполняемый: '.(is_executable($fi)? 'да' : 'нет').'<br />';
 echo 'Файл: '.(is_file($fi)? 'да' : 'нет').'<br />';
 echo 'Ссылка: '.(is_link($fi)? 'да' : 'нет').'<br />';
 echo 'Разрешено чтение: '.(is_readable($fi)? 'да' : 'нет').'<br />';
 echo 'Разрешена запись: '.(is_writable($fi)? 'да' : 'нет').'<br />';
echo("</TD>
</TR>        
</table>
"); };
//---------------------------------------------------------- 