<?php
require_once 'Config.php';

try{
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
}catch (PDOException $e){
	echo "error: ".e->getMessage();
	die();
}
$where = '';

if (!empty($_GET['login']) && !empty($_GET['password'])){
	$login = $_GET['login'];
	$pas = $_GET['password'];
	$where = sprintf("");
	$sql = sprintf("SELECT LOGIN, PASSWORD FROM user WHERE LOGIN LIKE '%s' AND PASSWORD LIKE '%s'", $login, $pas);
	$result = '{"response":[';
	$stmt = $db->query($sql);
	while($row = $stmt->fetch()){
		$result .= sprintf('{"login":"%s","password":"%s"}',$row['LOGIN'],$row['PASSWORD']);
	}
	$result = rtrim($result, ",");
	$result .= ']}';
	
	echo $result;
}

else{
	echo '["ERROR": {"text": "не передан логин/пароль"}]';
}
?>