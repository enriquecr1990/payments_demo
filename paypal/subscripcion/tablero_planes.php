<div class="row">
     <div class="form-group col-12 text-end">
          <button id="btn-buscar-planes" class="btn btn-secondary btn-sm">
               Buscar planes
          </button>
          <button id="btn-nuevo-plan" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form_plan">
               Nuevo
          </button>
     </div>
</div>
<div class="row">
     <div class="form-group col-12">
          <table class="table table-striped">
               <thead>
                    <tr>
                         <th scope="col">ID</th>
                         <th scope="col">Producto relacionado</th>
                         <th scope="col">Nombre</th>
                         <th scope="col">Descripción</th>
                         <th scope="col">Estado</th>
                         <th scope="col">Fecha</th>
                         <th></th>
                    </tr>
               </thead>
               <tbody id="rows_planes_paypal">
               </tbody>
          </table>
     </div>
</div>

<div class="modal fade" id="modal_form_plan" tabindex="-1">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Formulario de plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form id="form_producto" class="row g-3">
                         <div class="col-12">
                              <label for="input_nombre" class="form-label">Nombre</label>
                              <input type="text" class="form-control" id="input_nombre" name="nombre_plan" placeholder="Nombre del producto">
                         </div>
                         <div class="col-12">
                              <label for="input_nombre" class="form-label">Descripción</label>
                              <input type="text" class="form-control" id="input_nombre" name="descripcion_plan" placeholder="Nombre del producto">
                         </div>
                         <div class="col-12">
                              <label for="input_frecuencia">Frecuencia de pago</label>
                              <select id="input_frecuencia" class="form-select" name="frecuencia_plan" aria-label="Seleccione frecuencia de cobro">
                                   <option selected>--Seleccione--</option>
                                   <option value="DAY">Día</option>
                                   <option value="WEEK">Semana</option>
                                   <option value="MONT">Mensual</option>
                                   <option value="YEAR">Anual</option>
                              </select>
                         </div>
                         <div class="col-12">
                              <label for="input_numero_pagos">Número de cargos</label>
                              <input type="number" class="form-control" id="input_nombre" name="numero_pagos_plan" placeholder="Nombre del producto">
                         </div>
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_guardar_plan" class="btn btn-primary">Guardar</button>
               </div>
          </div>
     </div>
</div>