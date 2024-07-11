<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>2do Desempeño</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <!--<link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">-->
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <?php
  session_start();
  //print_r($_SESSION);
  require_once 'funciones/conexion.php';
  require_once 'funciones/login_db.php';
  $MiConexion = ConexionBD();


  $UserLogedd = array();
  $Mensaje = '';
  if (!empty($_POST['BotonLogin'])) {

    if (empty($_POST['UserName'])) {
      $Mensaje = " Debe ingresar su usuario";
    } elseif (empty($_POST['Password'])) {
      $Mensaje = "Debe ingresar su clave";
    } else {



      $UserLogedd = DatosLogin(trim($_POST['UserName']), $_POST['Password'], $MiConexion);

      //la consulta con la BD para que encuentre un usuario registrado con el usuario y clave brindados
      if (!empty($UserLogedd)) {
        // $Mensaje ='ok! ya puedes ingresar';

        //generar los valores del usuario (esto va a venir de mi BD)
        $_SESSION['Usuario_Nombre']     =   $UserLogedd['NOMBRE'];
        $_SESSION['Usuario_Apellido']   =   $UserLogedd['APELLIDO'];
        $_SESSION['Usuario_Nivel']      =   $UserLogedd['NIVEL'];

        if ($UserLogedd['ESTADO'] == 0) {
          $Mensaje = 'Ud. no se encuentra activo en el sistema.';
        } else {
          header('Location: index.php');
          // exit;
        }
      } else {
        $Mensaje = 'Datos incorrectos, ingresa nuevamente.';
      }
    }
  }
  ?>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block">Panel de Administración</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Ingresa tu cuenta</h5>
                    <p class="text-center small">Ingresa tu datos de usuario y clave</p>

                    <form class="row g-3 needs-validation" method="post">

                      <?php if (!empty($Mensaje)) { ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          <i class="bi bi-exclamation-triangle me-1"></i>
                          <?php echo $Mensaje; ?>
                        </div>
                      <?php } ?>


                      <div class="col-12">
                        <label for="yourUsername" class="form-label">Usuario</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input class="form-control" id="yourUsername" name="UserName" value="<?php echo !empty($_POST['UserName']) ? $_POST['UserName'] : ''; ?>">
                          <div class="invalid-feedback">Ingresa tu usuario.</div>
                        </div>
                      </div>

                      <div class="col-12">
                        <label for="yourPassword" class="form-label">Clave</label>
                        <input class="form-control" id="yourPassword" name="Password">
                        <div class="invalid-feedback">Ingresa tu clave</div>
                      </div>


                      <div class="col-12">
                        <button class="btn btn-primary w-100" type="submit" name="BotonLogin" value="Login">Login</button>
                      </div>
                    </form>

                  </div>
                </div>

                <div class="credits">
                  <!-- All the links in the footer should remain intact. -->
                  <!-- You can delete the links only if you purchased the pro version. -->
                  <!-- Licensing information: https://bootstrapmade.com/license/ -->
                  <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                  Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>

              </div>
            </div>
          </div>

      </section>

    </div>
  </main><!-- End #main -->
</body>
<?php include_once "includes/footer.inc.php" ?>
</html>