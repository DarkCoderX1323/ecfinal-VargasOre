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

if (isset($_POST['agregar-vehiculo'])) {
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $precio = $_POST['precio'];
    $marca_id = $_POST['marca_id'];
    $stmt = $pdo->prepare("INSERT INTO Vehiculo (modelo, año, precio, marca_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$modelo, $anio, $precio, $marca_id]);
}

if (isset($_POST['editar-vehiculo'])) {
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $precio = $_POST['precio'];
    $marca_id = $_POST['marca_id'];
    $stmt = $pdo->prepare("UPDATE Vehiculo SET modelo = ?, año = ?, precio = ?, marca_id = ? WHERE id = ?");
    $stmt->execute([$modelo, $anio, $precio, $marca_id, $id]);
}

if (isset($_POST['eliminar-vehiculo'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM Vehiculo WHERE id = ?");
    $stmt->execute([$id]);
}

$vehiculos = [];
$stmt = $pdo->query("SELECT * FROM Vehiculo");
if ($stmt) {
    $vehiculos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$marcas = [];
$stmt = $pdo->query("SELECT * FROM Marca");
if ($stmt) {
    $marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Vehículos y Marcas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #483D8B; 
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
        }
        form {
            display: flex;
            flex-direction: column;
            margin-top: 10px;
        }
        input[type="text"], input[type="number"], select {
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 8px 12px;
            background-color: #27ae60; 
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button.edit {
            background-color: #2ecc71; 
        }
        button.delete {
            background-color: #e74c3c;
        }
        .logo {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-height: 100px;
            margin-right: 20px;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="logo">
            <img src="./pngwing.com.png" alt="Logo"> 
        </div>
    <div class="container">
        <h1>Listado de Vehículos</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Precio en Dolares</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehiculos as $vehiculo) { ?>
                    <tr>
                        <td><?php echo $vehiculo['id']; ?></td>
                        <td><?php echo obtenerNombreMarca($vehiculo['marca_id']); ?></td>
                        <td><?php echo $vehiculo['modelo']; ?></td>
                        <td><?php echo $vehiculo['año']; ?></td>
                        <td><?php echo $vehiculo['precio']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $vehiculo['id']; ?>">
                                <button class="edit" type="submit" formaction="editar_vehiculo.php?id=<?php echo $vehiculo['id']; ?>">Editar</button>
                                <button class="delete" type="submit" name="eliminar-vehiculo">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
function obtenerNombreMarca($marca_id) {
    global $marcas;
    foreach ($marcas as $marca) {
        if ($marca['id'] == $marca_id) {
            return $marca['nombre'];
        }
    }
    return "Desconocida";
}
?>

        <h1>Agregar Vehículo</h1>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo isset($_POST['editar-vehiculo']) ? $_POST['id'] : ''; ?>">
            <input type="text" name="modelo" placeholder="Modelo" value="<?php echo isset($_POST['editar-vehiculo']) ? $_POST['modelo'] : ''; ?>" required>
            <input type="number" name="anio" placeholder="Año" value="<?php echo isset($_POST['editar-vehiculo']) ? $_POST['anio'] : ''; ?>" required>
            <input type="number" name="precio" placeholder="Precio" value="<?php echo isset($_POST['editar-vehiculo']) ? $_POST['precio'] : ''; ?>" required>
            <select name="marca_id" required>
                <option value="" disabled selected>Seleccione una Marca</option>
                <?php foreach ($marcas as $marca) { ?>
                    <option value="<?php echo $marca['id']; ?>" <?php echo isset($_POST['editar-vehiculo']) && $_POST['marca_id'] == $marca['id'] ? 'selected' : ''; ?>><?php echo $marca['nombre']; ?></option>
                <?php } ?>
            </select>
            <button type="submit" name="<?php echo isset($_POST['editar-vehiculo']) ? 'editar-vehiculo' : 'agregar-vehiculo'; ?>">
                <?php echo isset($_POST['editar-vehiculo']) ? 'Guardar Cambios' : 'Agregar Vehículo'; ?>
            </button>
        </form>
    </div>
</body>
</html>
