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
	$("#text-2").blur(function() { if ($(this).val().length) {
        			$(this.parentNode).removeClass("error")
        		} else  {
        			$(this.parentNode).addClass("error")
        		} });
});
</script>
<?
if(!empty($_GET['newrub'])) 
{ 
include("conf_db.php");
$namerub = $_POST['namerub'];
$img = $_POST['img'];
$info = $_POST['info'];
$query = 'insert into rubrika values(0,"'.$namerub.'","'.$img.'", "'.$info.'")';
mysql_query($query, $link);
mysql_close($link); 
   header("Location: add_rub.php");
}; 
if(!empty($_GET['del'])) 
{ 
  mysql_query("DELETE FROM rubrika WHERE id='$_GET[del]'"); 
  header("Location: add_rub.php");
}; 
?>
<form action='add_rub.php?newrub=1' enctype='multipart/form-data' method='post' class='uniForm'>
<fieldset class='blockLabels'>
	<legend>Добавление новой рубрики</legend>
	<div class='ctrlHolder'>
		<p class='errorField'>
			<strong>Ты не ввел название рубрики, как она будет существовать дибил ???</strong>
		</p>
		<label><em>*</em> <strong>Название рубрики</strong></label>
		<input id="text-2" name='namerub' class='textInput' type='text' value="">
		<div class='formHint'>Введите название рубрики</div>
	</div>
	<div class='ctrlHolder'>
		<label><strong>Изображение для рубрики</strong></label>
		<input id="text-3" name='img' class='textInput' type='text' value="">
		<div class='formHint'>указать URL пример: /img/news.png</div>
	</div>
<div class='ctrlHolder'>
		<label><strong>Комментарий к рубрике</strong></label>
		<input id="text-3" name='info' class='textInput' type='text' value="">
		<div class='formHint'>Информация о рубрике</div>
	</div>
	<div class="buttonHolder">
		<button type="submit" class="submitButton">Добавить рубрику</button>
	</div>
</fieldset>
</form>
<hr>
Все рубрики<br />
<TABLE BORDER>
        <TR>
                <TD>ID</TD> <TD>Изображение</TD> <TD>Название рубрики</TD><TD>Информация</TD><TD>ADM Fun</TD>
        </TR>
<? include("conf_db.php");
$result3=mysql_query("SELECT * FROM rubrika ORDER BY id DESC");
	while($rub= mysql_fetch_array($result3,MYSQL_ASSOC)) // ищем и выводим изображение и название рубрики
	{
	printf("
        <TR>
                <TD>%d</TD> <TD><img src='%s'></TD> <TD>%s</TD> <TD>%s</TD><TD><a href='add_rub.php?del=%d'>Удалить</a></TD>
        </TR>
",$rub['id'],$rub['img'],$rub['rubrikaname'],$rub['info'],$rub['id']);
	}
mysql_close($link); 
echo('</TABLE>');
include("../fool.php");
?>