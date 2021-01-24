<!doctype html>
<html lang="es">
<?php
require_once '../php/conexion.php';
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit();
}

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bandeja de Entrada</title>

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
                            <a class="nav-link active" href="admin.php">
                                <span data-feather="home"></span>
                                Inicio <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="actualizar_usuario.php">
                                <span data-feather="user"></span>
                                Actualizar usuario
                            </a>
                        </li>
                        <?php
                        if ($_SESSION['permiso'] == 'admin') {
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" href="auditoria.php">
                                    <span data-feather="bar-chart-2"></span>
                                    Auditoria
                                </a>
                            </li>
                        <?php
                        }
                        ?>
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
                            } else {
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
                <?php
                if (empty($_GET['alert'])) {
                    echo "";
                } elseif ($_GET['alert'] == 'modf_exito') {
                    echo "<div id='alert' class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4>  <i class='icon fa fa-check-circle'></i> Éxito!</h4>
                        La contraseña se ha cambiado correctamente.
                    </div>";
                } elseif ($_GET['alert'] == 'error_ticket') {
                    echo "<div class='alert alert-danger alert-dismissable'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <h4>  <i class='icon fa fa-times-circle'></i> Error inesperado!</h4>
                       El ticket no se ha enviado correctamente. Por favor intente nuevamente.
                      </div>";
                } elseif ($_GET['alert'] == 'exito_ticket') {
                    echo "<div id='alert' class='alert alert-success alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4>  <i class='icon fa fa-check-circle'></i> Éxito!</h4>
                            El ticket se ha enviado correctamente. En cuanto lo acepten, recibirá una respuesta.
                          </div>";
                }
                $id = $_SESSION['id'];

                $query = "SELECT `id_ticket`, `solicitante`, `departamento`, `telefono_contac`, `email`, `problema`, `estatus` FROM `ticket` WHERE solicitante='$id'";
                $result = mysqli_query($dbconn, $query) or die('Error al avisar del ticket aceptado' . mysqli_error($dbconn));

                if ($data = mysqli_fetch_assoc($result)) {
                    if ($data['estatus'] == 'aceptado') {
                        echo "<div id='alert' class='alert alert-success alert-dismissable'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4>  <i class='icon fa fa-check-circle'></i> Éxito!</h4>
                        Su ticket ha sido aceptado correctamente. Por favor espere a que lo contacten.
                      </div>";
                    } else {
                        echo "";
                    }
                } else {
                    echo "";
                }
                ?>
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bienvenido <?= $_SESSION['nombre'] ?> a la bandeja de entrada</h1>
                </div>
                <?php
                if ($_SESSION['permiso'] == 'admin') {
                ?>
                    <div class="row">
                        <div class="col-lg-3 col-xs-3">
                            <!-- small box -->
                            <div style="background-color:#00c0ef;color:#fff" class="small-box">
                                <div class="inner">
                                    <?php
                                    $query = mysqli_query($dbconn, "SELECT COUNT(id_usuario) as numero FROM usuario")
                                        or die('Error ' . mysqli_error($dbconn));
                                    $data = mysqli_fetch_assoc($query);
                                    ?>
                                    <h6>Cantidad de usuarios</h6>

                                    <h3><?php echo $data['numero']; ?></h3>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a class="small-box-footer"><i class="fa"></i></a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div style="background-color:#f39c12;color:#fff" class="small-box">
                                <div class="inner">
                                    <?php
                                    $query = mysqli_query($dbconn, "SELECT COUNT(id) as numero FROM auditoria")
                                        or die('Error' . mysqli_error($dbconn));
                                    $data = mysqli_fetch_assoc($query);
                                    ?>
                                    <h6>Cantidad de auditorías</h6>
                                    <h3><?php echo $data['numero']; ?></h3>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <a href="" class="small-box-footer"><i class="fa"></i></a>
                            </div>
                        </div><!-- ./col -->
                    <?php
                }
                    ?>
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div style="background-color:#FE2E2E;color:#fff" class="small-box">
                            <div class="inner">
                                <?php
                                if ($_SESSION['permiso'] == 'admin') {
                                    $query = mysqli_query($dbconn, "SELECT COUNT(id_ticket) as numero FROM ticket")
                                        or die('Error' . mysqli_error($dbconn));
                                } else {
                                    $id = $_SESSION['id'];
                                    $query = mysqli_query($dbconn, "SELECT COUNT(id_ticket) as numero FROM ticket WHERE solicitante='$id'")
                                        or die('Error' . mysqli_error($dbconn));
                                }
                                $data = mysqli_fetch_assoc($query);
                                ?>
                                <h6>Cantidad de tickets</h6>
                                <h3><?php echo $data['numero']; ?></h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-database"></i>
                            </div>
                            <a href="" class="small-box-footer"><i class="fa"></i></a>
                        </div>
                    </div><!-- ./col -->

                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div style="background-color:#04B404;color:#fff" class="small-box">
                            <div class="inner">
                                <?php
                                if ($_SESSION['permiso'] == 'admin') {
                                    $query = mysqli_query($dbconn, "SELECT COUNT(id_ticket) as numero FROM ticket WHERE estatus = 'cerrado'")
                                        or die('Error' . mysqli_error($dbconn));
                                } else {
                                    $id = $_SESSION['id'];
                                    $query = mysqli_query($dbconn, "SELECT COUNT(id_ticket) as numero FROM ticket WHERE solicitante='$id' AND estatus = 'cerrado'")
                                        or die('Error' . mysqli_error($dbconn));
                                }
                                $data = mysqli_fetch_assoc($query);
                                ?>
                                <h6>Tickets terminados</h6>
                                <h3><?php echo $data['numero']; ?></h3>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <a href="" class="small-box-footer"><i class="fa"></i></a>
                        </div>
                    </div><!-- ./col -->
                    </div>
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