<?php require_once "includes/head.inc.php" ?>

<body>
  <?php
  include_once "includes/header.inc.php";
  include_once "includes/menuSidebar.inc.php";

  require_once 'funciones/conexion.php';
  include_once "funciones/select_marcas.php";
  include_once "funciones/validacion_registro_camion.php";
  include_once "funciones/insertar_camiones.php"; // No olvidarse de hacer todos los includes jeje
  // <-<-<- Listar lo necesario para trabajar en este script ->->->
  $MiConexion =  ConexionBD();
  $ListadoMarcas = ListarMarcas($MiConexion);

  $Mensaje = "";
  $MensajeOk = "";
  if (!empty($_POST['BotonRegistrar'])) {
    $Mensaje = Validar_Datos();
    $DatoFaltante = DatoRequerido();
    if (empty($Mensaje)) {
      if (InsertarCamiones($MiConexion) != false) {
        $MensajeOk = 'Se ha registrado correctamente.';
        $_POST = array();
        $Estilo = 'success';
      }
    }
  }

  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Registrar un nuevo transporte</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Transportes</li>
          <li class="breadcrumb-item active">Carga Camión</li>
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
                  <label for="selector" class="form-label">Marca (*)</label>
                  <select class="form-select" aria-label="Selector" id="selector" name="MARCA">
                    <option value="">Selecciona una opción</option>
                    <?php foreach ($ListadoMarcas as $marca) { ?>
                      <!-- * Se asigna el "COD_MARCA" de la marca como el valor del "option".
                            *Se utiliza la condición ternaria para agregar el atributo "selected" a la opción que coincide con el valor enviado en $_POST['Marca'] -->
                      <option value="<?php echo $marca["COD_MARCA"]; ?>" <?php echo (!empty($_POST["MARCA"]) && $_POST["MARCA"] == $marca["COD_MARCA"]) ? "selected" : ''; ?>>
                        <?php echo $marca["NOM_MARCA"]; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-12">
                  <label for="modelo" class="form-label">Modelo (*)</label>
                  <input type="text" class="form-control" id="modelo" name="MODELO" value="<?php echo !empty($_POST['MODELO']) ? $_POST['MODELO'] : ''; ?>">
                </div>

                <div class="col-12">
                  <label for="año" class="form-label">Año</label>
                  <input type="text" class="form-control" id="año" name="ANIO" value="<?php echo !empty($_POST['ANIO']) ? $_POST['ANIO'] : ''; ?>">
                </div>

                <div class="col-12">
                  <label for="patente" class="form-label">Patente (*)</label>
                  <input type="text" class="form-control" id="patente" name="PATENTE" value="<?php echo !empty($_POST['PATENTE']) ? $_POST['PATENTE'] : ''; ?>">
                </div>

                <div class="col-12">
                  <label class="form-label">Disponibilidad</label>
                  <div class="form-check">
                    <!--  <-<-<- Campo oculto para enviar 0 cuando el checkbox no está marcado->->-> -->
                    <input type="hidden" name="HABILITADO" value="0">
                    <!--  <-<-<-   ->->->  -->
                   <!--  <-<-<- Checkbox para enviar 1 cuando está marcado ->->->  -->
                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="HABILITADO" value="1" <?php echo (!empty($_POST["HABILITADO"]) && $_POST["HABILITADO"] == "1") ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="gridCheck1"> Habilitado</label>
                  </div>
                </div>

                <?php print_r($_POST) ?>


                <div class="text-center">
                  <button class="btn btn-primary" type="submit" value="Registrar" name="BotonRegistrar">Registrar</button>
                  <button type="reset" class="btn btn-secondary" >Limpiar Campos</button>
                  <a href="index.php" class="text-primary fw-bold">Volver al index</a>
                </div>
              </form><!-- Vertical Form -->

            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
</body>
<?php include_once "includes/footer.inc.php" ?>

</html>