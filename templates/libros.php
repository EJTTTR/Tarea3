<?php foreach ($titulos as $titulo): ?>
    <div class="col mb-5">
        <div class="card h-100">
            <img class="card-img-top" src="<?= htmlspecialchars($titulo['imagen'] ?? 'assets/img/default.jpg') ?>" alt="Imagen de <?= htmlspecialchars($titulo['titulo'] ?? 'Sin título') ?>" />
            <div class="card-body p-0">
                <div class="text-center p-0 mt-1">
                    <h5 class="fw-bolder p-0"><?= htmlspecialchars($titulo['titulo'] ?? 'Sin titulo') ?></h5>
                    <p class="text-muted card-text p-0"><?= htmlspecialchars($titulo['tipo'] ?? 'No definido') ?></p>
                    <span class="card-text p-0"><?= htmlspecialchars($titulo['precio'] ?? 'Gratis') ?></span>
                </div>
            </div>
            <div class="card-footer p-0 pt-0 border-top-0 bg-transparent mb-3">
                <div class="text-center"><button class="btn btn-outline-dark mt-auto" data-bs-toggle="modal" data-bs-target="#libroModal" 
                data-title="<?= htmlspecialchars($titulo['titulo'] ?? 'Sin titulo') ?>"
                data-img="<?= htmlspecialchars($titulo['imagen'] ?? 'assets/img/default.jpg') ?>"
                data-tipo="<?= htmlspecialchars($titulo['tipo'] ?? 'No definido') ?>"
                data-precio="<?= htmlspecialchars($titulo['precio'] ?? 'Gratis') ?>"
                data-notas="<?= htmlspecialchars($titulo['notas'] ?? 'Sin descripcion') ?>"
                data-pub="<?= htmlspecialchars(date('Y', strtotime($titulo['fecha_pub']))) ?>">Ver detalles</button>
                <hr>
                <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editarLibroModal" data-id="<?php echo $titulo['id_titulo']; ?>" data-title="<?php echo htmlspecialchars($titulo['titulo']); ?>" data-tipo="<?php echo htmlspecialchars($titulo['tipo']); ?>" data-precio="<?php echo htmlspecialchars($titulo['precio']); ?>" data-notas="<?php echo htmlspecialchars($titulo['notas']); ?>" data-fecha="<?= htmlspecialchars(date('Y-m-d', strtotime($titulo['fecha_pub']))) ?>" data-imagen="<?php echo htmlspecialchars($titulo['imagen'] ?? 'assets/img/default.jpg'); ?>">Editar</button>
                <button class="btn btn-outline-danger ms-2" onclick="eliminarLibro(<?php echo $titulo['id_titulo']; ?>, '<?= htmlspecialchars($titulo['titulo']) ?>')">Eliminar</button></div>
            </div>
        </div>
    </div>
<?php endforeach; ?> 