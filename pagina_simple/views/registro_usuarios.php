<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Soporte Técnico</title>

    <!-- Bootstrap importante CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos customizados de esta página -->
    <link rel="stylesheet" href="../css/main.css">
</head>

<body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Soporte Técnico</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link" href="../index.php">Inicio</a>
                    <a class="nav-link active" href="registro_usuarios.php">Registro de usuarios</a>
                    <a class="nav-link" href="inicio_sesion.php">Inicio de sesión</a>
                    <a class="nav-link" href="contacto.php">Contacto</a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <div id="error" class="alert alert-danger ocultar" role="alert">
                Las contraseñas no coinciden, vuelva a intentar.
            </div>
            <div id="ok" class="alert alert-success ocultar" role="alert">
                Las contraseñas coinciden. Procesando formulario...
            </div>
            <h2>
                Registrar usuario
            </h2>
            <form action="../control/registro.php" method="post" id="form">
                <div class="row">
                    <div class="col-4">
                        <label for="">
                            Nombre:
                        </label>
                        <input type="text" name="nombre" id="" class="form-control" required minlength="3"  onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))">
                    </div>
                    <div class="col-4">
                        <label for="">
                            Apellido:
                        </label>
                        <input type="text" name="apellido" id="" class="form-control"  onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32) || (event.charCode == 209) || (event.charCode == 241))">
                    </div>
                    <div class="col-4">
                        <label for="">
                            Correo:
                        </label>
                        <input type="email" name="correo" id="" class="form-control" required minlength="3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <label for="">
                            Contraseña:
                        </label>
                        <input type="password" name="contra" id="contra" class="form-control" required>
                    </div>
                    <div class="col-lg-6 col-6">
                        <label for="">
                            Repetir contraseña:
                        </label>
                        <input type="password" class="form-control" id="contra2"  required>
                    </div>
                </div>
                <div class="row mt-3 d-flex justify-content-center">
                    <input type="submit" value="Registrar" class="btn btn-success btn-lg">
                </div>
            </form>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">

            </div>
        </footer>
    </div>




    <!-- Bootstrap importante JavaScript
    ================================================== -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/validacion.js"></script>

</body>

</html>