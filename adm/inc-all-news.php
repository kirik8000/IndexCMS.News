<style type="text/css" media="screen">
	@import url("../img/style.css"); 
	@import url("mondal.css"); 
</style>
<?
if(!empty($_GET['del'])) 
{ 
include("conf_db.php");
  mysql_query("DELETE FROM context WHERE id='$_GET[del]'"); 
  header("Location: panel.php?all_news=1");
}; 

if(!empty($_GET['reset'])) 
{ 
include("conf_db.php");
  mysql_query("update context SET rout='0' where id='$_GET[reset]'"); 
  header("Location: panel.php?all_news=1");

};




?>
Все новости<br />
<TABLE BORDER>
        <TR>
                <TD>ID</TD> <TD>Рубрика</TD> <TD>Дата</TD><TD>Рейтинг</TD><TD>Текст новости</TD><td>ADM Fun</td>
        </TR>
<? include("conf_db.php");
$result3=mysql_query("SELECT * FROM context ORDER BY id DESC");
	while($new= mysql_fetch_array($result3,MYSQL_ASSOC))
	{
	printf("
        <TR>
                <TD>%d</TD>",$new['id']);  
                $resultrub=mysql_query("SELECT * FROM rubrika where id='$new[rubrika]'"); 
		while($rubriko= mysql_fetch_array($resultrub,MYSQL_ASSOC))
		{
		$rubname=$rubriko['rubrikaname'];
		}                
                printf("<TD>%s</TD> <TD>%s</TD> <TD>%s<a href='inc-all-news.php?reset=%d'><img src='../img/reset.png'></a></TD><TD>%s</TD><TD><a href='inc-all-news.php?del=%d'><img src='../img/del.png'></a><a href='edit-news.php?edit=%d'><img src='../img/edit.png'></a>
        ",$rubname,$new['data'],$new['rout'],$new['id'],$new['text'],$new['id'],$new['id']);
	echo(' </TD></TR>
');
	
	
	
	}

mysql_close($link); 
echo('</TABLE>');