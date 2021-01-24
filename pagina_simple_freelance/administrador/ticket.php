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
                            <a class="nav-link" href="admin.php">
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
                            <a class="nav-link active" href="consultar_ticket.php">
                                <span data-feather="layers"></span>
                                Tickets<span class="sr-only">(current)</span>
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
                    <h1 class="h2">Bienvenido <?= $_SESSION['nombre'] ?> a la consulta de tickets</h1>
                </div>
                <form action="../php/aceptar_ticket.php" method="POST">
                    <?php
                    $id = $_GET['id'];
                    $query = "SELECT * FROM ticket WHERE solicitante = '$id'";
                    $result = mysqli_query($dbconn, $query);
                    $data = mysqli_fetch_assoc($result);
                    if ($data['estatus'] == 'aceptado') {
                        $estatus = true;
                        echo "<div class='alert alert-danger alert-dismissable'>
                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                            <h4>  <i class='icon fa fa-times-circle'></i> Alerta!</h4>
                            Este ticket ya ha sido aceptado. No podrá aceptarse nuevamente.
                        </div>";
                    } else {
                        $estatus = false;
                    }
                    ?>
                    <h3>Consultar ticket</h3>
                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <label for="">Departamento</label>
                            <input type="hidden" name="id" value="<?=$id?>">
                            <select name="departamento" id="" class="form-control">
                                <option value="<?= $data['departamento'] ?>"><?= $data['departamento'] ?></option>
                                <?php
                                    if($data['departamento'] == 'hardware'){
                                        echo '<option value="software">software</option>';
                                        echo '<option value="ventas">ventas</option>';
                                    }else if ($data['departamento'] == 'software'){
                                        echo '<option value="hardware">hardware</option>';
                                        echo '<option value="ventas">ventas</option>';
                                    }else {
                                        echo '<option value="hardware">hardware</option>';
                                        echo '<option value="software">software</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-lg-4 col-xl-4">
                            <label for="">Teléfono contacto</label>
                            <input type="text" name="telefono_contac" id="" class="form-control"  value="<?= $data['telefono_contac'] ?>">
                        </div>
                        <div class="col-lg-4 col-xl-4">
                            <label for="">Correo electrónico</label>
                            <input type="text" name="email" id="" class="form-control"  value="<?= $data['email'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <label for="">Problema</label>
                            <textarea name="problema" id="" cols="30" rows="10" class="form-control" ><?= $data['problema'] ?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            if ($estatus) {
                            ?>
                                <input type="button" value="Aceptar" class="btn btn-primary">
                            <?php
                            } else {
                            ?>
                                <input type="submit" value="Aceptar" class="btn btn-primary">
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>

    <!-- Bootstrap importante JavaScript
    ================================================== -->

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/validacion.js"></script>

    <!-- Iconos -->
    <script src="../assets/js/feather.min.js"></script>
    <script>
        feather.replace()
    </script>
</body>

</html>