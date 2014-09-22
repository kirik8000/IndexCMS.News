<?php
include("conf_db.php");
include("menu.php");
echo('<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><hr> ');// 
$query = "select * from context ORDER BY id DESC";
$result = mysql_query($query, $link);
if(!empty($_GET['id'])) 
{ 
  mysql_query("DELETE FROM customer WHERE id='$_GET[id]'"); 
  header("Location: select.php");
}; 
if(!empty($_GET['like'])) 
{ 
include("conf_db.php");
$likeid = $_GET['like'];
$result41=mysql_query("SELECT * FROM context WHERE id='$likeid'");
	while($likew= mysql_fetch_array($result41,MYSQL_ASSOC)) // ищем и выводим изображение и название рубрики
	{	
		$likeorig=$likew['rout'];	
	}
$likeorig = $likeorig + 1;
  mysql_query("update context SET rout='$likeorig' where id='$_GET[like]'"); 
  header("Location: index.php");
};

if(!empty($_GET['dlike'])) 
{ 
include("conf_db.php");
$dlikeid = $_GET['dlike'];
$result411=mysql_query("SELECT * FROM context WHERE id='$dlikeid'");
	while($dlikew= mysql_fetch_array($result411,MYSQL_ASSOC))
	{
		$dlikeorig=$dlikew['rout'];
	}
$dlikeorig = $dlikeorig - 1;
  mysql_query("update context SET rout='$dlikeorig' where id='$_GET[dlike]'"); 
  header("Location: index.php");
};
if(!empty($_GET['led'])) 
{ 
$textled = $_POST['led'];
   mysql_query("update led SET text='$textled' where id='$_GET[led]'");  
   header("Location: select.php");
}; 
if(!empty($_GET['comment'])) 
{ 
$id_active = $_GET['comment'];
  $commen=$_POST['msg']; 
  $commeni=$_POST['msgi']; 
  mysql_query("update customer SET comment='$commen' where id='$_GET[comment]'"); 
  mysql_query("update customer SET name='$commeni' where id='$_GET[comment]'"); 
  echo("<script type='text/javascript'>
  showNoticeToast();
showSuccessToast();
</script>");
  header("Location: select.php");
};
//НАЧИНАЕТСЯ ТАБЛИЦА
echo("");
while($rows= mysql_fetch_array($result,MYSQL_ASSOC))
{

$rub = $rows['rubrika'];
$text= $rows['text'];
$dat= $rows['data'];
$rout=$rows['rout'];
$idnew=$rows['id'];
$result3=mysql_query("SELECT * FROM rubrika WHERE id='$rub'");
	while($rubrik= mysql_fetch_array($result3,MYSQL_ASSOC)) 
	{	
		$imgrub=$rubrik['img'];
		$namerub=$rubrik['rubrikaname'];
	}
echo("<TABLE class='index' align='center' > 
        <TR>
                <TD ROWSPAN=2 class='new'>
");
$dt=date('d.m.Y H:i:s');
$ts1 = strtotime($dat);
$ts2 = strtotime($dt);
if (abs($ts1 - $ts2) < 60 * 60 * 24) {
echo "<img src='/index/img/new.png'> ";
} 
echo("
</TD>
                <TD ROWSPAN=2><img src='$imgrub'></TD>
                <TD valign='top' align='left' class='newtext' style='background-images: url(images.jpg)' bgcolor='#ffffff'><br>$text</TD>
        </TR>
        <TR>
                 <TD class='topnew' style='background-images: url(images.jpg)' bgcolor='#ffffff'>
				 <TABLE WIDTH=100%>
                <TR><TD> Публикация от $dat</TD><TD align='right'>Рейтинг:"); 
                if ($rout > -1 ) { echo("<font color='green'>$rout</font>");} else { echo("<font color='red'>$rout</font>"); }
                  echo("<a href='select.php?like=$idnew'><img src='/index/img/good.png'></a><a href='select.php?dlike=$idnew'><img src='/index/img/bad.png'></a></TD>
                </TR>
            </TABLE>
 </TD>
        </TR>	
</TABLE>
<br><br>");		
}
mysql_close($link);
include("fool.php");


