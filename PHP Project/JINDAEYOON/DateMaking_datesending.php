<?PHP

	require "db_connect.php";
	require "login.php";
	
	$input_key = $_GET['key'];
	$input_user_phonenum = $_GET['phonenum'];
	$input_response = $_GET['response'];
	
	$now = time();
	$input_time = date("Y-m-d-H:i:s", $now);
	
	$sql = "SELECT * FROM DateMaking_response WHERE DM_ID = '$input_key' AND phonenum = '$input_user_phonenum'" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num!=0){
		echo "이미 응답을 했습니다.";
		exit;
	}
	$sql = "INSERT INTO DateMaking_response SET
	DM_ID = '$input_key', 
	phonenum = '$input_user_phonenum',
	response = '$input_response',
	time = '$input_time'";
	$sql_result = mysql_query($sql, $connect);
	echo "데이터를 기록했습니다!";
?>