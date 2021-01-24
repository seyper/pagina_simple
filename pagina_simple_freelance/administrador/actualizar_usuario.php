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

    <title>Actualización</title>

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
                            <a class="nav-link active" href="actualizar_usuario.php">
                                <span data-feather="user"></span>
                                Actualizar usuario<span class="sr-only">(current)</span>
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
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Bienvenido <?= $_SESSION['nombre'] ?> a la actualización de usuario</h1>
                </div>
                <form action="../php/modificar_usuarios.php" method="POST" id="form">
                    <div id="error" class="alert alert-danger ocultar" role="alert">
                        Las contraseñas no coinciden, vuelva a intentar.
                    </div>
                    <div id="ok" class="alert alert-success ocultar" role="alert">
                        Las contraseñas coinciden. Procesando formulario...
                    </div>
                    <h3>Actualizar Usuario</h3>
                    <div class="row">
                        <div class="col-lg-4 col-xl-4">
                            <?php
                            $id = $_SESSION['id'];
                            $query = "SELECT * FROM usuario WHERE id_usuario='$id'";
                            $result = mysqli_query($dbconn, $query) or die(mysqli_error($dbconn));
                            if ($data = mysqli_fetch_assoc($result)) {
                            ?>
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="" class="form-control" value="<?= $data['nombre'] ?>" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))">
                        </div>
                        <div class="col-lg-4 col-xl-4">
                            <label for="apellido">Apellido</label>
                            <input type="text" name="apellido" id="" class="form-control" value="<?= $data['apellido'] ?>" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))">
                        </div>
                        <div class="col-lg-4 col-xl-4">
                            <label for="correo">Correo</label>
                            <input type="text" name="correo" id="" class="form-control" value="<?= $data['correo'] ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-xl-6">
                            <label for="">Teléfono celular</label>
                            <input type="tel" name="telefono_cel" id="" class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?= $data['telefono_cel'] ?>">
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <label for="">Teléfono fijo</label>
                            <input type="tel" name="telefono_fijo" id="" class="form-control" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" value="<?= $data['telefono_fijo'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12">
                            <label for="">Dirección</label>
                            <input type="text" name="direccion" id="" class="form-control" value="<?= $data['direccion'] ?>">
                        </div>
                    </div>
                <?php
                            }
                ?>
                <div class="row">
                    <div class="col-lg-6 col-xl-6">
                        <label for="contra">Contraseña nueva:</label>
                        <input type="password" name="contra" id="contra" class="form-control"  required>
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <label for="">Repetir contraseña:</label>
                        <input type="password" id="contra2" class="form-control"   required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <input type="submit" value="Actualizar" class="btn btn-primary">
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