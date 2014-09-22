<?
include("conf_db.php");
include("../menu.php");
?>
<style type="text/css" media="screen">
	@import url("uni-form.css"); 
	@import url("../img/style.css"); 
</style>
<script src='jquery.js' type='text/javascript'></script>
<script src='uni-form.jquery.js' type='text/javascript'></script>
<script type="text/javascript">
$(function() {
	$(".uniForm").uniform();
	$("#textarea-3").blur(function() { if ($(this).val().length) {
        			$(this.parentNode).removeClass("error")
        		} else  {
        			$(this.parentNode).addClass("error")
        		} });
});
</script>
<?
if(!empty($_GET['newnews'])) 
{ 
include("conf_db.php");
$rubrika = $_POST['rubrika'];
$news = $_POST['news'];
   $dt=date('d.m.Y H:i:s');
$query = 'insert into context values(0,"'.$rubrika.'","'.$dt.'", "0", "'.$news.'")';
mysql_query($query, $link);
mysql_close($link); 
   header("Location: add_news.php");
}; 
if(!empty($_GET['del'])) 
{ 
  mysql_query("DELETE FROM context WHERE id='$_GET[del]'"); 
  header("Location: add_news.php");
}; 
?>
<form action='add_news.php?newnews=1' enctype='multipart/form-data' method='post' class='uniForm'>
<fieldset class='blockLabels'>
	<legend>Форма для добавления новости на главную страницу сети.</legend>
</fieldset>
<fieldset class='inlineLabels'>
	<div class='ctrlHolder'>
		<label><em>*</em> <strong>Выберите рубрику</strong></label>
		<select name='rubrika' class='selectInput'>
		<option value='0'>Без рубрики</option>
		<?		
		$result=mysql_query("SELECT * FROM rubrika"); 
		while($rows= mysql_fetch_array($result,MYSQL_ASSOC))
		{
		$rubname=$rows['rubrikaname'];
		$rubid=$rows['id'];
		printf("<option value='%d'>%s</option>",$rows['id'],$rows['rubrikaname']);
		}
		mysql_close($link);
		echo('$rubid');
		?>
		</select>
		<div class='formHint'>Если нет нужной рубрики добавь новую</div>
	</div>
</fieldset>
<fieldset class='blockLabels'>
	<div class='ctrlHolder'>
		<label><em>*</em> <strong>Новость</strong></label>
		<textarea id="textarea-3" rows='40' cols='25' name='news' class='wide'></textarea>
		<div class='formHint'>Излогай новость кратко и красочно, ну и без матов и пошлостей =)</div>
	</div>
</fieldset>
<fieldset class='inlineLabels'>
	<div class='ctrlHolder'>
		<label><em>*</em> <strong>Подленность</strong></label>
			<input name='f.name' type='radio' value="1">Я робот и подтверждаю, что мои действия были не обдуманны.</option>
		<br />	<input name='f.name' type='radio' value="0">Я не робот и подтверждаю, что мои действия были обдуманны.</option>
	</div>
	<div class="buttonHolder">
		<button type="submit" class="submitButton" name="send">Отправить</button>
	</div>
</fieldset>
</form>
<hr>
Все новости<br />
<TABLE BORDER>
        <TR>
                <TD>ID</TD> <TD>Рубрика</TD> <TD>Дата</TD><TD>Рейтинг</TD><TD>Текст новости</TD><td>ADM Fun</td>
        </TR>
<? include("conf_db.php");
$result3=mysql_query("SELECT * FROM context ORDER BY id DESC");
	while($new= mysql_fetch_array($result3,MYSQL_ASSOC)) // ищем и выводим изображение и название рубрики
	{
	printf("
        <TR>
                <TD>%d</TD> <TD>%s</TD> <TD>%s</TD> <TD>%s</TD><TD>%s</TD><TD><a href='add_news.php?del=%d'>Удалить</a></TD>
        </TR>",$new['id'],$new['rubrika'],$new['data'],$new['rout'],$new['text'],$new['id']);
	}
mysql_close($link); 
echo('</TABLE>');
include("../fool.php");
?>
