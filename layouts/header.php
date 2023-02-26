<?php
//session_start();
$url="/epp";
if (!isset($_SESSION['user'])) {
    header("Location: $url/login.php");
    exit;
}
if ($_SESSION["user"]["is_new"] == 1) {
    header("Location: $url/change_password.php");
    exit;
}

$administrator_interface="";

if ($_SESSION["user"]["level"] === "1") {
    $administrator_interface = "<li><a class='dropdown-item' href='$url/user_group.php'>Grupos de acceso</a></li>
    <li><a class='dropdown-item' href='$url/user.php'>Usuarios</a></li>";
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=$url?>/assets/dist/css/bootstrap.min.css">
    <title>Sistemas de control de almacen</title>
    <link rel="icon" type="image/x-icon" href="<?=$url?>/assets/favicon/sedachimbote-logo.ico">
    <link rel="stylesheet" href="<?=$url?>/assets/fontawesome/css/all.min.css">
    <style>
        html,
        body {
            height: 100%;
        }
        .seleccionable {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light" style="background-color: #e3f2fd;">
    
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=$url?>/index.php">
                <img src="<?=$url?>/assets/brand/sedachimbote-logo.png" alt="" width="30" height="auto" class="d-inline-block align-text-top">
                AdventureWorks
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarMovimientos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Movimientos
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarMovimientos">
                            <li><a class="dropdown-item" href="<?=$url?>/movimientos/entrada_de_productos.php">Orden de compra</a></li>
                            <li><a class="dropdown-item" href="<?=$url?>/movimientos/salida_de_productos.php">Entrega de epp</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDeportes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reporte
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbaReportes">
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/reportes/reporteInventario.php?stock=all">Inventario</a>
                            </li>
                            <!--<li><a class="dropdown-item" href="<?=$url?>/reportes/sample.php">Salidas por unidad organica</a></li>-->
                            <li><a class="dropdown-item" href="<?=$url?>/reportes/reporteRenovacionPorFecha.php">Renovacion de productos</a></li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/reportes/reportePorFecha.php">Ingreso o salida de productos por fecha de entrega</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/reportes/reportePorTrabajador.php">Entrega de productos por trabajador</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/reportes/reporteStockPorDebajoDelMinimo.php">Productos por debajo del stock minimo</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarMantenimiento" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mantenimiento
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarMantenimiento">
                            <!--<li><a class="dropdown-item" href="<?=$url?>inventory.php">Existencias disponibles</a></li>
                            <li><a class="dropdown-item" href="<?=$url?>employee.php">Salida de productos</a></li>-->
                            <li><a class="dropdown-item" href="<?=$url?>/product.php">Producto</a></li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/department.php">Unidad organica</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/crud/read/inventory.php">Inventario</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/unit_measure.php">Unidades de medida</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/employee.php">Trabajador</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/order_purchase.php">Ordenes de compra</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/employee_delivery.php">Entrega de productos</a>
                            </li>
                            <?=$administrator_interface?>
                        </ul>
                    </li>
                    
                </ul>
                <ul class="navbar-nav ms-auto me-xl-4 border" style="min-width: 200px;">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?=$url?>#" id="navbarProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?=$url?>/assets/profile/user.png" style="width: 30px;height: auto;"><?= $_SESSION["user"]["username"] ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarProfile">
                            <li><a class="dropdown-item" href="<?=$url?>/change_password.php">Cambiar contraseña</a></li>
                            <li class="dropdown-divider"></li>
                            <!--<li><a class="dropdown-item" href="<?=$url?>profile.php">Perfil</a></li>
                            <li><a class="dropdown-item" href="<?=$url?>settings.php">Ajustes</a></li>
                            <li class="dropdown-divider"></li>-->
                            <li><a class="dropdown-item" href="<?=$url?>/logout.php">Cerrar Sesión</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>