<div class="row">
     <div class="form-group col-12 text-end">
          <button id="btn-nuevo-producto" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_form_producto">Nuevo</button>
     </div>
</div>
<div class="row">
     <div class="form-group col-12">
          <table class="table table-striped">
               <thead>
                    <tr>
                         <th scope="col">#</th>
                         <th scope="col">Producto</th>
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
                    <p></p>
               </div>
               <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
               </div>
          </div>
     </div>
</div>