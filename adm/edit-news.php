<?
include("../menu.php");

?>
<style type="text/css" media="screen">
@import url("../img/style.css");
	@import url("mondal.css"); 
</style>
<?
if(!empty($_GET['save_news'])) 
{ 
include("conf_db.php");
$idsave = $_GET['save_news'];
$rub_sav = $_POST['rubrika'];
$dat_sav = $_POST['data'];
$rou_sav = $_POST['rout'];
$txt_sav = $_POST['text'];
mysql_query("update context SET rubrika='$rub_sav' where id='$idsave'"); 
mysql_query("update context SET data='$dat_sav' where id='$idsave'");
mysql_query("update context SET rout='$rou_sav' where id='$idsave'");
mysql_query("update context SET text='$txt_sav' where id='$idsave'");  
 header("Location: panel.php?all_news=1"); 
};

if(!empty($_GET['edit'])) 
{ 
$idedit = $_GET['edit'];
include("conf_db.php");
$result13=mysql_query("SELECT * FROM context where id='$_GET[edit]'");
	while($edit_new= mysql_fetch_array($result13,MYSQL_ASSOC)) 
	{
	$rub_ed = $edit_new['rubrika'];
	$dat_ed = $edit_new['data'];
	$rou_ed = $edit_new['rout'];
	$txt_ed = $edit_new['text'];
	
	}
echo('
<div id="parent_popup">
  <div id="popup">
<h1>«Редактирование новости № '.$idedit.'</h1>
    <form action="edit-news.php?save_news='.$idedit.'" method="POST">
<CENTER><TABLE BORDER>
        <TR>
                <TD>Рубрика</TD> <TD><input name="rubrika" type="text" readonly value="'.$rub_ed.'"></TD>
        </TR>
        <TR>
                <TD>Дата</TD> <TD><input name="data" type="text" value="'.$dat_ed.'"></TD>
        </TR>
        <TR>
                <TD>Рейтинг</TD> <TD><input name="rout" type="text" value="'.$rou_ed.'"></TD>
        </TR>
        <TR>
                <TD>Текст новости</TD> <TD><textarea name="text" cols="40" rows="5">'.$txt_ed.'</textarea></TD>
        </TR>
		<TR>
                <TD ROWSPAN=2><input name="submit" type="submit" value="Сохранить"></TD>
        </TR>
</TABLE></CENTER>');
?>
 <a class="close"title="Закрыть" onclick="document.getElementById('parent_popup').style.display='none'"></a>

</div>
</div>
        
        
       


</form>
        
    
 

<a href="panel.php?all_news=1" class='menu'>|| Назад на страницу всех новостей</a>


<script type="text/javascript">
	var delay_popup = 1000;
	setTimeout("document.getElementById('parent_popup').style.display='block'", delay_popup);
</script>    

<?

 // mysql_query("update context SET rout='0' where id='$_GET[reset]'"); 
  //header("Location: panel.php?all_news=1");

};


?>