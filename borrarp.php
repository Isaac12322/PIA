<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Borrar</title>
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

        .table-container {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px 0;
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

        button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #c0392b;
        }

        p {
            text-align: center;
            font-size: 16px;
            color: #333;
        }

        p.success {
            color: #4CAF50;
        }

        p.error {
            color: #e74c3c;
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
        <?php
$con = mysqli_connect("localhost", "root", "", "alr");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Id_Sucursal'])) {
    $Id_Sucursal = intval($_POST['Id_Sucursal']);
    $delete_query = "DELETE FROM sucursales WHERE Id_Sucursal = $Id_Sucursal";

    if (mysqli_query($con, $delete_query)) {
        echo "<p>Sucursal con ID $Id_Sucursal eliminada exitosamente.</p>";
    } else {
        echo "<p>Error al eliminar la sucursal: " . mysqli_error($con) . "</p>";
    }
}

$resultado = mysqli_query($con, "SELECT * FROM sucursales");

echo "<table border='1'>
<tr>
    <th>Id_Sucursal</th>
    <th>Direccion</th>
    <th>Acciones</th>
</tr>";

while ($row = mysqli_fetch_array($resultado)) {
    echo "<tr>";
    echo "<td>" . $row['Id_Sucursal'] . "</td>";
    echo "<td>" . $row['Direccion'] . "</td>";
    echo "<td>
        <form method='POST'>
            <input type='hidden' name='Id_Sucursal' value='" . $row['Id_Sucursal'] . "'>
            <button type='submit'>Borrar</button>
        </form>
    </td>";
    echo "</tr>";
}
echo "</table>";
?>

</head>
<body>
</html>
