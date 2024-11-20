<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sucursales</title>
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
                position: relative;
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
    
            .image-container {
                text-align: center;
                padding: 20px;
                background-color: white;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
    
            .image-container img {
                max-width: 90%;
                height: auto;
                border-radius: 5px;
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

        .table-container a {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: inline-block;
        }

        .table-container a:hover {
            background-color: #45a049;
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

$resultado = mysqli_query($con, "SELECT * FROM sucursales");

if ($resultado == FALSE) {
    echo "Fallo al realizar la consulta.";
    die(mysqli_error($con));
}

echo "<center><font face='Arial'>";
echo "<a href='sucursales.php'>Actualizar tabla</a>";
echo "<table border='1'>
<tr>
    <th>Id_Sucursal</th>
    <th>Direccion</th>
</tr>";

while ($row = mysqli_fetch_array($resultado)) {
    echo "<tr>";
    echo "<td align='center'>" . $row['Id_Sucursal'] . "</td>";
    echo "<td>" . $row['Direccion'] . "</td>";
    echo "</tr>";
}
echo "</table>";
?>
</head>
<body>
</html>
