<?PHP
function line_print($str)
{
	$str = iconv("EUC-KR", "UTF-8", $str);
	echo $str;
}
?>