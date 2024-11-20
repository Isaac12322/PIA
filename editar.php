<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
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

    <div class="container">
        <h1>Editar Ruta</h1>
        <?php
        $con = mysqli_connect("localhost", "root", "", "alr");

        if (!$con) {
            die("<div class='message error'>Error al conectar a la base de datos: " . mysqli_connect_error() . "</div>");
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Id_Ruta'])) {
            $Id_Ruta = intval($_POST['Id_Ruta']);
            $Destino = mysqli_real_escape_string($con, $_POST['Destino']);
            $Material = mysqli_real_escape_string($con, $_POST['Material_que_maneja']);

            $update_query = "UPDATE ruta SET 
                Destino = ?, 
                `Material que maneja` = ? 
                WHERE Id_Ruta = ?";
            $stmt = mysqli_prepare($con, $update_query);
            mysqli_stmt_bind_param($stmt, 'ssi', $Destino, $Material, $Id_Ruta);

            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='message success'>La ruta fue actualizada exitosamente.</div>";
            } else {
                echo "<div class='message error'>Error al actualizar la ruta: " . mysqli_error($con) . "</div>";
            }

            mysqli_stmt_close($stmt);
        }

        if (isset($_GET['Id_Ruta'])) {
            $Id_Ruta = intval($_GET['Id_Ruta']);
            $query = "SELECT * FROM ruta WHERE Id_Ruta = ?";
            $stmt = mysqli_prepare($con, $query);
            mysqli_stmt_bind_param($stmt, 'i', $Id_Ruta);
            mysqli_stmt_execute($stmt);
            $resultado = mysqli_stmt_get_result($stmt);
            $ruta = mysqli_fetch_assoc($resultado);

            if ($ruta) {
                echo "<form method='POST'>
                    <label for='Id_Ruta'>ID Ruta:</label>
                    <input type='text' name='Id_Ruta' id='Id_Ruta' value='" . htmlspecialchars($ruta['Id_Ruta']) . "' readonly>
                    <label for='Destino'>Destino:</label>
                    <input type='text' name='Destino' id='Destino' value='" . htmlspecialchars($ruta['Destino']) . "' required>
                    <label for='Material_que_maneja'>Material que maneja:</label>
                    <input type='text' name='Material_que_maneja' id='Material_que_maneja' value='" . htmlspecialchars($ruta['Material que maneja']) . "' required>
                    <button type='submit'>Guardar Cambios</button>
                </form>";
            } else {
                echo "<div class='message error'>No se encontró la ruta con ID $Id_Ruta.</div>";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "<form method='GET'>
                <label for='Id_Ruta'>Ingrese el ID de la Ruta a Editar:</label>
                <input type='number' name='Id_Ruta' id='Id_Ruta' required>
                <button type='submit'>Buscar</button>
            </form>";
        }

        mysqli_close($con);
        ?>
    </div>
</body>
</html>
