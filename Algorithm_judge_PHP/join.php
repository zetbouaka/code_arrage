<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
  require "db_connect.php";
  require "config.php";         //�������� �ε�
  #$sql = "select * from cube_game where no=1";
  #$result = mysql_query($sql,$connect);
  #$game = mysql_fetch_array($result);



#  if($game[mode] == 0) {
echo ("
				<form name=form1 method=post action=join_input.php>
				  <table width=400 border=1 bordercolor=gray>
					<tr>
					  <td width=100>���̵�</td>
					  <td><input type=text name=id></td>
					</tr>
					<tr>
					  <td>��й�ȣ</td>
					  <td><input type=password name=pass1></td>
					</tr>
					<tr>
					  <td>��й�ȣ Ȯ��</td>
					  <td><input type=password name=pass2></td>
					</tr>
					<tr>
					<tr>
					  <td>�г���</td>
					  <td><input type=text name=nickname></td>
					</tr>
					<tr>
					  <td colspan=2 align=center><input type=submit name=Submit value=�Է��ϱ�>
					  <input type=reset name=Submit2 value=�ٽþ���></td>
					</tr>
				  </table>
				</form>
			");
 # } else {
#	  echo "ȸ�����ԱⰣ�� �ƴմϴ�";
 # }
?>