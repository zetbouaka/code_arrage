<?PHP

	//xml 데이터를 받아서
	//DB에 저장
	require "./db_connect.php";	
	#require "./login.php";
	

//echo '자세한 디버깅 정보입니다:';
//print_r($_FILES);

//print "</pre>";
	
	$XML_STRING = $_POST['xmlfile'];
	$xml = new SimpleXMLElement($XML_STRING);
//	$xml = simplexml_load_file("test2.xml");
	

	$input_grouptitle = (string) $xml -> groupTitle;
	$input_meetingTitle = (string) $xml -> meetingTitle;
	$input_meetingOutline = (string) $xml -> meetingOutline;
	
	$n = count($xml->contactsList->data);
	
	for ($i=0;$i<$n;$i++){
		$input_user_name[$i]=(string) $xml -> contactsList -> data[$i] -> name;
		$input_user_email[$i]=(string) $xml -> contactsList -> data[$i] -> email;
		$input_user_phonenum[$i]=(string) $xml -> contactsList -> data[$i] -> phoneNum;
	}
	
	$m = count($xml -> date);
	
	for ($i=0;$i<$m;$i++){
		$input_date[$i] = (string) $xml -> date;
	}
	
	$k = count($xml -> time);
	
	for ($i=0;$i<$k;$i++)
	{
		$input_time[$i] = (string) $xml -> time;
	}

	$input_attendance = (string) $xml -> attendance;
	$input_alarm = (integer) $xml -> alarm;
	$input_location = (string) $xml -> location;
	
	echo $m;
	echo $k;
	
	$sql = 
	"INSERT INTO TimeMaking SET GroupTitle = '$input_grouptitle',
	meetingTitle = '$input_meetingTitle',
	meetingOutline = '$input_meetingOUtline',
	attendance = '$input_attendance',
	location = '$input_location'
	";
	
	$sql_result = mysql_query($sql, $connect);
	$sql = "SELECT * FROM TimeMaking WHERE meetingTitle = '$input_meetingTitle'";
	$sql_result = mysql_query($sql, $connect);
		
	$list = mysql_fetch_array($sql_result);

	$TEMP_NUM = (int) $list[No];

	for ($i=0;$i<$n;$i++){
		$sql = "INSERT INTO TimeMaking_contactsList 
				SET 
				No = '$TEMP_NUM',
				name = '$input_user_name[$i]',
				email = '$input_user_email[$i]',
				phoneNum = '$input_user_phonenum[$i]'
				";
		$result = mysql_query($sql , $connect);
	}
	
	for ($i=0;$i<$m;$i++){
		$sql = "INSERT INTO TimeMaking_dateList 
				SET 
				No = '$TEMP_NUM',
				date = '$input_date[$i]'
				";
		$result = mysql_query($sql , $connect);

	}
	
	for ($i=0;$i<$k;$i++){
		$sql = "INSERT INTO TimeMaking_timeList 
				SET 
				No = '$TEMP_NUM',
				time = '$input_time[$i]'
				";
		$result = mysql_query($sql , $connect);

	}
	
	echo "데이터베이스에 저장했습니다!";
		
?>