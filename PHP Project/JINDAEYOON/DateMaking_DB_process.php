<?PHP
	//DB에서 GroupTitle과 timeFixTitle이 일치하는 시간잡기를 찾아
	//찾은 결과를 XML 데이터로 변환
	
	require "./db_connect.php";	
	require "./login.php";
	
	$select_groupTitle = $_POST['GroupTitle'];
	$select_timeFixTitle = $_POST['timeFixTitle'];
	$sql = "SELECT * FROM DateMaking WHERE GroupTitle = '$select_groupTitle' AND timeFixTitle = '$select_timeFixTitle'" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if($num==0){
		echo("일치하는 시간잡기가 존재하지 않습니다");
		exit;
	}
	
	$list = mysql_fetch_array($result);
	$input_grouptitle = $list[GroupTitle];
	$input_timefixtitle = $list[timeFIxTitle];
	$input_timefixoutline = $list[timeFixOutline];
	$input_eventtime = $list[eventTime];
	$input_choice = $list[choice];
	$input_key = $list[No];
	
	$sql = "SELECT * FROM DateMaking_contactsList WHERE No = '$input_key'";
	$result = mysql_query($sql, $connect);
	$i=0;
	while(1)
	{
		$list = mysql_fetch_array($result);
		if($list==NULL){
			break;
		}
		else
		{
			$input_user_name[$i] = $list[name];
			$input_user_email[$i] = $list[email];
			$input_user_phonenum[$i] = $list[phonenum];		
		}
	}
	
	$sql = "SELECT * FROM DateMaking_dateList WHERE No = '$input_key'";
	
	$result = mysql_query($sql, $connect);
	$j=0;
	while(1)
	{
		$list = mysql_fetch_array($result);
		if($list==NULL){
			break;
		}
		else
		{
			$input_date[$j] = $list[date];
		}
	}
	
	$sql = "SELECT * FROM DateMaking_timeList WHERE No = '$input_key'";
	
	$result = mysql_query($sql, $connect);
	$k=0;
	while(1)
	{
		$list = mysql_fetch_array($result);
		if($list==NULL){
			break;
		}
		else
		{
			$input_time[$k] = $list[time];
		}
	}
	
	require "example.php";
	
	$xml2 = new SimpleXMLElement($xmlstr);

	$xml2->addChild('grouptitle', $input_grouptitle);
	$xml2->addChild('timefixtitle', $input_timefixtitle);	
	$xml2->addChild('timefixoutline', $input_timefixoutline);	
	$xml2->addChild('contactslist');
	for ($i=0;$i<$n;$i++){
		$xml2->contactslist->addChild('name', $input_user_name[$i]);
		$xml2->contactslist->addChild('email', $input_user_email[$i]);
		$xml2->contactslist->addChild('phonenum', $input_user_phonenum[$i]);
		
	}
	$xml2->addChild('datelist');
	
	for ($i=0;$i<$m;$i++){
		$xml2->datelist->addChild('date', $input_date[$i]);
		
	}

	$xml2->addChild('timelist');
	
	for ($i=0;$i<$k;$i++){
		$xml2->timelist->addChild('time', $input_time[$i]);
		
	}
	
	$input_eventtime = (string) $xml -> eventtime;
	$input_choice = (integer) $xml -> choice;
	
	$xml2->addChild('eventtime', $input_eventtime);
	$xml2->addChild('chice', $input_choice);
	
#	$xml2->asXML('/var/www/html/new.xml');
	
	echo "<xmp>";
	echo $xml2->asXML();
	echo "</xmp>";
	
?>