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

    <title>Consulta Ticket</title>

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
                            <a class="nav-link" href="auditoria.php">
                                <span data-feather="bar-chart-2"></span>
                                Auditoria
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <span data-feather="shopping-cart"></span>
                                Servicios
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="consultar_ticket.php">
                                <span data-feather="layers"></span>
                                Tickets <span class="sr-only">(current)</span>
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
                <?php
                if (empty($_GET['alert'])) {
                    echo "";
                } elseif ($_GET['alert'] == 'error_aceptar') {
                    echo "<div class='alert alert-danger alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4>  <i class='icon fa fa-times-circle'></i> Error inesperado!</h4>
       El ticket no ha sido aceptado correctamente. Por favor intente nuevamente.
      </div>";
                } elseif ($_GET['alert'] == 'exito_aceptar') {
                    echo "<div id='alert' class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Éxito!</h4>
            El ticket ha sido aceptado correctamente. Cuando finalice su actividad, cierre la solicitud por favor.
          </div>";
                }elseif ($_GET['alert'] == 'cerrar_error') {
                    echo "<div class='alert alert-danger alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4>  <i class='icon fa fa-times-circle'></i> Error inesperado!</h4>
       No se ha cerrado el ticket correctamente. Por favor intente nuevamente.
      </div>";
                } elseif ($_GET['alert'] == 'cerrar_exito') {
                    echo "<div id='alert' class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Éxito!</h4>
            El ticket se ha cerrado correctamente. Que tenga buen día.
          </div>";
                }
                ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bienvenido <?= $_SESSION['nombre'] ?> a las consultas de tickets</h1>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Solicitante</th>
                            <th>Departamento</th>
                            <th>Telefono contacto</th>
                            <th>Email</th>
                            <th>Consultar</th>
                            <?php
                            $num = 1;

                            $query2 = "SELECT * FROM ticket WHERE estatus='aceptado'";
                            $result2 = mysqli_query($dbconn, $query2) or die(mysqli_error($dbconn));
                            $data2 = mysqli_fetch_assoc($result2);
                            if ($data2['estatus'] == 'aceptado') {
                                echo "<th>Cerrar</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query = "SELECT a.solicitante, a.departamento, a.telefono_contac, a.email, b.id_usuario, b.nombre FROM ticket as a INNER JOIN usuario as b ON a.solicitante = b.id_usuario WHERE NOT estatus = 'cerrado'";
                        $result = mysqli_query($dbconn, $query) or die(mysqli_error($dbconn));
                        while ($data = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $num ?></td>
                                <td><?= $data['nombre'] ?></td>
                                <td><?= $data['departamento'] ?></td>
                                <td><?= $data['telefono_contac'] ?></td>
                                <td><?= $data['email'] ?></td>
                                <td><a href="ticket.php?id=<?= $data['solicitante'] ?>" class="btn btn-success">Consultar</a></td>
                                <?php
                                $query3 = "SELECT * FROM ticket WHERE estatus='aceptado' AND solicitante='$data[solicitante]'";
                                $result3 = mysqli_query($dbconn, $query3) or die(mysqli_error($dbconn));

                                if ($data3 = mysqli_fetch_assoc($result3)) {
                                    if ($data3['estatus'] == 'aceptado') {
                                ?>
                                        <td><a href="../php/cerrar_ticket.php?id=<?= $data['solicitante'] ?>" class="btn btn-danger" onclick="return confirm('¿Seguro quiere cerrar la solicitud?');">Cerrar</a></td>
                                <?php
                                    } else {
                                        echo "<td></td>";
                                    }
                                }
                                ?>
                            </tr>
                        <?php
                            $num++;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h2 class="h3">Tabla de solicitudes cerradas</h2>
                </div>
                <table class="table">
                    <thead class="thead-dark"> 
                        <tr>
                            <th>#</th>
                            <th>Solicitante</th>
                            <th>Departamento</th>
                            <th>Telefono contacto</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $query_cerrado = "SELECT a.solicitante, a.departamento, a.telefono_contac, a.email, b.id_usuario, b.nombre FROM ticket as a INNER JOIN usuario as b ON a.solicitante = b.id_usuario WHERE estatus='cerrado'";
                        $result_cerrado = mysqli_query($dbconn, $query_cerrado) or die(mysqli_error($dbconn));
                        while ($data2 = mysqli_fetch_assoc($result_cerrado)) {
                        ?>
                            <tr>
                                <td><?= $num ?></td>
                                <td><?= $data2['nombre'] ?></td>
                                <td><?= $data2['departamento'] ?></td>
                                <td><?= $data2['telefono_contac'] ?></td>
                                <td><?= $data2['email'] ?></td>                     
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