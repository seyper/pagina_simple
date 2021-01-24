<!doctype html>
<html lang="es">
<?php
require_once '../php/conexion.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
} else if ($_SESSION['permiso'] != 'admin') {
    header('location: admin.php');
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Auditoría</title>

    <!-- Bootstrap importante CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Fontawesome -->
    <link href="../assets/css/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Hoja de estilos customizada -->
    <link href="../assets/css/admin.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="admin.php">Soporte Técnico</a>

        <marquee behavior="" direction="" class="text-white">Esperamos el sistema sea de tu agrado!</marquee>

        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="../php/logout.php">Cerrar sesión</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="home"></span>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="admin.php">
                                <span data-feather="home"></span>
                                Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="actualizar_usuario.php">
                                <span data-feather="user"></span>
                                Actualizar usuario
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="auditoria.php">
                                <span data-feather="bar-chart-2"></span>
                                Auditoria <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="shopping-cart"></span>
                                Servicios
                            </a>
                        </li>
                        <li class="nav-item">
                        <?php
                            if ($_SESSION['permiso'] == 'admin') {
                            ?>
                                <a class="nav-link" href="consultar_ticket.php">
                                <?php
                            }else{
                                ?>
                                <a class="nav-link" href="añadir_ticket.php">
                                <?php
                            }
                                ?>
                                <span data-feather="layers"></span>
                                Tickets
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Reportes</span>
                        <a class="d-flex align-items-center text-muted" href="#">
                            <span data-feather="plus-circle"></span>
                        </a>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Por mes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Por año
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="file-text"></span>
                                Detalles avanzados
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bienvenido <?= $_SESSION['nombre'] ?> a el registro de auditoría</h1>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Fecha entrada</th>
                            <th>Fecha salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 1;
                        $query = "SELECT a.id_usuario, a.fecha_entrada, a.fecha_salida, b.id_usuario, b.nombre FROM auditoria as a INNER JOIN usuario as b ON a.id_usuario = b.id_usuario";
                        $result = mysqli_query($dbconn, $query) or die(mysqli_error($dbconn));

                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $num ?></td>
                                <td><?= $data['nombre']?></td>
                                <td><?= $data['fecha_entrada'] ?></td>
                                <td><?= $data['fecha_salida'] ?></td>
                            </tr>
                        <?php
                            $num++;
                        }
                        ?>
                    </tbody>
                </table>
            </main>
        </div>
    </div>

    <!-- Bootstrap importante JavaScript
    ================================================== -->

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>

    <!-- Iconos -->
    <script src="../assets/js/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>