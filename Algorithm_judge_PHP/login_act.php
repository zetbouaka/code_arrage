<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
$ids = $_POST['id'];
$passs = $_POST['pass'];
require "db_connect.php";																		//mysql에 접속한다
$sql = "select * from liveon_user where id='$ids' and pass=md5('$passs')" ;
$result = mysql_query($sql, $connect);
$num = mysql_num_rows($result);           //아이디와 비번이 입력한것과 같은 인간을 찾는다
if($num == 0) {
	require "config.php";
	echo ("<font size=5><center>User not found
	</center></font>");
			echo ("
				<center><form name=login method=post action='./login.php'>
				<input type=submit name=submit value=돌아가기>
				</form></center>
					");
	exit;
} else {
	session_start();
	$_SESSION['id']=$_POST['id'];
	$sql = "select name from liveon_user where id='$ids' and pass=md5('$passs')" ;
	$result = mysql_query($sql, $connect);

	$num = mysql_num_rows($result);
	if($num==0)
	{
		require "config.php";
		echo ("<font size=5><center>User not found
		</center></font>");
		echo ("
			<center><form name=login method=post action='./login.php'>
			<input type=submit name=submit value=돌아가기>
			</form></center>
		");
		exit;
	}
	$list = mysql_fetch_array($result);

	$_SESSION['name']=$list[name];
	$_SESSION['id']=$ids;

	#echo "{$user_id}:::{$ids}:::{$num}:::{$_SESSION['name']}:::{$username}:::{$_SESSION['id']}";
	echo "<script>location.replace('index.php');</script>";        ///성공하면 접속
}
?>