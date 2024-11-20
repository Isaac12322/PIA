<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Operador</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        nav {
            background-color: #333;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        nav ul li {
            margin: 0 15px;
            position: relative;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            display: block;
            font-size: 18px;
        }

        nav ul li a:hover {
            background-color: #555;
            border-radius: 5px;
        }

        nav ul li a.active {
            background-color: #4CAF50;
            border-radius: 5px;
        }

        nav ul li ul {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #333;
            padding: 0;
            margin: 0;
            list-style-type: none;
            border-radius: 5px;
        }

        nav ul li ul li a {
            padding: 10px 15px;
        }

        nav ul li:hover ul {
            display: block;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 40px auto;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }

        form input[type="text"],
        form input[type="number"],
        form textarea,
        form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        form button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        .message.success {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .message.error {
            background-color: #fdecea;
            color: #d32f2f;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="index.html" class="active">Inicio</a></li>
            <li>
                <a href="operadores.php">Operadores</a>
                <ul>
                    <li><a href="borrarc.php">Borrar Operador</a></li>
                    <li><a href="consultarc.php">Consultar Operador</a></li>
                    <li><a href="editarc.php">Editar Operador</a></li>
                </ul>
            </li>
            <li>
                <a href="pedidos.php">Ruta</a>
                <ul>
                    <li><a href="borrar.php">Borrar Ruta</a></li>
                    <li><a href="consultar.php">Consultar Ruta</a></li>
                    <li><a href="editar.php">Editar Ruta</a></li>
                </ul>
            </li>
            <li>
                <a href="sucursales.php">Sucursales</a>
                <ul>
                    <li><a href="borrarp.php">Borrar Sucursales</a></li>
                    <li><a href="consultarp.php">Consultar Sucursales</a></li>
                    <li><a href="editarp.php">Editar Sucursales</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <h1>Editar Operador</h1>

   <div class="container">
   <?php
    $con = mysqli_connect("localhost", "root", "", "alr");

    if (!$con) {
        die("<p>Error al conectar a la base de datos: " . mysqli_connect_error() . "</p>");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Id_Operador'])) {
        $Id_Operador = intval($_POST['Id_Operador']);
        $Nombre = mysqli_real_escape_string($con, $_POST['Nombre']);
        $ApellidoPaterno = mysqli_real_escape_string($con, $_POST['Apellido_Paterno']);
        $ApellidoMaterno = mysqli_real_escape_string($con, $_POST['Apellido_Materno']);
        $Telefono = intval($_POST['Telefono']);
        $CURP = mysqli_real_escape_string($con, $_POST['CURP']);
        $Direccion = mysqli_real_escape_string($con, $_POST['Direccion']);

        $update_query = "UPDATE operadores SET 
            Nombre = ?, 
            `Apellido Paterno` = ?, 
            `Apellido Materno` = ?, 
            Telefono = ?, 
            CURP = ?, 
            Direccion = ?
            WHERE Id_Operador = ?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, 'ssssisi', $Nombre, $ApellidoPaterno, $ApellidoMaterno, $Telefono, $CURP, $Direccion, $Id_Operador);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='message success'>El operador fue actualizado exitosamente.</div>";
        } else {
            echo "<div class='message error'>Error al actualizar el operador: " . mysqli_error($con) . "</div>";
        }

        mysqli_stmt_close($stmt);
    }

    if (isset($_GET['Id_Operador'])) {
        $Id_Operador = intval($_GET['Id_Operador']);
        $query = "SELECT * FROM operadores WHERE Id_Operador = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 'i', $Id_Operador);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $operador = mysqli_fetch_assoc($resultado);

        if ($operador) {
            echo "<div class='form-container'>
                <form method='POST'>
                    <label for='Id_Operador'>ID Operador:</label>
                    <input type='text' name='Id_Operador' id='Id_Operador' value='" . htmlspecialchars($operador['Id_Operador']) . "' readonly><br>
                    <label for='Nombre'>Nombre:</label>
                    <input type='text' name='Nombre' id='Nombre' value='" . htmlspecialchars($operador['Nombre']) . "' required><br>
                    <label for='Apellido_Paterno'>Apellido Paterno:</label>
                    <input type='text' name='Apellido_Paterno' id='Apellido_Paterno' value='" . htmlspecialchars($operador['Apellido Paterno']) . "' required><br>
                    <label for='Apellido_Materno'>Apellido Materno:</label>
                    <input type='text' name='Apellido_Materno' id='Apellido_Materno' value='" . htmlspecialchars($operador['Apellido Materno']) . "' required><br>
                    <label for='Telefono'>Telefono:</label>
                    <input type='text' name='Telefono' id='Telefono' value='" . htmlspecialchars($operador['Telefono']) . "' required><br>
                    <label for='CURP'>CURP:</label>
                    <input type='text' name='CURP' id='CURP' value='" . htmlspecialchars($operador['CURP']) . "' required><br>
                    <label for='Direccion'>Direccion:</label>
                    <input type='text' name='Direccion' id='Direccion' value='" . htmlspecialchars($operador['Direccion']) . "' required><br>
                    <button type='submit'>Guardar Cambios</button>
                </form>
            </div>";
        } else {
            echo "<div class='message error'>No se encontró el operador con ID $Id_Operador.</div>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='form-container'>
            <form method='GET'>
                <label for='Id_Operador'>Ingrese el ID del Operador a Editar:</label>
                <input type='number' name='Id_Operador' id='Id_Operador' required>
                <button type='submit'>Buscar</button>
            </form>
        </div>";
    }

    mysqli_close($con);
    ?>
   </div>
</body>
</html>
