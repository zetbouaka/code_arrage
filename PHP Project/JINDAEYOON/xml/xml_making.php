<?PHP
	$xml = simplexml_load_file("test.xml");
	
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
	
	require "example.php";
	
	$xml2 = new SimpleXMLElement($xmlstr);

	$xml2->addChild('groupTitle', $input_grouptitle);
	$xml2->addChild('timeFixTitle', $input_timefixtitle);	
	$xml2->addChild('timeFixOutline', $input_timefixoutline);	
	$xml2->addChild('contactsList');
	for ($i=0;$i<$n;$i++){
		$xml2->contactsList->addChild('data');
		$xml2->contactsList->data[$i]->addChild('name', $input_user_name[$i]);
		$xml2->contactsList->data[$i]->addChild('email', $input_user_email[$i]);
		$xml2->contactsList->data[$i]->addChild('phoneNum', $input_user_phonenum[$i]);
		
	}
	$xml2->addChild('dateList');
	
	for ($i=0;$i<$m;$i++){
		$xml2->dateList->addChild('date', $input_date[$i]);
		
	}

	$xml2->addChild('timeList');
	
	for ($i=0;$i<$k;$i++){
		$xml2->timeList->addChild('time', $input_time[$i]);
		
	}
	
	$input_eventtime = (string) $xml -> eventTime;
	$input_choice = (integer) $xml -> choice;
	
	$xml2->addChild('eventTime', $input_eventtime);
	$xml2->addChild('choice', $input_choice);
	
	$xml2->asXML('/var/www/html/new.xml');
	
	echo "<xmp>";
	echo $xml2->asXML();
	echo "</xmp><br>OK2!";

?>