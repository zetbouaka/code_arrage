<?
header('Content-Type: text/html; charset=euc-kr');
?>
<?PHP
require "config.php";         //�������� �ε�

$id=$_POST["id"];
$pass1=$_POST["pass1"];
$pass2=$_POST["pass2"];
$nickname=$_POST["nickname"];
if(!$id) {
	echo "��й�ȣ�� �Է��ϼ���";
	exit;
} elseif(!$pass1) {
	echo "��й�ȣ�� �Է��ϼ���";
	exit;
} elseif($pass1 !== $pass2) {
	echo "��й�ȣ�� ��ġ���� �ʾƿ�.";
	exit;
} else {
	require "./db_connect.php";																		//mysql�� �����Ѵ�
	echo "�����ͺ��̽� ���ӿϷ�<p>";
	echo "���̵� : $id<p>�г��� : $nickname<p>";
	$sql = "select * from liveon_user where id='$id'";           //�Է��� �̸��� ���� �̸��� �˻��Ѵ�
	$result = mysql_query($sql , $connect);
	$idnum = mysql_num_rows($result);
	echo "���̵� �ߺ��˻�...<p>";
	if($idnum) {
		echo "�ߺ��� ���̵� �ֽ��ϴ�.";
		exit;
	} else {
		$sql = "insert into liveon_user (id,pass,name) values('$id', md5('$pass1'), '$nickname')";
		mysql_query($sql , $connect);
		echo "���ԿϷ�<p>";
		$file="data/".$id."_deck.txt";
		$handle=fopen($file,"w");
		fputs($handle,"0");
			echo ("
				<form name=main method=post action='./login.php'>
				<input type=submit name=submit value=���ư���>
				</form>
					");
	}
}
?>