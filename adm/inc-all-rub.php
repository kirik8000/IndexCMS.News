<style type="text/css" media="screen">
	@import url("../img/style.css"); 
</style>
<?
if(!empty($_GET['del'])) 
{ 
include("conf_db.php");
  mysql_query("DELETE FROM rubrika WHERE id='$_GET[del]'"); 
  header("Location: panel.php?all_rub=1");
}; 
?>

Все рубрики<br />
<TABLE BORDER>
        <TR>
                <TD>ID</TD> <TD>Изображение</TD> <TD>Название рубрики</TD><TD>Информация</TD><TD>ADM Fun</TD>
        </TR>
<? include("conf_db.php");
$result3=mysql_query("SELECT * FROM rubrika ORDER BY id DESC");
	while($rub= mysql_fetch_array($result3,MYSQL_ASSOC)) 
	{
	printf("
        <TR>
                <TD>%d</TD> <TD><img src='%s'></TD> <TD>%s</TD> <TD>%s</TD><TD><a href='inc-all-rub.php?del=%d'><img src='../img/del.png'></a></TD>
        </TR>
",$rub['id'],$rub['img'],$rub['rubrikaname'],$rub['info'],$rub['id']);
	}

mysql_close($link); 
echo('</TABLE>');