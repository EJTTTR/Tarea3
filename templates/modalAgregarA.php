<div class="modal fade" id="agregarAutorModal" tabindex="-1" aria-labelledby="agregarAutorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="agregarAutorModalLabel">Agregar Nuevo Autor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarAutor" action="procesar_autor.php" method="POST">
                    <input type="hidden" name="accion" value="agregar">
                    <div class="row g-4">
                        <div class="col-6 mb-2">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="60">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required maxlength="60">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" maxlength="20">
                    </div>
                    <div class="row g-4">
                        <div class="col-6 mb-2">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" maxlength="100">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" maxlength="50">
                        </div>
                    </div>  
                    <div class="mb-2">
                        <label for="pais" class="form-label">País</label>
                        <input type="text" class="form-control" id="pais" name="pais" maxlength="50">
                    </div>
                    <div class="mb-2">
                        <label for="fotografia" class="form-label">URL de Fotografía</label>
                        <input type="text" class="form-control" id="fotografia" name="fotografia" placeholder="Ejemplo: https://example.com/foto.jpg" title="Si un link no carga una foto es posible que la pagina de origen este bloqueando su uso.">
                    </div>
            </div>
                    <div class="modal-footer bg-dark text-white">
                        <button type="submit" class="btn btn-outline-primary">Agregar autor</button>
                    </div>
            </form>
        </div>
    </div>
</div>
