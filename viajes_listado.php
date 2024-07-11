<?php include_once "includes/head.inc.php" ?>

<body>
  <?php include_once "includes/header.inc.php" ?>
  <?php include_once "includes/menuSidebar.inc.php" ?>

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
                  <tr class="table-success" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Viaje realizado">
                    <th scope="row">1</th>
                    <td>02/06/2024</td>
                    <td>Capilla del Monte</td>
                    <td>Iveco - Daily Furgon - AC206JK</td>
                    <td>Alvarez, Marcos</td>
                    <td>$ 300.000</td>
                    <td>$ 30.000 (10%)</td>
                  </tr>

                  <tr class="table-danger" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Viaje de hoy">
                    <th scope="row">2</th>
                    <td>03/06/2024</td>
                    <td>Morteros</td>
                    <td>Scania - Serie P - AA322CX</td>
                    <td>Rodriguez, Ariel</td>
                    <td>$ 100.000</td>
                    <td>$ 15.000 (15%)</td>
                  </tr>

                  <tr class="table-danger" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Viaje de hoy">
                    <th scope="row">3</th>
                    <td>03/06/2024</td>
                    <td>Toledo</td>
                    <td>Iveco - Daily Chasis - AD698HA</td>
                    <td>Zapata, Joaquin </td>
                    <td>$ 250.000</td>
                    <td>$ 25.000 (10%)</td>
                  </tr>

                  <tr class="table-warning" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-original-title="Viaje de mañana">
                    <th scope="row">4</th>
                    <td>04/06/2024</td>
                    <td>Capilla del Monte</td>
                    <td>Scania - Serie P - AA322CX</td>
                    <td>Perez, Juan </td>
                    <td>$ 350.000</td>
                    <td>$ 70.000 (20%)</td>
                  </tr>

                  <tr>
                    <th scope="row">5</th>
                    <td>10/06/2024</td>
                    <td>Capilla del Monte</td>
                    <td>Scania - Serie P - AA322CX</td>
                    <td>Perez, Juan </td>
                    <td>$ 350.000</td>
                    <td>$ 70.000 (20%)</td>
                  </tr>


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