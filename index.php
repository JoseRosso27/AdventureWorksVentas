
<?php
session_start();
require_once "pdo.php";
$url = "/epp";
$sql = "SELECT * FROM employee where id=:id";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':id' => $_SESSION["user"]["employee_id"]));
$employee = $stmt->fetch(PDO::FETCH_ASSOC);

require "layouts/header.php";
?>
<div class="container" style="height: 500px">
    <div class="h-100 d-flex justify-content-center align-items-center">
        <h1 class="text-center">Bienvenido <?= $employee["names"]." ".$employee["first_surname"]." ".$employee["second_surname"] ?></h1>
    </div>
</div>
<?php require "layouts/footer.php" ?>