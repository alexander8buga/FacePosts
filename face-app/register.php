<?php
require ('sql_connect.php');
if (isset($_POST['submit'])) {
	$fname=mysql_escape_string($_POST['name']);
if (!$_POST['name'])
{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('You did not commplete all required fields')
		window.location.href='register.html'
		</SCRIPT>");
	exit();
}

$sql=mysql_query("INSERT INTO customer VALUES ('', '$fname', 0, 0, 0, 0, 0, 0, 0, 0, 0) ");
if (mysql_num_rows($sql)  == 0)
{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.alert('Registration Success!')
		window.location.href='signin.html'
		</SCRIPT>");
exit();

} 
}
?>