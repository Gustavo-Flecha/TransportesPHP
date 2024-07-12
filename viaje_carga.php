<?php include_once "includes/head.inc.php" ?>

<body>
  <?php 
  include_once "includes/header.inc.php";
  include_once "includes/menuSidebar.inc.php";

  require_once 'funciones/conexion.php';
  include_once "funciones/listadosGet.php";
  include_once "funciones/validacion_registro_viaje.php";
  include_once "funciones/insertar_viajes.php"; 

  // <-<-<- Listar lo necesario para trabajar en este script ->->->
  $MiConexion =  ConexionBD();
  $ListadoTrasnporte = ListarTransportes($MiConexion);
  $ListadoChofer = ListarChoferesActivos($MiConexion);
  $ListadoDestino =  ListarDestinos($MiConexion);

  $Mensaje = "";
  $MensajeOk = "";
  if (!empty($_POST['BotonRegistrar'])) {
    $Mensaje = Validar_Datos();
    (!empty($Mensaje))? $DatoFaltante=" " : $DatoFaltante=""; //Datos faltantes 
    if (empty($Mensaje)) {
      if (InsertarViajes($MiConexion) !== false) {
        $MensajeOk = 'Se ha registrado correctamente.';
        $_POST = array();// Reiniciar el formulario
        $Estilo = 'success';
      }else {
        $Mensaje = 'Hubo un error al registrar el camión.';
    }
    }
  }
  
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Registrar un nuevo viaje</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Viajes</li>
          <li class="breadcrumb-item active">Carga</li>
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
                  Los campos con <?php echo $DatoFaltante; ?> (*) son necesarios
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
                  <label for="selector" class="form-label">Chofer (*)</label>
                  <select class="form-select" aria-label="Selector" id="selector" name="CHOFER">
                    <option value="">Selecciona una opción</option>
                    <?php foreach ($ListadoChofer as $chofer) { ?>
                      <!-- * Se asigna el "COD_MARCA" de la chofer como el valor del "option".
                            *Se utiliza la condición ternaria para agregar el atributo "selected" a la opción que coincide con el valor enviado en $_POST['Marca'] -->
                      <option value="<?php echo $chofer["ID_USER"]; ?>" <?php echo (!empty($_POST["CHOFER"]) && $_POST["CHOFER"] == $chofer["ID_USER"]) ? "selected" : ''; ?>>
                        <?php echo $chofer["NOMBRE"]. ', '.$chofer["APELLIDO"]. ' - (DNI '.$chofer["DNI"].')'; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-12">
                  <label for="selector" class="form-label">Transporte (*)</label>
                  <select class="form-select" aria-label="Selector" id="selector" name="TRANSPORTE">
                    <option value="">Selecciona una opción</option>
                    <?php foreach ($ListadoTrasnporte as $transporte) { ?>
                      <!-- * Se asigna el "ID_PATENTE" de la transporte como el valor del "option".
                            *Se utiliza la condición ternaria para agregar el atributo "selected" a la opción que coincide con el valor enviado en $_POST['TRANSPORTE'] -->
                      <option value="<?php echo $transporte["ID_PATENTE"]; ?>" 
                      <?php echo (!empty($_POST["TRANSPORTE"]) && $_POST["TRANSPORTE"] == $transporte["ID_PATENTE"]) ? "selected" : ''; ?> >
                        <?php echo $transporte["NOM_MARCA"].' - '.$transporte["NOM_MODELO"]. ' - '.$transporte["PATENTE"]; ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>

                <div class="col-12">
                  <label for="fecha" class="form-label">Fecha programada (*)</label>
                  <input type="date" class="form-control" id="fecha" name="FECHA" value="<?php echo !empty($_POST['FECHA']) ? $_POST['FECHA'] : ''; ?>">
                </div>

                <div class="col-12">
                  <label for="selector" class="form-label">Destino (*)</label>
                  <select class="form-select" aria-label="Selector" id="selector" name="DESTINO">
                    <option value="">Selecciona una opcion</option>
                    <?php foreach ($ListadoDestino as $destino) { ?>
                      <!-- * Se asigna el "COD_CIU" deL destino como el valor del "option".
                            *Se utiliza la condición ternaria para agregar el atributo "selected" a la opción que coincide con el valor enviado en $_POST['DESTINO'] -->
                      <option value="<?php echo $destino["COD_CIU"]; ?>" <?php echo (!empty($_POST["DESTINO"]) && $_POST["DESTINO"] == $destino["COD_CIU"]) ? "selected" : ''; ?>>
                        <?php echo $destino["NOM_CIUDAD"]; ?>
                      </option>
                    <?php } ?>                    
                  </select>
                </div>

                <div class="col-12">
                  <label for="costo" class="form-label">Costo (*)</label>
                  <input type="text" class="form-control" id="costo" name="COSTO" value="<?php echo !empty($_POST['COSTO']) ? $_POST['COSTO'] : ''; ?>">
                </div>

                <div class="col-12">
                  <label for="porc" class="form-label">Porcentaje chofer (*)</label>
                  <input type="text" class="form-control" id="porc" name="PORCENTAJE" value="<?php echo !empty($_POST['PORCENTAJE']) ? $_POST['PORCENTAJE'] : ''; ?>">
                </div>
                <?php print_r($_POST) ?>

                <div class="text-center">
                <button class="btn btn-primary" type="submit" value="Registrar" name="BotonRegistrar">Registrar</button>
                  <button type="reset" class="btn btn-secondary">Limpiar Campos</button>
                  <a href="index.php" class="text-primary fw-bold">Volver al index</a>
                </div>

              </form><!-- Vertical Form -->
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script> -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>-->
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>

  <!--<script src="assets/vendor/php-email-form/validate.js"></script> -->

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>