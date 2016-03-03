<?
	echo "소유자 아이디 : {$_POST['groupID']}";
	
	require "./db_connect.php";																		
	
	$XML_STRING = $_POST['xmlfile'];
	#$XML_STRING="<xml><body><data><name>a</name><email>a</email><num>101020</num></data></body></xml>";
	$xml = new SimpleXMLElement($XML_STRING);
//	$xml = simplexml_load_file("test.xml");
	
	$input_userID = $_POST['groupID'];

	$n = count($xml->data);
	echo "$n<p>";
#	exit;	
	
	for ($i=0;$i<$n;$i++){
		$input_user_name[$i]=(string) $xml ->  data[$i] -> name;
		$input_user_email[$i]=(string) $xml -> data[$i] -> email;
		$input_user_phonenum[$i]=(string) $xml ->  data[$i] -> num;
	}
	#exit;
	
	//mysql에 접속한다
	echo "데이터 베이스 접속완료<p>";
	echo "데이터를 비웁니다...<p>";
	$sql = "DELETE FROM contactslist WHERE gruopID = $input_userID";
	$result = mysql_query($sql , $connect);
#	$idnum = mysql_num_rows($result);
	
	for($i=0;$i<$n;$i++){
		$contacts_name = $input_user_name[$i];
		$contacts_phonenum = $input_user_phonenum[$i];
		//$contacts_email = $input_user_email[$i];
		$contacts_email = "TEST";
		$contacts_own = $input_userID;
		echo "이름 : $contacts_name<p>휴대전화번호 : $contacts_phonenum<p>이메일 : $contacts_email<p>소유자 ID : $contacts_own<p>";
		$sql = "SELECT * FROM contactslist WHERE phonenum='$contacts_phonenum' AND groupiD = $contacts_own";
		//휴대전화번호와 소유자 ID가 같은 회원이 있는지 검사
		$result = mysql_query($sql , $connect);
		$idnum = mysql_num_rows($result);
		if($idnum){
			echo "이미 소유자의 연락처에 같은 휴대전화번호의 유저가 있습니다.";
			//exit;
		}else{
			$sql = "insert into contactslist SET groupID = $contacts_own , name = '$contacts_name' , email = '$contacts_email' , phonenum = '$contacts_phonenum'";
			mysql_query($sql, $connect);		
			echo "연락처 추가가 완료되었습니다<p>";
		}
	}
?>