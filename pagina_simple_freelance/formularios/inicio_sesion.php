<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Soporte Técnico</title>

    <!-- Bootstrap importante CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos customizados de esta página -->
    <link rel="stylesheet" href="../assets/css/main.css">
</head>

<body class="text-center">

    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Soporte Técnico</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link" href="../index.php">Inicio</a>
                    <a class="nav-link" href="registro_usuarios.php">Registro de usuarios</a>
                    <a class="nav-link active" href="inicio_sesion.php">Inicio de sesión</a>
                    <a class="nav-link" href="contacto.php">Contacto</a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover ">
            <h2>
                Iniciar sesión
            </h2>
            <form action="../php/login-check.php" method="post" id="form">
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-6">
                        <label for="">
                            Correo:
                        </label>
                        <input type="email" name="correo" id="" class="form-control" required autocomplete="off" oninvalid="setCustomValidity('El correo es obligatorio')">
                        <input type="hidden" name="fecha_entrada" value="<?= date("Y-m-d H:i:s") ?>">
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-6">
                        <label for="">
                            Contraseña:
                        </label>
                        <input type="password" name="contra" id="" class="form-control" required oninvalid="setCustomValidity('La contraseña no puede estar vacía')">
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    <input type="submit" value="Iniciar sesión" class="btn btn-success btn-lg">
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
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/validacion.js"></script>

</body>

</html>