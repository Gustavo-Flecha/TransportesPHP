<?php require_once "includes/head.inc.php" ?>

<body>

  <?php
  require_once 'funciones/conexion.php';
  $MiConexion = ConexionBD();

  require_once 'funciones/validacion_registro_usuario.php';
  require_once 'funciones/insertar_usuarios.php';

  $Mensaje = "";
  $MensajeOk = "";
  if (!empty($_POST['BotonRegistrar'])) {
    $Mensaje = Validar_Datos();
    $DatoFaltante = DatoRequerido();
    if (empty($Mensaje)) {
      if (InsertarUsuarios($MiConexion) != false) {
        $MensajeOk = 'Se ha registrado correctamente.';
        $_POST = array();
        $Estilo = 'success';
      }
    }
  }
  ?>

  <?php include_once "includes/header.inc.php" ?>
  <?php include_once "includes/menuSidebar.inc.php" ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Registrar un nuevo chofer</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Transportes</li>
          <li class="breadcrumb-item active">Carga Chofer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Ingresa los datos</h5>

              <?php if (!empty($DatoFaltante)) { ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                  <i class="bi bi-info-circle me-1"></i>
                  El campo <?php echo $DatoFaltante; ?> (*) es requerido
                </div>
              <?php } ?> <!-- // <-<-<- End required messenger ->->-> -->

              <?php if (!empty($Mensaje)) { ?>
                <div class="alert alert-warning alert-dismissible fade show">
                  <i class="bi bi-exclamation-triangle me-1"></i>
                  <?php echo $Mensaje; ?>
                </div>
              <?php } ?> <!-- // <-<-<- End validation warning  messenger ->->-> -->

              <?php if (!empty($MensajeOk)) { ?>
                <div class="alert alert-success alert-dismissible fade show">
                  <i class="bi bi-check-circle me-1"></i>
                  <?php echo $MensajeOk; ?>
                </div>
              <?php } ?><!-- // <-<-<- End Success messenger ->->-> -->

              <form class="row g-3" method="post">

                <div class="col-12">
                  <label for="Apellido" class="form-label">Apellido (*)</label>
                  <input type="text" class="form-control" id="apellido" name="APELLIDO" value="<?php echo !empty($_POST['APELLIDO']) ? $_POST['APELLIDO'] : ''; ?>">
                </div>

                <div class="col-12">
                  <label for="Nombre" class="form-label">Nombre (*)</label>
                  <input type="text" class="form-control" id="nombre" name="NOMBRE" value="<?php echo !empty($_POST['NOMBRE']) ? $_POST['NOMBRE'] : ''; ?>">
                </div>

                <div class="col-12">
                  <label for="dni" class="form-label">DNI (*)</label>
                  <input type="text" class="form-control" id="dni" name="DNI" value="<?php echo !empty($_POST['DNI']) ? $_POST['DNI'] : ''; ?>">
                </div>
                <div class="col-12">
                  <label for="user" class="form-label">Usuario</label>
                  <input type="text" class="form-control" id="user" name="USUARIO" value="<?php echo !empty($_POST['USUARIO']) ? $_POST['USUARIO'] : ''; ?>">
                </div>
                <div class="col-12">
                  <label for="pass" class="form-label">Clave</label>
                  <input type="text" class="form-control" id="pass" name="PASS" value="<?php echo !empty($_POST['PASS']) ? $_POST['PASS'] : ''; ?>">
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary" value="Registrar" name="BotonRegistrar">Registrar</button>
                  <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
                  <a href="index.php" class="text-primary fw-bold">Volver al index</a>
                </div>
              </form>
              <?php
              print_r($_POST);
              ?>

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->
</body>

<?php include_once "includes/footer.inc.php" ?>

</html>