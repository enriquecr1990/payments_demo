<div class="row">
     <div class="form-group col-12 text-end">
          <button id="btn-nuevo-producto" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_form_producto">
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
                         <th scope="col">Nombre</th>
                         <th scope="col">Descripcion</th>
                         <th scope="col">Fecha</th>
                         <th></th>
                    </tr>
               </thead>
               <tbody id="rows_productos_paypal">
               </tbody>
          </table>
     </div>
</div>

<div class="modal fade" id="modal_form_producto" tabindex="-1">
     <div class="modal-dialog">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title">Nuevo producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                    <form id="form_producto" class="row g-3">
                         <div class="col-12">
                              <label for="input_nombre" class="form-label">Nombre</label>
                              <input type="text" class="form-control" id="input_nombre" name="nombre_producto" placeholder="Nombre del producto">
                         </div>
                         <div class="col-12">
                              <label for="input_descripcion" class="form-label">Descripción</label>
                              <input type="text" class="form-control" id="input_descripcion" name="descripcion_producto" placeholder="Descripción del producto">
                         </div>
                    </form>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="btn_guardar_producto" class="btn btn-primary">Guardar</button>
               </div>
          </div>
     </div>
</div>