<style type="text/css" media="screen">
	@import url("../img/style.css"); 
</style>
<? include("check.php"); echo("<br>");
include("../menu.php");
?>
<TABLE BORDER WIDTH="100%">
        <TR><TD WIDTH=15% valign='top'>
		<center><h3>МЕНЮ</h3></center>
<a href="panel.php?new_news=1" class='menu'>Добавить новость</a><br>
<a href="panel.php?new_rub=1" class='menu'>Добавить рубрику</a><br>
<a href="panel.php?all_news=1" class='menu'>Показать новости</a><br>
<a href="panel.php?all_rub=1" class='menu'>Показать рубрики</a><br>
<a href="panel.php?all_user=1" class='menu'>Показать пользователей</a><br>
<a href="../editfile/adm1.php" class='menu'>Редактор файлов</a><br>
</TD><TD>
<?
if(!empty($_GET['new_news'])) 
{ 
include("inc-new-news.php");
}
if(!empty($_GET['new_rub'])) 
{ 
include("inc-new-rub.php");
}
if(!empty($_GET['all_news'])) 
{ 
include("inc-all-news.php");
}
if(!empty($_GET['all_rub'])) 
{ 
include("inc-all-rub.php");
}
if(!empty($_GET['all_user'])) 
{ 
include("inc-all-user.php");
}
if(!empty($_GET['dfile'])) 
{ 
include("../editfile/adm1.php");
}
?>
<hr>
36LanNews.Demo - Новостной движок.Демо </TD>
        </TR>
</TABLE>
