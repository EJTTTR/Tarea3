<div class="modal fade" id="editarLibroModal" tabindex="-1" aria-labelledby="editarLibroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="editarLibroModalLabel">Editar Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarLibro" action="procesar_libro.php" method="post">
                    <input type="hidden" name="accion" value="editar">
                    <input type="hidden" id="editarId" name="id_titulo">
                    <div class="mb-3">
                        <label for="editarTitulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="editarTitulo" name="titulo" required autocomplete="off">
                    </div>
                    <div class="row g-4">
                        <div class="col-6 mb-3">
                            <label for="editarTipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="editarTipo" name="tipo" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="editarPrecio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="editarPrecio" name="precio" step="0.01">
                        </div>
                    </div>    
                    <div class="mb-3">
                        <label for="editarNotas" class="form-label">Notas</label>
                        <textarea class="form-control" id="editarNotas" name="notas" rows="2"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editarFecha_pub" class="form-label">Fecha de Publicación</label>
                        <input type="date" class="form-control" id="editarFecha_pub" name="fecha_pub" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarImagen" class="form-label">URL de imagen</label>
                        <input type="text" class="form-control" id="editarImagen" name="imagen" required title="Puede ingresar por defecto: assets/img/default.jpg">
                    </div>                    
            </div>
                    <div class="modal-footer bg-dark text-white">
                        <button type="submit" class="btn btn-outline-primary">Guardar cambios</button>
                    </div>
            </form>
        </div>
    </div>
</div>