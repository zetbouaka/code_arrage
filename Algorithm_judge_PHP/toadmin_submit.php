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
	
	
	$id = $_SESSION['id'];
	$usern = $_SESSION['name'];
	$data = $_POST["src"];

	$sql = "insert into toadmin_context (userid, username, context) values ('$id', '$usern', '$data')";
	mysql_query($sql , $connect);		

	echo "Write!<hr>";
	echo "<a href=\"index.php\">Main</a><br>";

?>