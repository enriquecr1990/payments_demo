<?php include_once('private/helper/ComunHelper.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
     <link rel="icon" sizes="32x32" href="https://www.paypalobjects.com/webstatic/developer/favicons/pp32.png">

     <title>PayPal - subscripciones</title>

</head>

<body>

     <div class="container">

          <h1 class="mt-5 mb-3">Demo PayPal Subscripciones</h1>

          <div class="accordion" id="accordionExample">
               <div class="accordion-item">
                    <h2 class="accordion-header">
                         <button class="accordion-button" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseProductos" aria-expanded="true"
                              aria-controls="collapseProductos">
                              Productos
                         </button>
                    </h2>
                    <div id="collapseProductos" class="accordion-collapse collapse show"
                         data-bs-parent="#accordionExample">
                         <div class="accordion-body">
                              <?php include('subscripcion/tablero_productos.php'); ?>
                         </div>
                    </div>
               </div>
               <div class="accordion-item">
                    <h2 class="accordion-header">
                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapsePlanes" aria-expanded="false" aria-controls="collapsePlanes">
                              Planes de subscripción
                         </button>
                    </h2>
                    <div id="collapsePlanes" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                         <div class="accordion-body">

                         </div>
                    </div>
               </div>
               <div class="accordion-item">
                    <h2 class="accordion-header">
                         <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseSubscripciones" aria-expanded="false"
                              aria-controls="collapseSubscripciones">
                              Subscripciones
                         </button>
                    </h2>
                    <div id="collapseSubscripciones" class="accordion-collapse collapse"
                         data-bs-parent="#accordionExample">
                         <div class="accordion-body">

                         </div>
                    </div>
               </div>
          </div>

     </div>

     <div class="toast-container top-0 end-0 p-3" id="contenedor_mensajes_toast"></div>

     <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>-->
     <script src="js/jquery-3.4.1.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
          integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
          crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
          integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y"
          crossorigin="anonymous"></script>
     <!-- scritps para el pago -->
     <script src="js/paypal_subs.js"></script>
     <script>
          var base_url = '<?= ComunHelper::base_url() ?>';
     </script>

</body>

</html>