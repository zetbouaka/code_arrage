<?PHP

	require "db_connect.php";
	require "login.php";
	
	$input_key = $_POST['key'];
	$input_user_phonenum = $_POST['phonenum'];
	$input_resp='';
	for($i=0;$i<25;$i++){
		$amount = $_POST['check'.$i];
		if($amount!=0){
			$input_resp.=$i;
			$input_resp.=":";
		}
	}
	$input_resp = $_POST['resp'];
	$now = time();
	$input_time = date("Y-m-d-H:i:s", $now);
	$sql = "SELECT * FROM TimeMaking_response WHERE No = '$input_key' AND phonenum = '$input_user_phonenum'" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	$list = mysql_fetch_array($result);
	if ($num!=0 && $list[$resp]!='NO RESPONSE'){
		echo "이미 응답을 했습니다.";
		exit;
	}
	$sql = "INSERT INTO DateMaking_response SET
	No = '$input_key', 
	phonenum = '$input_user_phonenum',
	resp = '$input_resp',
	time = '$input_time'";
	$sql_result = mysql_query($sql, $connect);
	echo "데이터를 기록했습니다!";
?>