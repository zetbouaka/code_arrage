<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
	require "db_connect.php";
	require "config.php";         //�������� �ε�
	session_start();
	if(empty($_SESSION['id']))
	{
		echo "�α��� �� �ּ���.<br>";
		echo "<a href=\"login.php\">�α���</a><br>";
		echo "<a href=\"join.php\">ȸ������</a><br>";
		exit;
	}
	
	$problem_code = $_GET["pcode"];

	if(empty($problem_code)){
		echo "���� �̸��� �����Ǿ� ���� �ʽ��ϴ�.<br>";
		exit;
	}

#  if($game[mode] == 0) {
echo ("	Problem code = {$problem_code}<br><br>
		Source : <form name=form1 method=post action=submit_result.php?pcode={$problem_code}>
				
				<textarea name=src cols=80 rows=30></textarea>
				<br><input type=submit name=Submit value='submit'>
				</form>
	
			<a href=\"index.php\">���� ȭ������</a><br>");
 # } else {
#	  echo "ȸ�����ԱⰣ�� �ƴմϴ�";
 # }
?>