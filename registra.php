<?php
require_once 'Config.php';

try{
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
}catch (PDOException $e){
	echo '{"error": {"text": "'.e->getMessage().'"}}';
	die();
}
$where = '';

if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email'])){
	$login = $_POST['login'];
	$pas = $_POST['password'];
	$email = $_POST['email'];
	$sql = sprintf('INSERT INTO `user` (`LOGIN`,`PASSWORD`,`EMAIL`) VALUES (\'%s\',\'%s\',\'%s\')', $login, $pas, $email);
	
	
	$count = $db->exec($sql);
	if ($count === 1) {
		echo '{"response":{"text":"вы зарегистрировались"}}';
	}
	else{
		echo '{"response":{"text":"вы не зарегистрировались"}}';
	}
}
else{
	echo '{"response":{"text":"не переданы логин/пороль/почта"}}';
}
?>