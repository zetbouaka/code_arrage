<?PHP
	//DB에서 GroupTitle과 timeFixTitle이 일치하는 일정잡기를 찾아
	//찾은 결과를 XML 데이터로 변환
	
	require "./db_connect.php";	
	require "./login.php";

	$connect2 = mysql_connect('localhost' , 'root' , 'unist9729');
	#mysql_select_db("SMS", $connect2);	
		
	$sql = "SELECT * FROM DateMaking" ;
	
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	$j = 0;
	
	if($num==0){
		echo("큐에 시간잡기가 존재하지 않습니다");
		exit;
	}
	while(1){
		$list = mysql_fetch_array($result);
		if ($list==NULL)
			break;
		$input_key = $list[No];		
		$sql = "SELECT * FROM DateMaking_contactsList WHERE No = '$input_key'";
		$result2 = mysql_query($sql, $connect);
		$i=0;
		while(1)
		{
			$list2 = mysql_fetch_array($result2);
			if($list2==NULL){
				break;
			}
			else
			{
				$input_user_name[$j][$i] = $list2[name];
				$input_user_email[$j][$i] = $list2[email];
				$input_user_phonenum[$j][$i] = $list2[phonenum];		
				$input_cont[$j][$i] = 'http://125.209.196.29/DateMaking_process.php?phonenum='.$input_user_phonenum[$j][$i].'&key='.$input_key;
				#echo $input_cont[$j][$i];
				#$sql_result = mysql_query($sql, $connect2);
				$i++;
				
			}
		}
		$m[$j]=$i;
		$j++;
		
	}

#	$sql = "UPDATE DateMaking SET send = 1 WHERE send = 0" ;
	$result = mysql_query($sql, $connect);
	$num = mysql_num_rows($result);
	
	mysql_select_db("SMS", $connect);	
	
	#echo $m[0];
	
	for ($k1=0;$k1<$j;$k1++)
	{
		for ($k2=0;$k2<$m[$k1];$k2++){
			$sql = "insert into em_tran (tran_phone, tran_callback, tran_status, tran_date, tran_msg , tran_type) values
('".$input_user_phonenum[$k1][$k2]."', '052-217-7302', '1', sysdate(), '".$input_cont[$k1][$k2]."',4)";
			echo $sql;
			$result = mysql_query($sql, $connect);
		}
	}
	if ($num==0){
		echo "메세지 전송이 완료되었습니다!";
	}
?>