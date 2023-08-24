<?php
$host = "localhost";
$dbname = "ecfinal";
$username = "root";
$password = "1234";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    die();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM Vehiculo WHERE id = ?");
    $stmt->execute([$id]);
    $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);
}

$marcas = [];
$stmt = $pdo->query("SELECT * FROM Marca");
if ($stmt) {
    $marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (isset($_POST['editar-vehiculo'])) {
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $precio = $_POST['precio'];
    $marca_id = $_POST['marca_id'];
    $stmt = $pdo->prepare("UPDATE Vehiculo SET modelo = ?, año = ?, precio = ?, marca_id = ? WHERE id = ?");
    $stmt->execute([$modelo, $anio, $precio, $marca_id, $id]);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Vehículo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 80%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="number"], select {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Vehículo</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $vehiculo['id']; ?>">
            <input type="text" name="modelo" placeholder="Modelo" value="<?php echo $vehiculo['modelo']; ?>" required>
            <input type="number" name="anio" placeholder="Año" value="<?php echo $vehiculo['año']; ?>" required>
            <input type="number" name="precio" placeholder="Precio" value="<?php echo $vehiculo['precio']; ?>" required>
            <select name="marca_id" required>
                <option value="" disabled selected>Seleccione una Marca</option>
                <?php foreach ($marcas as $marca) { ?>
                    <option value="<?php echo $marca['id']; ?>" <?php echo $vehiculo['marca_id'] == $marca['id'] ? 'selected' : ''; ?>><?php echo $marca['nombre']; ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="editar-vehiculo">Guardar Cambios</button>
        </form>
    </div>
</body>
</html>
