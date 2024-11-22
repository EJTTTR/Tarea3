<div class="modal fade" id="agregarLibroModal" tabindex="-1" aria-labelledby="agregarLibroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="agregarLibroModalLabel">Agregar Nuevo Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarLibro" action="procesar_libro.php" method="post">
                    <input type="hidden" name="accion" value="agregar">
                    <div class="mb-2">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required maxlength="60">
                    </div>
                    <div class="row g-4">
                        <div class="col-6 mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo" maxlength="15">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="notas" class="form-label">Notas</label>
                        <textarea class="form-control" id="notas" name="notas" rows="2" maxlength="255"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="fecha_pub" class="form-label">Fecha de Publicación</label>
                        <input type="date" class="form-control" id="fecha_pub" name="fecha_pub" required value="2024-07-24">
                    </div>
                    <div class="mb-2">
                        <label for="imagen" class="form-label">URL de imagen</label>
                        <input type="text" class="form-control" id="imagen" name="imagen" placeholder="Ejemplo: https://example.com/foto.jpg" title="Si un link no carga una foto es posible que la pagina de origen este bloqueando su uso.">
                    </div>                    
            </div>
                    <div class="modal-footer bg-dark text-white">
                        <button type="submit" class="btn btn-outline-primary">Agregar libro</button>
                    </div>
            </form>
        </div>
    </div>
</div>
