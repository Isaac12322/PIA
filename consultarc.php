<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Operador</title>
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
            z-index: 1000;
            border-radius: 5px;
        }

        nav ul li ul li {
            margin: 0;
        }

        nav ul li ul li a {
            padding: 10px 15px;
            font-size: 16px;
        }

        nav ul li ul li a:hover {
            background-color: #4CAF50;
        }

        nav ul li:hover ul {
            display: block;
        }

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
            background-color: white;
            max-width: 500px;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container label {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .result-container {
            display: flex;
            justify-content: center;
            margin: 20px;
        }

        .result-container p {
            font-size: 16px;
            color: #333;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table td {
            border-bottom: 1px solid #ddd;
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

    <div class="form-container">
        <form method="GET">
            <label for="Id_Operador">Ingrese el ID del Operador:</label>
            <input type="number" name="Id_Operador" id="Id_Operador" required>
            <button type="submit">Buscar</button>
        </form>
    </div>

    <div class="result-container">
        <?php
        $con = mysqli_connect("localhost", "root", "", "alr");

        if (isset($_GET['Id_Operador'])) {
            $Id_Operador = intval($_GET['Id_Operador']);
            $query = "SELECT * FROM operadores WHERE Id_Operador = $Id_Operador";
            $resultado = mysqli_query($con, $query);

            if (mysqli_num_rows($resultado) > 0) {
                echo "<table>
                    <tr>
                        <th>ID Operador</th>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apellido Materno</th>
                        <th>Teléfono</th>
                        <th>CURP</th>
                        <th>Dirección</th>
                    </tr>";
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                        <td>{$row['Id_Operador']}</td>
                        <td>{$row['Nombre']}</td>
                        <td>{$row['Apellido Paterno']}</td>
                        <td>{$row['Apellido Materno']}</td>
                        <td>{$row['Telefono']}</td>
                        <td>{$row['CURP']}</td>
                        <td>{$row['Direccion']}</td>
                    </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No se encontró ningún operador con ID $Id_Operador.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
