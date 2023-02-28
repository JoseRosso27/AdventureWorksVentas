<?php
session_start();
require_once "conexion/pdo.php";

require "layouts/header.php";
?>
<div class="container" style="height: 500px">
    <div class="h-100 d-flex justify-content-center align-items-center">
        <h1 class="text-center">¡Bienvenido al sistema!</h1>
    </div>
</div>
<?php require "layouts/footer.php" ?>