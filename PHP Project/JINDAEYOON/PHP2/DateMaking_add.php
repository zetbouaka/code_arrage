<?PHP
	#echo "일정잡기 ID : ?";
	
	require "./db_connect.php";	
	require "./DateMaking_SMS_send.php";
	require "./Phonenum_to_userID.php";
	
	#require "./login.php";
	
	#파일 업로드
	

	$uploaddir = '/var/www/html/upload/';
	$uploadfile = $uploaddir.basename($_FILES['imagefile']['name']);

	if (move_uploaded_file($_FILES['imagefile']['tmp_name'], $uploadfile)) {
	    #echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
	} else {
	    #print "파일 업로드 공격의 가능성이 있습니다!\n";
		echo "error";
		exit;
	}
	
#	echo "$uploadfile";
	
	$XML_STRING = $_POST['xmlfile'];
	$xml = new SimpleXMLElement($XML_STRING);
//	$xml = simplexml_load_file("test.xml");
	
	$input_groupID = $_POST['groupID'];
	$input_meetingtitle = (string) $xml -> meetingTitle;
	$input_meetingoutline = (string) $xml -> meetingOutline;
	
	$n = count($xml->contactsList->data);
	
	for ($i=0;$i<$n;$i++){
		$input_user_name[$i]=(string) $xml -> contactsList -> data[$i] -> name;
		$input_user_email[$i]=(string) $xml -> contactsList -> data[$i] -> email;
		$input_user_phonenum[$i]=(string) $xml -> contactsList -> data[$i] -> phoneNum;
		$input_IDlist[$i] = Phonenum_to_userID($input_user_phonenum[$i]);
		#$input_IDlist[$i]= 0;
	}
	
	$m = count($xml -> date);
	
	for ($i=0;$i<$m;$i++){
		$input_date[$i] = (string) $xml -> date[$i];
	}
	
	$k = count($xml -> time);
	
	for ($i=0;$i<$k;$i++)
	{
		$input_time[$i] = (string) $xml -> time[$i];
	}

	$input_eventtime = (string) $xml -> eventTime;
	$input_choice = (integer) $xml -> choice;
	
	$sql = "SELECT * FROM DateMaking WHERE meetingTitle = '$input_meetingtitle'";
	//같은 이름의 일정잡기가 있는지 조사
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	if($idnum){
		echo "이미 같은 이름의 일정잡기 리스트가 있습니다.";
		exit;
	}else{
		$upf = basename($_FILES['imagefile']['name']);
		$sql = "INSERT INTO DateMaking SET groupID = $input_groupID , meetingTitle = '$input_meetingtitle' , meetingOutline = '$input_meetingoutline', imagename = '$upf'";
		mysql_query($sql, $connect);

		$sql = "SELECT * FROM DateMaking WHERE meetingTitle = '$input_meetingtitle'";
		//같은 이름의 일정잡기가 있는지 조사
		$result = mysql_query($sql , $connect);
		$idnum = mysql_num_rows($result);
		if($idnum==0){
			#echo "일정잡기 추가가 완료되지 않았습니다!";
			exit;
		}
		#echo "일정잡기가 추가되었습니다!";
		$list = mysql_fetch_array($result);
		$key = (int)$list[ID];
		#echo "이 일정의 연락처에게 SMS를 보내는 중입니다...<p>";
		
		SMS($input_user_name, $input_user_email, $input_user_phonenum, $input_IDlist, $key, $n);
		
		#echo "SMS 전송이 완료되었습니다!";
		echo "$key";
	}	
?>