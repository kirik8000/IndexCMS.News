<?php
$config = htmlspecialchars($_REQUEST['config']);
include $config;

// ����������
// ��� �������
$name_tab = htmlspecialchars($_REQUEST['name_tab']);
//����
$pole = htmlspecialchars($_REQUEST['pole']);
// ��� ������
$tip = htmlspecialchars($_REQUEST['tip']);
// ���������� ����� �������
$dop = htmlspecialchars($_REQUEST['dop']);

if($_POST['cret'] == "�������")
{
	if($tip == "int")
	{
	   $z = 6;	
	}
	if($dop == "auto_increment")
	{
	  $sc = "NOT NULL"; 
	  $aut = "AUTO_INCREMENT=0";
	}
	else
	{
	  $dop = "";	
	}
	
	$di = mysql_query("SHOW TABLES FROM $DB");
	$query ="CREATE TABLE $name_tab (
	  $pole $tip($z) $sc $dop,
	  PRIMARY KEY  ($pole)
	) ENGINE=MyISAM $aut DEFAULT CHARSET=cp1251 $aut;";
	
	$q = mysql_query($query);
	if(!$q)
	{
	   $err = "������� �� �������, ������.";	
	}
	else
	{
	  $err = "<span class=green>������� ������� �������.</span>";	
	}
}
?>
<link href="/create/st.css" rel="stylesheet" type="text/css">

<form method="post" action="">
  <div class="centers">
    <table align="center" width="483" border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td colspan="2" align="center"><strong> ������� ������� </strong></td>
      </tr>
      <tr>
        <td width="224" align="right"><span class='red'>*</span>��� �������:</td>
        <td width="227" align="left"><input name="name_tab" type="text" value="testers" size="30" maxlength="45"></td>
      </tr>
      <tr>
        <td align="right"><span class='red'>*</span>����(�������):</td>
        <td><input name="pole" type="text"  value="id_tester"  size="20" maxlength="25"></td>
      </tr>
      <tr>
        <td align="right"><span class='red'>*</span>��� ������: </td>
        <td><label>
          <select name="tip" id="select">
            <option value="int" selected>int</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right">�������������:</td>
        <td><label>
          <select name="dop" id="select2">
            <option value="auto_increment">auto_increment </option>
            <option value="0" selected>-</option>
          </select>
        </label></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><label>
        <input name="config" type="hidden" value="<?php echo $config ?>">
          <input type="submit" name="cret" id="button" value="�������" class="buts">
        </label></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center"><span class='red'><?php echo $err; ?></span></td>
      </tr>
    </table>
  </div>
</form>
