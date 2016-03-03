<?PHP
	$xml = simplexml_load_file('http://125.209.196.29/test.xml');
	
	echo "<xmp>";
	echo $xml->asXML();
	echo "</xmp>";
	exit;
	
	$input_grouptitle = (string) $xml -> grouptitle;
	$input_timefixtitle = (string) $xml -> timefixtitle;
	$input_timefixoutline = (string) $xml -> timefixoutline;
	
	$n = count($xml->contactslist->data);
	
	for ($i=0;$i<$n;$i++){
		$input_user_name[$i]=(string) $xml -> contactslist -> data[$i] -> name;
		$input_user_email[$i]=(string) $xml -> contactslist -> data[$i] -> email;
		$input_user_phonenum[$i]=(string) $xml -> contactslist -> data[$i] -> phonenum;
	}
	
	$m = count($xml -> datelist);
	
	for ($i=0;$i<$m;$i++){
		$input_date[$i] = (string) $xml -> datelist -> date[$i];
	}
	
	$k = count($xml -> timelist);
	
	for ($i=0;$i<$k;$i++)
	{
		$input_time[$i] = (string) $xml -> timelist -> time[$i];
	}

	$input_eventtime = (string) $xml -> eventtime;
	$input_choice = (integer) $xml -> choice;
	
	echo "{$input_user_name[0]}<br>";	
	echo "OK!";
	
	
?>