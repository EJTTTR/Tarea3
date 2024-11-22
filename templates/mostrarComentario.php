<!-- Sección de comentarios -->
<?php
    include_once 'templates/db.php';

    try {
        $sql = "SELECT nombre, apellido, asunto, comentario FROM contacto";
        $consulta = $pdo->prepare($sql);
        $consulta->execute();
        $comentarios = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
?>

<div class="mt-4">
    <h2 class="mb-3">Comentarios</h2>
    <?php
    if (!empty($comentarios)) {
        foreach ($comentarios as $comentario) {
            echo '<div class="card mb-3">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($comentario['nombre']) . ' ' . htmlspecialchars($comentario['apellido']) . '</h5>';
            echo '<span class="card-text">' . '<b>Asunto:</b> '  . htmlspecialchars($comentario['asunto']) . '</span>';
            echo '<p class="card-text">' . nl2br(htmlspecialchars($comentario['comentario'])) . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p class="text-black">Sin comentarios todavía.</p>';
    }
    ?>
</div>