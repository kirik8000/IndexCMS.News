<?php 
function crdb()
{
    // ������������ � �������, 
	// �� ������� ����� ��������� ���� ������.
	// � ������ ������ ��� ��������� ���������� �� ������� �� ���������.
	// ��� ��� ������ localhost (���� ��� ���������� �� ��������).
	// ��� �������
	$HOST = htmlspecialchars($_POST['name_server']); 
	// ������������ ���� ������ MySQL 
	$USER = htmlspecialchars($_POST['login']);
	// ������ ��� ������� � ������� MySQL
	$PASS = htmlspecialchars($_POST['pass']);
	// �������� ����������� ���� ������
	$DB = htmlspecialchars($_POST['name_db']); 
	// ���� ������������ ����������� �������� ���������,
	// ��� ������� �������� ���� ������.
	// �������� ����� ������������ 
	$CONFIG = htmlspecialchars($_POST['confg']); 
    if(!empty($HOST) && !empty($USER) && !empty($DB) && !empty($CONFIG))
	{
		if(@!mysql_connect("$HOST", "$USER", "$PASS"))
		{
			return "<strong>���������� ����������� � �������.</strong><br> <br>
                   <p align=left><b> ��������� �������:</b><br>
					1. �� ��������� ����� ������. (�� ��������� ������ �����������)<br>
                    2. ��� ������� ������� �� �����.<br>
                    3. ����� ������� � ������� ���� ������ MySQL �� ���������������.</p>";
		}
		$r = mysql_query("CREATE DATABASE $DB");
		if(!$r)
		{
			return "<strong>���������� ������� ���� ������.</strong><br> <br>
                   <p align=left><b> ��������� �������:</b><br>
					���� ������ ��� ����������, ������� �����.</p>";
		}
?>
<?php
		if (!mysql_select_db($DB))
		{
			return mysql_error();
		}
		mysql_query('SET NAMES cp1251;');
// ������ ���������������� ����		
$data = "<?php
\$HOST = '$HOST';
\$USER = '$USER';
\$PASS = '$PASS';
\$DB = '$DB';

if(@!mysql_connect(\$HOST, \$USER, \$PASS)) exit(mysql_error());
if (@!mysql_select_db(\$DB)) exit(mysql_error());
mysql_query('SET NAMES cp1251;');
?>";
		$hd = fopen($CONFIG,"w");
		$e = fwrite($hd, $data);
		if($e == -1)
		{
		   return "������. ���������������� ���� �� ������.";	
		}
		return "<span class='green'>���� ������ \"$DB\" ������� �������.</span><br>
                                    <a href='create-tab.php?config=$CONFIG'>�����</a>";
	}
	else
	{
	   return "�� ��� ���� ���������.";	
	}
}
if($_POST['button'] == "�������")
{
 $err = crdb();
}
?>
<link href="/create/st.css" rel="stylesheet" type="text/css">


<form method="post" action="">
  <div class="centers">
    <!--<p align="left">���� ���������� ��������� (<span class='red'>*</span>), ����������� � ����������.</p>--><br>
    <br>
     <table align="center" width="483" border="0" cellpadding="5" cellspacing="5">
      <tr>
        <td colspan="2" align="center"><strong> ������� ���� ������ </strong></td>
      </tr>
      <tr>
        <td width="224" align="right"><span class='red'>*</span>��� �������:</td>
        <td width="227" align="left"><input name="name_server" type="text" value="localhost" size="30" maxlength="45"></td>
      </tr>
      <tr>
        <td align="right"><span class='red'>*</span>����� :</td>
        <td><input name="login" type="text"  value="root"  size="20" maxlength="25"></td>
      </tr>
      <tr>
        <td align="right">������:</td>
        <td><input name="pass" type="text" size="20" maxlength="20"></td>
      </tr>
      <tr>
        <td align="right"><span class='red'>*</span>��� ��:</td>
        <td><input name="name_db" type="text" value="<?php echo $DB; ?>" size="30" maxlength="30"></td>
      </tr>
      <tr>
        <td align="right"><span class='red'>*</span>��� config:</td>
        <td><input name="confg" type="text" value="config_test.php" size="30" maxlength="30"></td>
      </tr>
      <tr>
        <td align="right">&nbsp;</td>
        <td><label>
          <input type="submit" name="button" id="button" value="�������" class="buts">
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
