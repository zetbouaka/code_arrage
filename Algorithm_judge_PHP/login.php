<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
	require "db_connect.php";
  echo ("
  <html>
  <body>
 
	    <table width=650 border=1 bordercolor=gray>
	      <form id=form1 name=form1 method=post action='login_act.php'>
		  <tr>
      <td width=80 align=center>���̵�</td>
      <td width=150> <input type=text name=id></td>
      <td width=80 align=center>��й�ȣ</td>
      <td width=150><input type=password name=pass></td>
      <td width=100>
	  <input type=submit name=submit value=�α���></td>
	<td><input type=button value=ȸ������ onClick=window.location='./join.php'></td>
    </tr></table></form>");
	$sql = "select * from liveon_user" ;
	$result = mysql_query($sql, $connect);
	#$Resultfornummembers = mysql_query($sql,$connect); 
	$num = mysql_num_rows($result); 
	
	if($num==0){
		echo("�����ڰ� �����ϴ�");
	}
	else
	{
		echo "<p><p>���� ������:<p>";
		for ($i=0;$i<5;$i++)
		{
			$list = mysql_fetch_array($result);
			if($list==NULL){	
				break;
			}
			else
			{
				$username=$list[name];
				echo ("$list[no]��° ������ : {$username}<p>");
			}
		}
	}
	echo("
	</body>
	</html>");
?>