<!DOCTYPE html>
<html>
<head>
    <title>Consulta de Alumnos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<h2>Consulta de Alumnos</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Apellidos</th>
        <th>Nombres</th>
        <th>DNI</th>
    </tr>

    <?php

$message = getenv('CUSTOM_MESSAGE');


    $servername = "mysql";
    $username = "root";
    $password = "root1";
    $dbname = "prueba";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL
    $sql = "SELECT id, apellidos, nombres, dni FROM alumnos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos en la tabla HTML
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["apellidos"] . "</td>";
            echo "<td>" . $row["nombres"] . "</td>";
            echo "<td>" . $row["dni"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No se encontraron resultados.";
    }

    // Cerrar conexión
    $conn->close();
    ?>
</table>
<h1><?php echo $message; ?></h1>

</body>
</html>

<!-- 
docker run -d --name php-apache -p 8088:80 -v ${PWD}/app:/var/www/html php:apache-bullseye -->
<!--CONSEGUIR LA IP DEL CONTENEDOR 
    docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' mysql -->
<!-- intalar extensiones
docker exec -it php-apache bash

apt-get update
apt-get install -y libmysqli-dev
docker-php-ext-install mysqli
docker-php-ext-enable mysqli -->
