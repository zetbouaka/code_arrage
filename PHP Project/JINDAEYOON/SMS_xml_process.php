<?PHP
	require "./db_connect.php";	
	#require "./login.php";
	
	$XML_STRING = $_POST['xmlfile'];
	$xml = new SimpleXMLElement($XML_STRING);
	
	$input_title = $xml -> messageTitle;
	$input_cont = $xml -> messageContext;

	mysql_select_db("SMS", $connect);	
	
	if(!$connect) {
		echo "접속실패입니다.";
		exit;
	}
	
	$n = count($xml->contactsList->data);
	
	for ($i=0;$i<$n;$i++){
		$input_user_name[$i]=(string) $xml -> contactsList -> data[$i] -> name;
		$input_user_email[$i]=(string) $xml -> contactsList -> data[$i] -> email;
		$input_user_phonenum[$i]=(string) $xml -> contactsList -> data[$i] -> phoneNum;
		$sql = "
	Insert into em_tran
(tran_phone, tran_callback, tran_status, tran_date, tran_msg , tran_type) values
('$input_user_phonenum[$i]', '010-000-0000', '1', sysdate(), '$input_cont' ,4)";
		echo "$input_cont<br>";
		$sql_result = mysql_query($sql, $connect);
	}
	
	echo "전송이 완료되었습니다!";

?>