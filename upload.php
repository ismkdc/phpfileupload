<?php

// A list of permitted file extensions
$allowed = array('docx');

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"error"}';
		exit;
	}

	if(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name'])){
$dbhost = "localhost";
$dbname = "pdo";
$dbusername = "root";
$dbpassword = "";

$link = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);

$statement = $link->prepare("INSERT INTO uploads(name, downloadname ,date)
    VALUES(:name,:downloadname, :date)");
$statement->execute(array(
    "name" => $_FILES['upl']['name'],
	"downloadname" => substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5).'.docx',
    "date" => date("Y-m-d H:i:s")
));
		echo '{"status":"success"}';
		
		exit;
	}
}

echo '{"status":"error"}';
exit;