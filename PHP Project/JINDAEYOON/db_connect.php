<?
$connect = mysql_connect('localhost' , 'root' , 'unist9729');
mysql_select_db("DB", $connect);											//데이터베이스를 선택한다
if(!$connect) {
	echo "접속실패입니다.";
	exit;
}

?>