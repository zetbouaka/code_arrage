<?PHP
	require "./db_connect.php";	
	#require "./login.php";
	
	#$input_meetingtitle = $_POST['meetingTitle'];
	#$input_timefixtitle = "TFT";
#	echo "<xmp>";
	$input_key = (integer) $_POST['DM_ID'];
	
	
	$sql = "SELECT * FROM DateMaking_response WHERE DM_ID = '$input_key' ORDER BY time";
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	if ($num==0){
		echo "nothing data";
	}else
	{
		echo "<?xml version=\"1.0\" encoding=\"utf-8\"?><body>";
		$i=0;
		while(1)
		{
			$list = mysql_fetch_array($result);
			if($list==NULL){
				break;
			}
			else
			{
				$input_user_contactsID[$i] = $list[contactsID];
				$input_user_phonenum[$i] = $list[phonenum];
				#$input_user_phonenum[$i]= "123";
				$input_user_response[$i] = $list[response];
				$input_user_time[$i] = $list[time];
				$i++;
			}
		}
		for ($j=0;$j<$i;$j++){
			$sql = "SELECT * FROM contactslist WHERE ID = $input_user_contactsID[$j]";
			$result2 = mysql_query($sql, $connect);
			$list2 = mysql_fetch_array($result2);
			$input_user_name[$j] = $list2[name];
		}

		for ($j=0;$j<$i;$j++){
			echo "<data><contactsID>$input_user_contactsID[$j]</contactsID><name>$input_user_name[$j]</name><phone>$input_user_phoneID[$j]</phone><response>$input_user_response[$j]</response><time>$input_user_time[$j]</time></data>";
		}
	}
	echo "</body>";
#	echo "</xmp>";
?>