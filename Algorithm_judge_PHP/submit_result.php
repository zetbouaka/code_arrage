<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
	require "db_connect.php";
	require "config.php";         //세팅파일 로드
	session_start();
	if(empty($_SESSION['id']))
	{
		echo "로그인 해 주세요.<br>";
		echo "<a href=\"login.php\">로그인</a><br>";
		echo "<a href=\"join.php\">회원가입</a><br>";
		exit;
	}
	
	$problem_code = $_GET["pcode"];

	if(empty($problem_code)){
		echo "문제 이름이 지정되어 있지 않습니다.<br>";
		exit;
	}
	
	$id = $_SESSION['id'];

#	$num = get_autoinc("problem_queue") ; 

	$sql = "select max(no)+1 from problem_queue";
	$result = mysql_query($sql, $connect);
	$row = mysql_fetch_row($result);	

	$num = $row[0];

	$string = "code/". $num . "_". $id .".cpp";
	$newstring = "code/". $num . "_". $id;

	$handle = fopen($string, "w");

	$data = $_POST["src"];
	fputs($handle, $data);

	fclose($handle);

	$sql = "insert into problem_queue (userid, problem_code, source_link, score_result, process_time) values('$id', '$problem_code', '$string', -1, -1)";
	mysql_query($sql , $connect);

#	$handle = fopen($string, "r");

#	system("ls");
	system("g++ -o ".$newstring." ".$string." &"); 
	#echo("g++ -o ".$newstring." ".$string."<br>"); 
	//#채점 프로세스
	
	$point = 0;
	$flag = 0;
	for ($i=1;$i<=10;$i++){
		if ($i>=2 && $problem_code == "3nplus1"){
			break;
		}
		if ($flag==0){
			//echo("./".$newstring." < data/".$problem_code."/input".$i.".txt > code/".$num."_output.txt");
			//echo("<br>");
			system("./".$newstring." < data/".$problem_code."/input".$i.".txt > code/".$num."_output.txt &");
			#echo("diff data/".$problem_code."/output".$i.".txt code/".$num."_output.txt &");
			//echo("<br>");
			$arr = exec("diff data/".$problem_code."/output".$i.".txt code/".$num."_output.txt &");
			#system("diff data/".$problem_code."/output".$i.".txt code/".$num."_output.txt &");
			if ($arr[0] == NULL){
				echo ("TEST ". $i ." is OK<br><br><hr><br>");
				$point = $point + 10;
			}
			else
			{
				echo ("----------------------TEST ". $i ."---------------<br><br>");
				echo ("TEST_INPUT : <br>");
				system ("cat data/".$problem_code."/input".$i.".txt &");
				echo ("<hr>TEST_OUTPUT : <br>");
				system ("cat data/".$problem_code."/output".$i.".txt &");
				echo ("<br><hr>");
				echo ("YOUR_OUTPUT : <br>");
				system ("cat code/".$num."_output.txt &");
				echo ("<br>");
				$flag=1;
	#			exit;
			}
		}
	}
	
	echo ("<br>");
	if ($flag == 0){
		echo ("<b>CLEAR!</b><br><br>");
	}else{
		echo ("<b>NOT CLEAR...</b><br>");
		echo ("Check your output.<br><br>");
	}
	echo ("Your Score : {$point}<br>run-id = $num<br>");
	
	$sql = "update problem_queue SET score_result = {$point} where no = {$num}";
	mysql_query($sql , $connect);

	//user update

	$sql = "select * from user_data where userid='$id' and problem_code='$problem_code'" ;
	$result = mysql_query($sql, $connect);

	$num = mysql_num_rows($result);
	if($num==0)
	{
		$sql = "insert into user_data (userid, score, problem_code, submit_count) values ('$id', $point, '$problem_code', 1)";
		mysql_query($sql , $connect);		
	}
	else
	{
		$sql = "update user_data SET score = {$point} where userid = '$id' and problem_code='$problem_code' and score < {$point}";
		$sql = "update user_data SET submit_count = submit_count+1 where userid = '$id' and problem_code='$problem_code'";
		mysql_query($sql , $connect);
	}
	echo "<hr>";
	echo "<a href=\"problem.php\">Problem List</a><br>";
	echo "<a href=\"index.php\">Main</a><br>";
	echo "<a href=\"queue.php\">Queue</a><br>";

?>