<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
	require "db_connect.php";
	require "config.php";         //세팅파일 로드
	session_start();
	if(empty($_SESSION['id']))
	{
		echo "로그인 해 주세요.<br>";
		echo "<a href=\"login.php\">로그인</a><br>";
		echo "<a href=\"join.php\">회원가입</a><br>";
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