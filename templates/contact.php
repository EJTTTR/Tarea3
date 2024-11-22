<div>
    <h2 class="pb-3">Contacto</h2>
    <form method="POST">
        <div class="row g-4">
            <div class="col-6 mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required placeholder="nombre..." maxlength="50">
            </div>
            <div class="col-6 mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required placeholder="apellido..." maxlength="50">
            </div>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" required placeholder="correo..." maxlength="100">
        </div>
        <div class="mb-3">
            <label for="asunto" class="form-label">Asunto:</label>
            <input type="text" class="form-control" id="asunto" name="asunto" required placeholder="asunto..." maxlength="100">
        </div>
        <div class="mb-3">
            <label for="comentario" class="form-label">Comentario:</label>
            <textarea class="form-control" id="comentario" name="comentario" rows="3" required placeholder="Escribe tu comentario aquí..." maxlength="255"></textarea>
        </div>
        <button type="submit" class="btn btn-outline-dark mb-5">Enviar</button>
    </form>
</div>
