<?php
require_once "../../conexion/pdo.php";
session_start();
$url = "/adventureworksventas";
if (!isset($_SESSION['user'])) {
	header("Location: $url/login.php");
	exit;
}
//añadir validacion para cuando se entregue un mal id en la cabecera se vuelva al empleado por defecto
//fragmento de insercion
if (isset($_POST["edit"])) {
	try {
		$pdo->beginTransaction();
        $salt = 'ZsadZZbnddf45sacxzxasdfds*-sad-*';
        $unencrypted_password=$_POST["password"].$salt;
        //Crear usuario
        $encrypted_password=hash("md5",$unencrypted_password);
		$username = $_POST['username'];
		$password = $encrypted_password;
		$level = $_POST['level'];
		$is_new = 1;
        $is_admin = $_POST['level']=="1"?"1":"0";
		$sql = "UPDATE [user] SET
        [username]=:nu
        ,[password]=:p
        ,[level]=:l
        ,[is_new]=:in
        ,[is_admin]=:ia WHERE username=:u";
		$stmt=$pdo->prepare($sql);
		$stmt->execute(array(':u'=>$username,':nu'=>$_GET["id"],':p'=>$password,':l'=>$level,
		':in'=>$is_new,':ia'=>$is_admin,
		));
		$pdo->commit();
	} catch (Exception $e) {
		$pdo->rollBack();
		$_SESSION["edit_error"] = $e;//"No se pudo agregar el nuevo ingreso";
		header("Location: $url/crud/usuarios/read_user.php");
		exit;
	}
	$_SESSION["edit_successful"] = "El detalle de usuarios se actualizo adecuadamente";
	header("Location: $url/crud/usuarios/read_user.php");
	exit;
}
$sql="SELECT * FROM [user] WHERE username=:u";
$stmt=$pdo->prepare($sql);
$stmt->execute(array(':u'=>$_GET["id"]));
$user=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="<?=$url?>/assets/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=$url?>/assets/fontawesome/css/all.min.css">
	<title>Sistema de control de usuarios</title>
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
			<form method="post" style="max-width: 600px;">
            		<div class="mb-4 text-center">
                    	<h5>Crear un nuevo usuario</h5>
					</div>
					<div class="mb-3">
						<div class="row">
							<div class="col">
								<label for="username" class="form-label">Nombre de usuario</label>
								<input
									type="text"
									class="form-control"
									id="username"
									name="username"
									autocomplete="off"
									required
                                    value="<?=$user["username"]?>"
								>
							</div>
							<div class="col">
								<label for="password" class="form-label">Contraseña</label>
								<div class="input-group mb-3">
								<span class="input-group-text btn btn-primary" onClick="getPassword();"><i class="fa-solid fa-arrows-rotate"></i></span>
								<input
									type="text"
									class="form-control"
									id="password"
									name="password"
									autocomplete="off"
									readonly="true"
									required
								>
								</div>
							</div>
						</div>
					</div>
					<div class="mb-3">
						<div class="col">
							<label class="form-label">Nivel de acceso</label>
							<select class="form-select" name="level" required>
								<option value="" selected disabled>Selecciona una opcion</option>
								<option value="1" <?=$user["level"]==1?"selected":""?>>Administrador</option>
                                <option value="2" <?=$user["level"]==2?"selected":""?>>Operario</option>
							</select>
						</div>
					</div>
					<button type="submit" class="w-100 btn btn-danger mb-3" name="edit" value="edit">Confirmar</button>
					<a class="w-100 btn btn-secondary" href="read_user.php">Cancelar</a>
            </form>
			</main>
		</div>
	</div>
	<script>
        function getPassword(){
		document.getElementById('password').value = autoCreate(12);
        }

        function autoCreate(plength){
            var chars = "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            var password = '';	
            for(i=0; i<plength; i++){
            password+=chars.charAt(Math.floor(Math.random()*chars.length));
            }
            
            return password;
        }
		getPassword();
    </script>
	<script src="<?=$url?>/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>