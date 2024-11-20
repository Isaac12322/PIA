<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar</title>
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
        }

        form {
            margin: 20px auto;
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 50%;
        }

        form input, form button {
            padding: 10px;
            margin: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        form button:hover {
            background-color: #45a049;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #333;
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

    <form method="GET">
        <label for="Id_Sucursal">Ingrese el ID de la sucursal:</label>
        <input type="number" name="Id_Sucursal" id="Id_Sucursal" required>
        <button type="submit">Buscar</button>
    </form>

    <?php

    $con = mysqli_connect("localhost", "root", "", "alr");

    if (!$con) {
        die("<p>Error al conectar con la base de datos: " . mysqli_connect_error() . "</p>");
    }

  
    if (isset($_GET['Id_Sucursal'])) {
        $Id_Sucursal = intval($_GET['Id_Sucursal']); 
        $query = "SELECT * FROM sucursales WHERE Id_Sucursal = $Id_Sucursal";
        $resultado = mysqli_query($con, $query);

        if (mysqli_num_rows($resultado) > 0) {
            echo "<table>
                <tr>
                    <th>ID Sucursal</th>
                    <th>Dirección</th>
                </tr>";
            while ($row = mysqli_fetch_assoc($resultado)) {
                echo "<tr>
                    <td>{$row['Id_Sucursal']}</td>
                    <td>{$row['Direccion']}</td>
                </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontró ninguna sucursal con ID $Id_Sucursal.</p>";
        }

       
        mysqli_free_result($resultado);
    }

    
    mysqli_close($con);
    ?>
</body>
</html>
