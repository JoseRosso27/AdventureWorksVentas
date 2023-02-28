<?php
session_start();
$server = "LAPTOP-6M7TET7Q";
$username = "rosso";
$password = "123";
$database = "DataMart_AW";
$pdo = new PDO("sqlsrv:Server=$server;Database=$database", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$page = (isset($_GET["page"]) ? $_GET["page"] : 1) + 0;
$previous_page = $page - 1;
$next_page = $page + 1;
$step = 10;
$start = ($page - 1) * $step;
if (isset($_GET["dimension"])&&$_GET["dimension"]=="DIM_CUSTOMER") {
    $stmt = $pdo->query("SELECT
    [CustomerID]
    ,[FirstName]
    ,[MiddleName]
    ,[LastName]
    ,[EmailAddress]
    FROM [DIM_CUSTOMER]
    ORDER BY [CustomerID]
    OFFSET $start ROWS FETCH NEXT $step ROWS ONLY");
    $rows = $stmt->fetchAll();
    $tr='
    <th scope="col">CustomerID</th>
    <th scope="col">FirstName</th>
    <th scope="col">MiddleName</th>
    <th scope="col">LastName</th>
    <th scope="col">EmailAddress</th>
    ';
    $td="";
    foreach ($rows as $row) {
        $td .= "
        <tr class='p-1'>
        <th class='p-1' scope='row'>" . $row['CustomerID'] . "</th>
        <td class='p-1'>" . $row['FirstName'] . "</td>
        <td class='p-1'>" . $row['MiddleName'] . "</td>
        <td class='p-1'>" . $row['LastName'] . "</td>
        <td class='p-1'>" . $row['EmailAddress'] . "</td></tr>";
    }
    $sql = "SELECT
    count(*) as count
    FROM [DIM_CUSTOMER]";
} elseif (isset($_GET["dimension"])&&$_GET["dimension"]=="DIM_PRODUCT") {
    $stmt = $pdo->query("SELECT
    [ProductID]
    ,[Name]
    ,[Category]
    ,[Color]
    ,[Weight]
    ,[Price]
    ,[Cost]
    FROM [DIM_PRODUCT]
    ORDER BY [ProductID]
    OFFSET $start ROWS FETCH NEXT $step ROWS ONLY");
    $rows = $stmt->fetchAll();

    $tr='
    <th scope="col">ProductID</th>
    <th scope="col">Name</th>
    <th scope="col">Category</th>
    <th scope="col">Color</th>
    <th scope="col">Weight</th>
    <th scope="col">Price</th>
    <th scope="col">Cost</th>
    ';
    $td="";
    foreach ($rows as $row) {
        $td .= "
        <tr class='p-1'>
        <th class='p-1' scope='row'>" . $row['ProductID'] . "</th>
        <td class='p-1'>" . $row['Name'] . "</td>
        <td class='p-1'>" . $row['Category'] . "</td>
        <td class='p-1'>" . $row['Color'] . "</td>
        <td class='p-1'>" . $row['Weight'] . "</td>
        <td class='p-1'>" . $row['Price'] . "</td>
        <td class='p-1'>" . $row['Cost'] . "</td></tr>";
    }

    $sql = "SELECT
    count(*) as count
    FROM [DIM_PRODUCT]";
} elseif (isset($_GET["dimension"])&&$_GET["dimension"]=="DIM_SALESPERSON") {
    $stmt = $pdo->query("SELECT
    [EmployeeID]
      ,[FirstName]
      ,[MiddleName]
      ,[LastName]
      ,[CommissionPCT]
    FROM [DIM_SALESPERSON]
    ORDER BY [EmployeeID]
    OFFSET $start ROWS FETCH NEXT $step ROWS ONLY");
    $rows = $stmt->fetchAll();

    $tr='
    <th scope="col">EmployeeID</th>
    <th scope="col">FirstName</th>
    <th scope="col">MiddleName</th>
    <th scope="col">LastName</th>
    <th scope="col">CommissionPCT</th>
    ';
    $td="";
    foreach ($rows as $row) {
        $td .= "
        <tr class='p-1'>
        <th class='p-1' scope='row'>" . $row['EmployeeID'] . "</th>
        <td class='p-1'>" . $row['FirstName'] . "</td>
        <td class='p-1'>" . $row['MiddleName'] . "</td>
        <td class='p-1'>" . $row['LastName'] . "</td>
        <td class='p-1'>" . $row['CommissionPCT'] . "</td></tr>";
    }

    $sql = "SELECT
    count(*) as count
    FROM [DIM_SALESPERSON]";
} elseif (isset($_GET["dimension"])&&$_GET["dimension"]=="DIM_SHIPMETHOD") {
    $stmt = $pdo->query("SELECT
    [ShipMethodID]
    ,[Name]
    ,[ShipBase]
    ,[ShipRate]
    FROM [DIM_SHIPMETHOD]
    ORDER BY [ShipMethodID]
    OFFSET $start ROWS FETCH NEXT $step ROWS ONLY");
    $rows = $stmt->fetchAll();

    $tr='
    <th scope="col">ShipMethodID</th>
    <th scope="col">Name</th>
    <th scope="col">ShipBase</th>
    <th scope="col">ShipRate</th>
    ';
    $td="";
    foreach ($rows as $row) {
        $td .= "
        <tr class='p-1'>
        <th class='p-1' scope='row'>" . $row['ShipMethodID'] . "</th>
        <td class='p-1'>" . $row['Name'] . "</td>
        <td class='p-1'>" . $row['ShipBase'] . "</td>
        <td class='p-1'>" . $row['ShipRate'] . "</td></tr>";
    }

    $sql = "SELECT
    count(*) as count
    FROM [DIM_SHIPMETHOD]";
} elseif (isset($_GET["dimension"])&&$_GET["dimension"]=="DIM_TERRETORY") {
    $stmt = $pdo->query("SELECT
    [TerretoryID]
    ,[Name]
    ,[Country]
    ,[GroupT]
    FROM [DIM_TERRETORY]
    ORDER BY [TerretoryID]
    OFFSET $start ROWS FETCH NEXT $step ROWS ONLY");
    $rows = $stmt->fetchAll();

    $tr='
    <th scope="col">TerretoryID</th>
    <th scope="col">Name</th>
    <th scope="col">Country</th>
    <th scope="col">GroupT</th>
    ';
    $td="";
    foreach ($rows as $row) {
        $td .= "
        <tr class='p-1'>
        <th class='p-1' scope='row'>" . $row['TerretoryID'] . "</th>
        <td class='p-1'>" . $row['Name'] . "</td>
        <td class='p-1'>" . $row['Country'] . "</td>
        <td class='p-1'>" . $row['GroupT'] . "</td></tr>";
    }

    $sql = "SELECT
    count(*) as count
    FROM [DIM_TERRETORY]";
} elseif (isset($_GET["dimension"])&&$_GET["dimension"]=="DIM_TIME") {
    $stmt = $pdo->query("SELECT
    [TimeID]
    ,[Day]
    ,[Week]
    ,[Month]
    ,[Year]
    ,[TheDate]
    FROM [DIM_TIME]
    ORDER BY [TimeID]
    OFFSET $start ROWS FETCH NEXT $step ROWS ONLY");
    $rows = $stmt->fetchAll();

    $tr='
    <th scope="col">TimeID</th>
    <th scope="col">Day</th>
    <th scope="col">Week</th>
    <th scope="col">Year</th>
    <th scope="col">TheDate</th>
    ';
    $td="";
    foreach ($rows as $row) {
        $td .= "
        <tr class='p-1'>
        <th class='p-1' scope='row'>" . $row['TimeID'] . "</th>
        <td class='p-1'>" . $row['Day'] . "</td>
        <td class='p-1'>" . $row['Week'] . "</td>
        <td class='p-1'>" . $row['Year'] . "</td>
        <td class='p-1'>" . $row['TheDate'] . "</td></tr>";
    }

    $sql = "SELECT
    count(*) as count
    FROM [DIM_TIME]";
} elseif (isset($_GET["dimension"])&&$_GET["dimension"]=="FACT_SALES") {
    $stmt = $pdo->query("SELECT
    [id]
    ,[ShipMethodID]
    ,[TerretoryID]
    ,[ProductID]
    ,[EmployeeID]
    ,[TimeID]
    ,[CustomerID]
    ,[RequiredDate]
    ,[Cantidad]
    ,[Ganancia]
    FROM [FACT_SALES]
    ORDER BY [id]
    OFFSET $start ROWS FETCH NEXT $step ROWS ONLY");
    $rows = $stmt->fetchAll();

    $tr='
    <th scope="col">id</th>
    <th scope="col">ShipMethodID</th>
    <th scope="col">TerretoryID</th>
    <th scope="col">ProductID</th>
    <th scope="col">TimeID</th>
    <th scope="col">CustomerID</th>
    <th scope="col">RequiredDate</th>
    <th scope="col">Cantidad</th>
    <th scope="col">Ganancia</th>
    ';
    $td="";
    foreach ($rows as $row) {
        $td .= "
        <tr class='p-1'>
        <th class='p-1' scope='row'>" . $row['id'] . "</th>
        <td class='p-1'>" . $row['ShipMethodID'] . "</td>
        <td class='p-1'>" . $row['TerretoryID'] . "</td>
        <td class='p-1'>" . $row['ProductID'] . "</td>
        <td class='p-1'>" . $row['TimeID'] . "</td>
        <td class='p-1'>" . $row['CustomerID'] . "</td>
        <td class='p-1'>" . $row['RequiredDate'] . "</td>
        <td class='p-1'>" . $row['Cantidad'] . "</td>
        <td class='p-1'>" . $row['Ganancia'] . "</td></tr>";
    }

    $sql = "SELECT
    count(*) as count
    FROM [FACT_SALES]";
} else {
    $stmt = $pdo->query("SELECT
    [id]
    ,[ShipMethodID]
    ,[TerretoryID]
    ,[ProductID]
    ,[EmployeeID]
    ,[TimeID]
    ,[CustomerID]
    ,[RequiredDate]
    ,[Cantidad]
    ,[Ganancia]
    FROM [FACT_SALES]
    ORDER BY [id]
    OFFSET $start ROWS FETCH NEXT $step ROWS ONLY");
    $rows = $stmt->fetchAll();

    $tr='
    <th scope="col">id</th>
    <th scope="col">ShipMethodID</th>
    <th scope="col">TerretoryID</th>
    <th scope="col">ProductID</th>
    <th scope="col">TimeID</th>
    <th scope="col">CustomerID</th>
    <th scope="col">RequiredDate</th>
    <th scope="col">Cantidad</th>
    <th scope="col">Ganancia</th>
    ';
    $td="";
    foreach ($rows as $row) {
        $td .= "
        <tr class='p-1'>
        <th class='p-1' scope='row'>" . $row['id'] . "</th>
        <td class='p-1'>" . $row['ShipMethodID'] . "</td>
        <td class='p-1'>" . $row['TerretoryID'] . "</td>
        <td class='p-1'>" . $row['ProductID'] . "</td>
        <td class='p-1'>" . $row['TimeID'] . "</td>
        <td class='p-1'>" . $row['CustomerID'] . "</td>
        <td class='p-1'>" . $row['RequiredDate'] . "</td>
        <td class='p-1'>" . $row['Cantidad'] . "</td>
        <td class='p-1'>" . $row['Ganancia'] . "</td></tr>";
    }

    $sql = "SELECT
    count(*) as count
    FROM [FACT_SALES]";
}

$stmt = $pdo->query($sql);
$count_string = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $count_string["count"] + 0;
$number_pages = intval(ceil($count / $step));

$array=array("DIM_CUSTOMER","DIM_PRODUCT","DIM_SALESPERSON","DIM_SHIPMETHOD","DIM_SHIPMETHOD","DIM_TERRETORY","DIM_TIME","FACT_SALES");
$option="";
$selected="";
foreach($array as $arr) {
    if($arr===$_GET["dimension"]) {
        $selected="selected";
    }
    $option .= "<option value='".$arr."' $selected>$arr</option>";
    $selected="";
}

function printMessage(&$message, $type)
{
    if (isset($message)) {
        if ($type == "successful") {
            echo "<h4 class='text-center text-success'>";
            echo $message;
            echo "</h4>";
        } elseif ($type == "error") {
            echo "<h4 class='text-center text-danger'>";
            echo $message;
            echo "</h4>";
        }
    }
}

require "../layouts/header.php"
?>
<div class="container-fluid">
    <div class="container-fluid mb-1 mt-1">
        <div class="row">
            <div class="col-12 col-md-4">
                <h3 class="bg-warning text-center">Tabla hechos ventas</h3>
            </div>
            <div class="col-12 col-md-2">
                <?php
                printMessage($_SESSION["delete_successful"], "successful");
                printMessage($_SESSION["delete_error"], "error");
                printMessage($_SESSION["edit_successful"], "successful");
                printMessage($_SESSION["edit_error"], "error");
                printMessage($_SESSION["create_successful"], "successful");
                printMessage($_SESSION["create_error"], "error");
                unset($_SESSION["delete_successful"]);
                unset($_SESSION["delete_error"]);
                unset($_SESSION["edit_successful"]);
                unset($_SESSION["edit_error"]);
                unset($_SESSION["create_successful"]);
                unset($_SESSION["create_error"]);
                ?>
            </div>
            <div class="col-12 col-md-6">
                <form method="get" class="d-flex">
                <div class="input-group d-flex align-items-center">
                    <select class="form-select" name="dimension">
                        <option disabled>Selecciona la fecha del inventario</option>
                        <?=$option?>
                    </select>
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
    <div class="table-responsive-lg">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <?=$tr?>
                </tr>
            </thead>
            <tbody>
                <?php
                echo $td;
                ?>
            </tbody>
        </table>
    </div>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php
            if ($page == 1) {
                $disabled = "";
                if ($number_pages >= 3) {
                    $x = 3;
                } elseif ($number_pages == 2) {
                    $x = 2;
                } else {
                    $x = 1;
                    $disabled = "disabled";
                }
                echo "<li class='page-item disabled'><a class='page-link'>Anterior</a></li>";
                for ($i = 1; $i <= $x; $i++) {
                    if ($i === $page) {
                        echo "<li class='page-item active'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$i'>$i</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$i'>$i</a></li>";
                    }
                }
                echo "<li class='page-item $disabled'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$next_page'>Siguiente</a></li>";
            } elseif ($page !== $number_pages) {
                echo "<li class='page-item'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$previous_page'>Anterior</a></li>";
                for ($i = $page - 1; $i <= $page + 1; $i++) {
                    if ($i === $page) {
                        echo "<li class='page-item active'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$i'>$i</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$i'>$i</a></li>";
                    }
                }
                echo "<li class='page-item'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$next_page'>Siguiente</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$previous_page'>Anterior</a></li>";
                if ($number_pages<=2) {
                    for ($i = $page - 1; $i <= $page; $i++) {
                        if ($i === $page) {
                            echo "<li class='page-item active'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$i'>$i</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$i'>$i</a></li>";
                        }
                    }
                    echo "<li class='page-item disabled'><a class='page-link'>Siguiente</a></li>";
                } else {
                    for ($i = $page - 2; $i <= $page; $i++) {
                        if ($i === $page) {
                            echo "<li class='page-item active'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$i'>$i</a></li>";
                        } else {
                            echo "<li class='page-item'><a class='page-link' href='fact_table.php?dimension=".$_GET["dimension"]."&page=$i'>$i</a></li>";
                        }
                    }
                    echo "<li class='page-item disabled'><a class='page-link'>Siguiente</a></li>";
                }
            }
            ?>
        </ul>
    </nav>
</div>
<?php require "../layouts/footer.php" ?>