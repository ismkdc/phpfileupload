<?php
$dbhost = "localhost";
$dbname = "pdo";
$dbusername = "root";
$dbpassword = "";
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
$sql = "SELECT username, password FROM users WHERE username=? AND 
  password=? ";
    $query = $conn->prepare($sql);
    $query->execute(array($_POST["username"],$_POST["password"]));

    if($query->rowCount() >= 1) {
		session_start();
		$_SESSION["kontrol"] = '1';
		header("Location: list.php");
		die();
	}
	echo "Giriþ hatalý";
	die();

?>