<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<title>���� ����</title>
</head>

<body>
<?

	echo "������ ���̽��� �����մϴ�...<BR>";

	$Gname = $_POST['group_name'];
	
	require "./db_connect.php";																		
	
	//mysql�� �����Ѵ�
	echo "������ ���̽� ���ӿϷ�<p>";
	echo "�׷� �̸� : $Gname<p>";
	$sql = "select * from GroupList where Name='$Gname'";           //�׷� �̸��� �̹� �����ϰ� �ִ��� Ȯ��
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	if($idnum){
		echo "�̹� ���� �̸��� �׷��� �����մϴ�.";
		exit;
	}else{
		$sql = "INSERT INTO GroupList SET Name = '$Gname'";
		mysql_query($sql, $connect);
		echo "$Gname �׷��� �����߽��ϴ�.<p>";
		echo ("
			<form name=main method=post action='group_make_form.php'>
			<input type=submit name=submit value=�׷� ��������� ���ư���>
			</form>
			");
	}
	
?>
</body>
</html>
