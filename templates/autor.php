<?php foreach ($autores as $autor): ?>
    <div class="col mb-5">
        <div class="card h-100">
            <img class="card-img-top" src="<?= htmlspecialchars($autor['fotografia'] ?? 'assets/img/anonimo.jpg') ?>" alt="Foto de <?= htmlspecialchars($autor['nombre'] . ' ' . $autor['apellido'] ?? 'Sin nombre') ?>" height="150" />
            <div class="card-body p-0">
                <div class="text-center p-0 mt-1">
                    <h5 class="fw-bolder p-0"><?= htmlspecialchars($autor['nombre'] . ' ' . htmlspecialchars($autor['apellido'])) ?></h5>
                    <p class="text-muted card-text p-0"><?= htmlspecialchars($autor['ciudad'] . ', ' . $autor['pais']) ?></p>
                </div>
            </div>
            <div class="card-footer p-0 pt-0 border-top-0 bg-transparent mb-3">
                <div class="text-center p-0">
                    <button class="btn btn-outline-dark mt-auto" data-bs-toggle="modal" data-bs-target="#autorModal" 
                    data-title="<?= htmlspecialchars($autor['nombre'] . ' ' . htmlspecialchars($autor['apellido'])) ?>"
                    data-img="<?= htmlspecialchars($autor['fotografia'] ?? 'assets/img/anonimo.jpg') ?>"
                    data-telefono="<?= htmlspecialchars($autor['telefono'] ?? 'No definido') ?>"
                    data-direccion="<?= htmlspecialchars($autor['direccion'] ?? 'No definida') ?>"
                    data-ciudad="<?= htmlspecialchars($autor['ciudad'] ?? 'No definida') ?>"
                    data-pais="<?= htmlspecialchars($autor['pais'] ?? 'No definido') ?>">Más información</button>
                    <hr>
                    <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarAutorModal" 
                    data-id="<?= $autor['id_autor']; ?>" 
                    data-nombre="<?= htmlspecialchars($autor['nombre']); ?>" 
                    data-apellido="<?= htmlspecialchars($autor['apellido']); ?>" 
                    data-telefono="<?= htmlspecialchars($autor['telefono']); ?>" 
                    data-direccion="<?= htmlspecialchars($autor['direccion']); ?>" 
                    data-ciudad="<?= htmlspecialchars($autor['ciudad']); ?>" 
                    data-pais="<?= htmlspecialchars($autor['pais']); ?>" 
                    data-fotografia="<?= htmlspecialchars($autor['fotografia'] ?? 'assets/img/anonimo.jpg'); ?>">Editar</button>
                    <button class="btn btn-outline-danger ms-2" onclick="eliminarAutor(<?= $autor['id_autor']; ?>, '<?= htmlspecialchars($autor['nombre'] . ' ' . $autor['apellido']) ?>')">Eliminar</button>
                </div>                
            </div>
        </div>
    </div>
<?php endforeach; ?>
