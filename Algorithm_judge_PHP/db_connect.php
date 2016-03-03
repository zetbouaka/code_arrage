<?
$connect = mysql_connect('localhost' , 'cs20101516' , 'cs20101516');
mysql_select_db("cs20101516", $connect);											//데이터베이스를 선택한다
if(!$connect) {
	echo "접속실패입니다.";
	exit;
}
?>