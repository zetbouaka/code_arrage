<?PHP

	require "db_connect.php";
#	require "login.php";
	
	$input_key = $_POST['key'];
	$input_user_phonenum = $_POST['phonenum'];
	$input_title = $_POST['title'];
	$input_context = $_POST['title'];
	$now = time();
	$input_time = date("Y-m-d-H:i:s", $now);
	
	$sql = "INSERT INTO TimeMaking_context SET
	title = '$input_title', 
	key = '$input_key',
	phonenum = '$input_user_phonenum',
	context = '$input_context',
	time = '$input_time'";
	$sql_result = mysql_query($sql, $connect);
	echo "메세지를 전송했습니다!";
?>