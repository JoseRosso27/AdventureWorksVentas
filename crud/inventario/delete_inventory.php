<?php
require_once "../../conexion/pdo.php";
session_start();
if (!isset($_SESSION['user'])) {
	header("Location: ../../login/login.php");
    return;
}
$url = "/adventureworksventas";
//fragmento de eliminacion
if (isset($_POST["delete"])) {
    try {
		$pdo->beginTransaction();
		$sql = "DELETE FROM production.productinventory WHERE ProductID=:pid and LocationID=:lid and Shelf=:s";
		$stmt = $pdo->prepare($sql);
        $stmt->execute(array(':pid'=>$_GET['id'],':lid'=>$_GET['location_id'],':s'=>$_GET['shelf_id']));
		$pdo->commit();
    } catch (Exception $e) {
		$pdo->rollBack();
        $_SESSION["delete_error"]="Error al eliminar el producto del inventario".$e;
        header("Location: read_inventory.php");
        return;
    }
    $_SESSION["delete_successful"]="El registro se elimino exitosamente";
    header("Location: read_inventory.php");
    return;
}
$sql = "SELECT * FROM production.productinventory pi where pi.ProductID=:pid and pi.LocationID=:lid and pi.Shelf=:s";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':pid'=>$_GET['id'],':lid'=>$_GET['location_id'],':s'=>$_GET['shelf_id']));
$inventory = $stmt->fetch(PDO::FETCH_ASSOC);
if ($inventory==false) {
    $_SESSION["edit_error"] = "Id de url no esta bien";
    header("Location: $url/crud/inventario/read_inventory.php");
    exit;
}

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
				<form method="post">
                    <div class="mb-4 text-center">
                        <h2>¿Esta seguro de realizar la accion?</h2>
					</div>
					<div class="mb-4 text-center text-danger">
                        <h6>
						<?php
							echo isset($_SESSION["delete_error"])? $_SESSION["delete_error"] : "";
							unset($_SESSION["delete_error"])
						?>
						</h6>
					</div>
					<button type="submit" class="w-100 btn btn-danger mb-3" name="delete" value="delete">Confirmar</button>
					<a class="w-100 btn btn-secondary" href="read_inventory.php">Cancelar</a>
				</form>
			</main>
		</div>
	</div>
	<script src="<?=$url?>/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>