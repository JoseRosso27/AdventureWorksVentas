<?php
require_once "../../conexion/pdo.php";
session_start();
$url = "/adventureworksventas";
if (!isset($_SESSION['user'])) {
	header("Location: $url/login.php");
	exit;
}

$sql="SELECT pi.ProductID, p.Name AS ProductName, pi.Shelf, pi.LocationID, l.Name 
AS LocationName, pi.Quantity FROM production.productinventory pi INNER JOIN production.product p ON pi.ProductID = p.ProductID 
INNER JOIN production.location l ON pi.LocationID = l.LocationID WHERE pi.ProductID=:pid and pi.LocationID=:lid and pi.Shelf=:s";
$query = $pdo->prepare($sql);
$query->execute(array(':pid'=>$_GET['id'],':lid'=>$_GET['location_id'],':s'=>$_GET['shelf_id']));
$product = $query->fetch();


$sql = "SELECT * FROM production.productinventory pi where pi.ProductID=:pid and pi.LocationID=:lid and pi.Shelf=:s";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':pid'=>$_GET['id'],':lid'=>$_GET['location_id'],':s'=>$_GET['shelf_id']));
$inventory = $stmt->fetch(PDO::FETCH_ASSOC);
if ($inventory==false) {
    $_SESSION["edit_error"] = "Id de url no esta bien";
    header("Location: $url/crud/inventario/read_inventory.php");
    exit;
}
//añadir validacion para cuando se entregue un mal id en la cabecera se vuelva al empleado por defecto
//fragmento de insercion
if (isset($_POST["edit"])) {
	try {
		$pdo->beginTransaction();
		$product_id = $_POST['product_id'];
		$shelf_id = $_POST['shelf_id'];
		$location_id = $_POST['location_id'];
		$quantity = $_POST['quantity'];
		$sql = "UPDATE production.productinventory SET Shelf = :ns, LocationID = :nlid, Quantity = :nq WHERE ProductID=:pid and LocationID=:lid and Shelf=:s";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(':pid'=>$_GET['id'],':lid'=>$_GET['location_id'],':s'=>$_GET['shelf_id'],
		':ns'=>$shelf_id,':nlid'=>$location_id,':nq'=>$quantity,
		));
		$pdo->commit();
	} catch (Exception $e) {
		$pdo->rollBack();
		$_SESSION["edit_error"] = $e;//"No se pudo agregar el nuevo ingreso";
		header("Location: $url/crud/inventario/read_inventory.php");
		exit;
	}
	$_SESSION["edit_successful"] = "El detalle de inventario se actualizo adecuadamente";
	header("Location: $url/crud/inventario/read_inventory.php");
	exit;
}

$query = $pdo->query("SELECT ProductID, Name FROM production.product");
$products = $query->fetchAll();

$query = $pdo->query("SELECT LocationID, Name FROM production.location");
$locations = $query->fetchAll();

$letras = range('A', 'Z');
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
			<form method="post" style="max-width: 600px;">
            		<div class="mb-4 text-center">
                    	<h5>Editar detalle de inventario</h5>
					</div>
					<div>
					<label class="form-label">Producto:</label>
					<select class="form-select" name="product_id" disabled>
						<?php foreach ($products as $p) { ?>
						<option value="<?php echo $p['ProductID']; ?>" <?php if ($p['ProductID'] == $product['ProductID']) { echo 'selected'; } ?>><?php echo $p['Name']; ?></option>
						<?php } ?>
					</select>
					</div>
					<div>
						<label class="form-label">Estante:</label>
						<select class="form-select" name="shelf_id">
						<?php foreach ($letras as $s) { ?>
						<option value="<?php echo $s; ?>" <?php if ($s == $inventory['Shelf']) { echo 'selected'; } ?>><?php echo $s; ?></option>
						<?php } ?>
						</select>
					</div>
					<div>
						<label class="form-label">Ubicación:</label>
						<select class="form-select" name="location_id">
							<?php foreach ($locations as $l) { ?>
							<option value="<?php echo $l['LocationID']; ?>" <?php if ($l['LocationID'] == $product['LocationID']) { echo 'selected'; } ?>><?php echo $l['Name']; ?></option>
							<?php } ?>
						</select>
					</div>
					<div>
						<label class="form-label">Cantidad:</label>
						<input class="form-control" type="number" name="quantity" value="<?php echo $product['Quantity']; ?>" required>
					</div>
					<button type="submit" class="w-100 btn btn-danger mb-3" name="edit" value="edit">Confirmar</button>
					<a class="w-100 btn btn-secondary" href="read_inventory.php">Cancelar</a>
            </form>
			</main>
		</div>
	</div>
	<script src="<?=$url?>/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>