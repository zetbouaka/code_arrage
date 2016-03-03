<?PHP

	//xml 데이터를 받아서
	//DB에 저장
	require "./db_connect.php";	
	#require "./login.php";
	
	$XML_STRING = $_POST['xmlfile'];
	$xml = new SimpleXMLElement($XML_STRING);
//	$xml = simplexml_load_file("test.xml");
	
	$input_grouptitle = (string) $xml -> groupTitle;
	$input_timefixtitle = (string) $xml -> timeFixTitle;
	$input_timefixoutline = (string) $xml -> timeFixOutline;
	
	$n = count($xml->contactsList->data);
	
	for ($i=0;$i<$n;$i++){
		$input_user_name[$i]=(string) $xml -> contactsList -> data[$i] -> name;
		$input_user_email[$i]=(string) $xml -> contactsList -> data[$i] -> email;
		$input_user_phonenum[$i]=(string) $xml -> contactsList -> data[$i] -> phoneNum;
	}
	
	$m = count($xml -> dateList-> date);
	
	for ($i=0;$i<$m;$i++){
		$input_date[$i] = (string) $xml -> dateList -> date[$i];
	}
	
	$k = count($xml -> timeList-> time);
	
	for ($i=0;$i<$k;$i++)
	{
		$input_time[$i] = (string) $xml -> timeList -> time[$i];
	}

	$input_eventtime = (string) $xml -> eventTime;
	$input_choice = (integer) $xml -> choice;
	
	echo "{$n}<br>{$m}<br>{$k}<br>";	
	echo "OK!";
	
	$sql = 
	"INSERT INTO DateMaking SET GroupTitle = '$input_grouptitle',
	timeFIxTitle = '$input_timefixtitle',
	timeFixOutline = '$input_timefixoutline',
	eventTime = '$input_eventtime',
	choice = '$input_choice';
	";
	$sql_result = mysql_query($sql, $connect);
	$sql = "SELECT * FROM DateMaking WHERE timeFixTitle = '$input_timefixtitle'";
	$sql_result = mysql_query($sql, $connect);
		
	$list = mysql_fetch_array($sql_result);

	$TEMP_NUM = (int) $list[No];

	for ($i=0;$i<$n;$i++){
		$sql = "INSERT INTO DateMaking_contactsList 
				SET 
				No = '$TEMP_NUM',
				name = '$input_user_name[$i]',
				email = '$input_user_email[$i]',
				phonenum = '$input_user_phonenum[$i]'
				";
		$result = mysql_query($sql , $connect);
	}
	
	for ($i=0;$i<$m;$i++){
		$sql = "INSERT INTO DateMaking_dateList 
				SET 
				No = '$TEMP_NUM',
				date = '$input_date[$i]'
				";
		$result = mysql_query($sql , $connect);

	}
	
	for ($i=0;$i<$k;$i++){
		$sql = "INSERT INTO DateMaking_timeList 
				SET 
				No = '$TEMP_NUM',
				time = '$input_time[$i]'
				";
		$result = mysql_query($sql , $connect);

	}
	
	echo "데이터베이스에 저장했습니다!";
		
?>