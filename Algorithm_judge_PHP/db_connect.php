<?
$connect = mysql_connect('localhost' , 'cs20101516' , 'cs20101516');
mysql_select_db("cs20101516", $connect);											//�����ͺ��̽��� �����Ѵ�
if(!$connect) {
	echo "���ӽ����Դϴ�.";
	exit;
}
?>