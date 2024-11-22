<div class="modal fade" id="editarAutorModal" tabindex="-1" aria-labelledby="editarAutorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="editarAutorModalLabel">Editar Autor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarAutor" action="procesar_autor.php" method="post">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" id="editarId" name="id_autor">
                    <div class="row g-4">
                        <div class="col-6 mb-2">
                            <label for="editarNombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editarNombre" name="nombre" required>
                        </div>
                        <div class="col-6 mb-2">
                            <label for="editarApellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="editarApellido" name="apellido" required>
                        </div>
                    </div>  
                    <div class="mb-2">
                        <label for="editarTelefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="editarTelefono" name="telefono">
                    </div>
                    <div class="mb-2">
                        <label for="editarDireccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="editarDireccion" name="direccion">
                    </div>
                        <div class="row g-4">
                            <div class="col-6 mb-2">
                            <label for="editarCiudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" id="editarCiudad" name="ciudad">
                        </div>
                        <div class="col-6 mb-2">
                            <label for="editarPais" class="form-label">País</label>
                            <input type="text" class="form-control" id="editarPais" name="pais">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="editarFotografia" class="form-label">URL de Fotografía</label>
                        <input type="text" class="form-control" id="editarFotografia" name="fotografia" title="Puede ingresar por defecto: assets/img/anonimo.jpg" required>
                    </div>
            </div>
                    <div class="modal-footer bg-dark text-white">
                        <button type="submit" class="btn btn-outline-primary">Guardar cambios</button>
                    </div>
            </form>
        </div>
    </div>
</div>
