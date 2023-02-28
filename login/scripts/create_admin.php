<?php
require_once "../../conexion/pdo.php";
$salt = 'ZsadZZbnddf45sacxzxasdfds*-sad-*';
$unencrypted_password="admin1234".$salt;
//Crear usuario
$encrypted_password=hash("md5",$unencrypted_password);
$sql="INSERT INTO [user]([username], [password], [is_new], [is_admin], [level]) VALUES ('rosso','$encrypted_password','1','1','1')";
$stmt=$pdo->query($sql);
?>