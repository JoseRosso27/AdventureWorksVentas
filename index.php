<?php
//session_start();
$url="/adventureworksventas";

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?=$url?>/assets/dist/css/bootstrap.min.css">
    <title>Sistemas de control de almacen</title>
    <link rel="icon" type="image/x-icon" href="<?=$url?>/assets/favicon/logo-bicicleta.ico">
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
                AdventureWorks
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--<div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDeportes" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reporte
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbaReportes">
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/reportes/reporteInventario.php?stock=all">Inventario</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarMantenimiento" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mantenimiento
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarMantenimiento">
                            <li><a class="dropdown-item" href="<?=$url?>/crud/productos/read_product.php">Productos</a></li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/crud/ventas/read_sales.php">Ventas</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=$url?>/crud/inventario/read_inventory.php">Inventario</a>
                            </li>
                            <?=$administrator_interface?>
                        </ul>
                    </li>
                    
                </ul>
                -->
                <ul class="navbar-nav ms-auto me-xl-4 d-flex justify-content-center" style="min-width: 200px;">
                    <a class="btn btn-primary" href="login/login.php">Inciar sesion</a>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="height: 500px">
        <div class="h-100 d-flex justify-content-center align-items-center">
            <h1 class="text-center">¡Bienvenido al sistema!</h1>
        </div>
    </div>
    <script src="<?=$url?>/assets/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>