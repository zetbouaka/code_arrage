<?PHP
	function SMS($namelist, $emaillist, $phonenumlist, $IDlist, $key, $n){
		require "./db_connect.php";	
		require "./sendmail.php";
		
		mysql_select_db("SMS", $connect);		
		
		for ($i=0;$i<$n;$i++){
			$input_ID = $IDlist[$i];
			#echo "$phonenumlist[$i]:";
			
#			$input_cont = 'http://125.209.196.29/new/DateMaking_process.php?phonenum='.$phonenumlist[$i].'&key='.$key;
			$input_cont = 'http://125.209.196.29/new/DateMaking_process.php?contactsID='.$input_ID.'&key='.$key;
			#$sql = "insert into em_tran (tran_phone, tran_callback, tran_status, tran_date, tran_msg , tran_type) values('".$phonenumlist[$i]."', '052-217-7302', '1', sysdate(), '".$input_cont."',4)";
			$sql = "insert into em_tran (tran_phone, tran_callback, tran_status, tran_date, tran_msg , tran_type) values
('".$phonenumlist[$i]."', '052-217-7302', '1', sysdate(), '".$input_cont."',4)";
#			echo $sql;
#			$sql = "insert into em_tran (tran_phone, tran_callback, tran_status, tran_date, tran_msg , tran_type) values
#('010-4844-7086', '052-217-7302', '1', sysdate(), 'http://125.209.196.29', 4)";
			$result = mysql_query($sql, $connect);
			$num = mysql_num_rows($result);
			if ($num==0){
				#echo "메세지 전송이 완료되지 않았습니다!";
				#exit;
			}
			
			sendMail("TEAMTALK", "zetbouaka@gmail.com", $namelist[$i], $emaillist[$i], "팀톡 메세지입니다", "링크 : $input_cont", 0);
		}
	}
	
?>