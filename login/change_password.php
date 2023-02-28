<?php
require_once "../conexion/pdo.php";
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: login.php");
}
$url = "/epp";
$salt = 'ZsadZZbnddf45sacxzxasdfds*-sad-*';

if (isset($_POST["password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_new_password"])) {
	if ($_POST["new_password"]===$_POST["confirm_new_password"]) {
		if ($_POST["password"]===$_POST["new_password"]) {
			$_SESSION["error_new_password"] = "La contraseña nueva no puede ser la contraseña actual";
			header("Location: change_password.php");
			exit;
		} else {
			$sql = "SELECT [password] FROM [user] where [username]=:un";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(':un' => $_SESSION["user"]["username"]));
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			$password = hash("md5", $_POST["password"] . $salt);
			if ($password===$user["password"]) {
				$new_password = hash("md5", $_POST["new_password"] . $salt);
				if ($_SESSION["user"]["is_new"]==1) {
					$sql="UPDATE [user] SET [password]=:p, [is_new]=0 WHERE [username]=:un";
					$_SESSION["user"]["is_new"]=0;
				} else {
					$sql="UPDATE [user] SET [password]=:p WHERE [username]=:un";
				}
				$stmt = $pdo->prepare($sql);
				$stmt->execute(array(":un" => $_SESSION["user"]["username"],":p" => $new_password));
				header("Location: successful_password_change.php");
				exit;
			} else {
				$_SESSION["error_password"] = "Contraseña incorrecta";
				header("Location: change_password.php");
				exit;
			}
		}
	} else {
		$_SESSION["error_new_password"] = "Las contraseñas no coinciden";
		header("Location: change_password.php");
		exit;
	}
}

#Definicion de errores
$error_password = isset($_SESSION["error_password"]) ? $_SESSION["error_password"] : "";
$error_new_password = isset($_SESSION["error_new_password"]) ? $_SESSION["error_new_password"] : "";
#Clases de validacion
$password_validation_class =  $error_password==="" ? "" : "is-invalid";
$new_password_validation_class =  $error_new_password==="" ? "" : "is-invalid";

unset($_SESSION["error_password"]);
unset($_SESSION["error_new_password"]);
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?=$url?>/assets/dist/css/bootstrap.min.css">
	<title>Sistema de control de inventario</title>
	<style>
		html,
		body {
			height: 100%;
		}
		body {
			display: flex;
			align-items: center;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: #f5f5f5;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="mt-auto d-flex justify-content-center align-items-center">
			<main>
				<form method="post" style="width: 350px;">
					<h1 class="text-center">Cambiar contraseña</h1>
                    <div class="mb-3">
						<label for="password" class="form-label">Contraseña actual</label>
						<input
							type="password"
							class="form-control <?= $password_validation_class ?>"
							id="password"
							name="password"
							required
						>
						<?php
						if ($password_validation_class!=="") {
							echo "<div class=\"invalid-feedback\">$error_password</div>";
						}
						?>
					</div>
                    <div class="mb-3">
						<label for="new_password" class="form-label">Nueva contraseña</label>
						<input
							type="password"
							class="form-control <?= $new_password_validation_class ?>"
							id="new_password"
							name="new_password"
							required
						>
						<?php
						if ($new_password_validation_class!=="") {
							echo "<div class=\"invalid-feedback\">$error_new_password</div>";
						}
						?>
					</div>
                    <div class="mb-3">
						<label for="confirm_new_password" class="form-label">Confirma la nueva contraseña</label>
						<input
							type="password"
							class="form-control <?= $new_password_validation_class ?>"
							id="confirm_new_password"
							name="confirm_new_password"
							required
						>
						<?php
						if ($new_password_validation_class!=="") {
							echo "<div class=\"invalid-feedback\">$error_new_password</div>";
						}
						?>
					</div>
					<button type="submit" class="w-100 btn btn-primary">Cambiar</button>
					<!--<a class="w-100 btn btn-secondary" href="<?=$url?>/index.php">Regresar</a>-->
				</form>
			</main>
		</div>
	</div>
	<script src="<?=$url?>/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>