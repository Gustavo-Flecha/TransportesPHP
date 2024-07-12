<?php include_once "includes/head.inc.php" ?>

<body>
  <?php
  include_once "includes/header.inc.php";
  include_once "includes/menuSidebar.inc.php";
  include_once "funciones/conexion.php";
  include_once "funciones/listadosGet.php";

  // <-<-<- Listar lo necesario para trabajar en este script ->->->
  $MiConexion =  ConexionBD();
  $ListadoViajes = ListarViajes($MiConexion);

  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Lista de viajes registrados</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Viajes</li>
          <li class="breadcrumb-item active">Listado</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">


          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Viajes cargados</h5>

              <!-- Default Table -->
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fecha Viaje</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Camión</th>
                    <th scope="col">Chofer</th>
                    <th scope="col">Costo Viaje</th>
                    <th scope="col">Monto Chofer</th>
                  </tr>
                </thead>

                <tbody>
                  <?php date_default_timezone_set("America/Argentina/Cordoba");
                  $i = 0;

                  foreach ($ListadoViajes as $viajes) {

                    $i++;
                    $comunicado = "";
                    $color = "";
                    $Fecha_viaje = date("Y-m-d", strtotime($viajes["FECHA_SALIDA"]));
                    //defino la fecha de hoy
                    $Fecha_actual = date("Y-m-d");
                    //de esta manera sabemos cual es la fecha de mañana (sumamos un dia a hoy)
                    $Maniana = date("Y-m-d", strtotime($Fecha_actual . "+ 1 day"));
                    //la fecha del viaje es menor a hoy?
                    if ($Fecha_viaje < $Fecha_actual) {
                      $comunicado = "¡Viaje realizado!";
                      $color = "success";
                    }
                    //la fecha del viaje es para hoy?
                    elseif ($Fecha_viaje == $Fecha_actual) {
                      $comunicado = "¡El viaje es hoy!";
                      $color = "danger";
                    } elseif ($Fecha_viaje == $Maniana) {
                      $comunicado = "¡El viaje es mañana!";
                      $color = "warning";
                    } elseif ($Fecha_viaje > $Fecha_actual) {
                      $comunicado = "¡El viaje se hará pronto!";
                      $color = "info";
                    }

                    $montoChofer = ((($viajes["COSTO_VIAJE"]) * ($viajes["PORCENTAJE_CHOFER"])) / 100);
                    $montoFormateado = number_format($montoChofer, 0, '', '.');
                  ?>
                    <tr class="table-<?php echo $color ?>" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="<?php echo $comunicado ?>">
                      <th scope="row"><?php echo $i ?></th>
                      <td><?php echo date('d/m/y', strtotime($viajes["FECHA_SALIDA"])) ?></td>
                      <td><?php echo $viajes["NOM_CIUDAD"] ?></td>
                      <td><?php echo $viajes["NOM_MARCA"] . ' - ' . $viajes["NOM_MODELO"] . ' - ' . $viajes["PATENTE"]; ?></td>
                      <td><?php echo $viajes["APELLIDO"] . ', ' . $viajes["NOMBRE"]; ?></td>
                      <td>$<?php echo  number_format($viajes["COSTO_VIAJE"], 0, '', '.') ?></td>
                      <td>$<?php echo $montoFormateado . '(' . ($viajes["PORCENTAJE_CHOFER"]) . '%)' ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <!-- End Default Table Example -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
</body>
<?php include_once "includes/footer.inc.php" ?>

</html>