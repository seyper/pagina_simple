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
  <?php
  if (empty($_GET['alert'])) {
    echo "";
  } elseif ($_GET['alert'] == 'reg_errado') {
    echo "<div class='alert alert-danger alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4>  <i class='icon fa fa-times-circle'></i> Error inesperado!</h4>
       El registro del usuario no se ha posido completar. Por favor intente más tarde.
      </div>";
  } elseif ($_GET['alert'] == 'reg_exitoso') {
    echo "<div id='alert' class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Éxito!</h4>
            El usuario se ha registrado correctamente. Si lo desea pruebe iniciando sesión.
          </div>";
  } elseif ($_GET['alert'] == 'error_sesion') {
    echo "<div class='alert alert-danger alert-dismissable'>
    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
    <h4>  <i class='icon fa fa-times-circle'></i> Error inesperado!</h4>
       Su usuario o contraseña son inválidos. Por favor intente nuevamente.
      </div>";
  } elseif ($_GET['alert'] == 'salida') {
    echo "<div id='alert' class='alert alert-success alert-dismissable'>
            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            <h4>  <i class='icon fa fa-check-circle'></i> Éxito!</h4>
            Se ha salido de la sesión correctamente. Que tenga un buen día.
          </div>";
  }
  ?>
  <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
      <div class="inner">
        <h3 class="masthead-brand">Soporte Técnico</h3>
        <nav class="nav nav-masthead justify-content-center">
          <a class="nav-link active" href="index.php">Inicio</a>
          <a class="nav-link" href="registro_usuarios.php">Registro de usuarios</a>
          <a class="nav-link" href="inicio_sesion.php">Inicio de sesión</a>
          <a class="nav-link" href="contacto.php">Contacto</a>
        </nav>
      </div>
    </header>

    <main role="main" class="inner cover">
      <h1 class="cover-heading">Soporte de confianza</h1>
      <p class="lead">Si deseas saber más, entra en el link y registrate como un nuevo usuario.</p>
      <p class="lead">
        <a href="registro_usuarios.php" class="btn btn-lg btn-secondary">Registrarse</a>
      </p>
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

</body>

</html>