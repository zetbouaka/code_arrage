<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?
	$string = $_GET["pcode"];
	$string = "problem/" . $string . "/problem";
	$pcode = $_GET["pcode"];

	$handle = fopen($string, "r");
 
	if ($handle) {
		while (!feof($handle)) {
			$buffer = fgets($handle, 4096);
			echo $buffer;
		}
		fclose($handle);          

		echo "<hr>";
		echo "<a href=\"problem.php\">Problem List</a><br>";
		echo "<a href=\"submit.php?pcode={$pcode}\">Submit</a><br>";
	} else {
		echo "존재하지 않은 문제 파일입니다.";
		fclose($handle);
	} 

?>