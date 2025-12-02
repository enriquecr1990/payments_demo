<?php $cliend_id = 'Af-yarH2_LYxebYrY8w5rbVwklhjjQzI7AjMzpSqwcY4gkWBhWbO8JTNrzVA3HRUfqrjpUzPpUCzKctv'; ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?=$cliend_id?>&vault=true&intent=subscription"></script>
<div class="row">
     <div class="form-group col-12">
          <div class="alert alert-info">
               Para poder agregar una subscripcion primero de click en un plan de "Planes de subscripcion" en el boton VERDE de "crear subscripcion"
          </div>
     </div>
</div>
<div class="row">
     <div class="form-group col-12">
          <div class="alert alert-success">
               Se esta subscribiendo al plan <span id="plan_seleccionado_subscripcion" class="badge badge-success"></span>
          </div>
     </div>
     <div class="form-group col-12">
          <div id="paypal-button-container"></div>
     </div>
</div>