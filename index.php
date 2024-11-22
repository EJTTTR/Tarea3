<?php
include_once 'templates/db.php';

//consulta los libros
$consulta = $pdo->query("
SELECT t.id_titulo, t.titulo, t.tipo, t.precio, t.notas, t.fecha_pub, i.imagen
FROM titulos t
LEFT JOIN imagenes i ON t.id_titulo = i.id_titulo
");
$titulos = $consulta->fetchAll(PDO::FETCH_ASSOC);

include_once 'procesar_libro.php';

$msg = '';
$msg_tipo = '';

// Manejo de mensajes de éxito/error
if (isset($_GET['msg']) && isset($_GET['msg_tipo'])) {
    $msg = $_GET['msg'];
    $msg_tipo = $_GET['msg_tipo'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Bonfire Books</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.jpg" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/logo.css" rel="stylesheet" />
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Bonfire Books <img src="assets/img/logo.png" class="img-thumbnail"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!"><b>Libros</b></a></li>
                    <li class="nav-item"><a class="nav-link" href="autores.php">Autores</a></li>
                    <li class="nav-item"><a class="nav-link" href="contacto.php">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder" id="til"><img src="assets/img/logo.png" class="logo">Bonfire Books</h1>
                <p class="lead fw-normal text-white-50 mb-0">Entre llamas y cenizas, libros eternos</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5 bg-light">
        <div class="container px-3 px-lg-4 mt-4">
            <div class="mb-4">
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#agregarLibroModal">Agregar Libro</button>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php include 'templates/libros.php'; ?>

            </div>
        </div>
        <!-- Modal -->
        <?php include 'templates/modal.php'; ?>
    </>
    </section>
    <!-- Footer-->
    <?php 
        include 'templates/footer.php';
    ?>
    <!-- Modal para agregar libro -->
        <?php include 'templates/modalAgregarL.php'; ?>

    <!-- Modal para editar libro -->

    <?php include 'templates/modalEditarL.php'; ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- <script src="js/scripts.js"></script> -->
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        //obtencion de datos
        document.addEventListener('DOMContentLoaded', function () {
            var libroModal = document.getElementById('libroModal');

            libroModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;

                var title = button.getAttribute('data-title');
                var image = button.getAttribute('data-img');
                var tipo = button.getAttribute('data-tipo');
                var precio = button.getAttribute('data-precio');
                var notas = button.getAttribute('data-notas');
                var pub = button.getAttribute('data-pub');

                var modalTitle = libroModal.querySelector('.modal-title');
                var modalImg = libroModal.querySelector('#imgLibro');
                var modalTipo = libroModal.querySelector('#tipoLibro');
                var modalPrecio = libroModal.querySelector('#precioLibro');
                var modalNotas = libroModal.querySelector('#descripcion');
                var modalPub = libroModal.querySelector('#publicacion');

                modalTitle.textContent = title;
                modalImg.src = image;
                modalImg.alt = 'Imagen de ' + title;
                modalTipo.textContent = tipo;
                modalPrecio.textContent = precio;
                modalNotas.textContent = notas;
                modalPub.textContent = pub;
            });
        });
    </script>
    <script>
        //edicion de libros
        document.addEventListener('DOMContentLoaded', function () {
            var editarLibroModal = document.getElementById('editarLibroModal');
            editarLibroModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var title = button.getAttribute('data-title');
                var tipo = button.getAttribute('data-tipo');
                var precio = button.getAttribute('data-precio');
                var notas = button.getAttribute('data-notas');
                var fecha = button.getAttribute('data-fecha');
                var imagen = button.getAttribute('data-imagen');

                var modalTitle = editarLibroModal.querySelector('.modal-title');
                var modalBodyId = editarLibroModal.querySelector('#editarId');
                var modalBodyTitle = editarLibroModal.querySelector('#editarTitulo');
                var modalBodyTipo = editarLibroModal.querySelector('#editarTipo');
                var modalBodyPrecio = editarLibroModal.querySelector('#editarPrecio');
                var modalBodyNotas = editarLibroModal.querySelector('#editarNotas');
                var modalBodyFecha = editarLibroModal.querySelector('#editarFecha_pub');
                var modalBodyImagen = editarLibroModal.querySelector('#editarImagen');

                modalTitle.textContent = 'Editar Libro: ' + title;
                modalBodyId.value = id;
                modalBodyTitle.value = title;
                modalBodyTipo.value = tipo;
                modalBodyPrecio.value = precio;
                modalBodyNotas.value = notas;
                modalBodyFecha.value = fecha;
                modalBodyImagen.value = imagen;
            });
        });

        //eliminar libros con confirmacion de sweetalert
        function eliminarLibro(id, titulo) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "No podrás deshacer los cambios después de haber eliminado el libro: \"" + titulo + "\"",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Eliminado',
                        text: 'El libro "' + titulo + '" ha sido eliminado correctamente',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = 'procesar_libro.php';

                        var inputAccion = document.createElement('input');
                        inputAccion.type = 'hidden';
                        inputAccion.name = 'accion';
                        inputAccion.value = 'eliminar';

                        var inputId = document.createElement('input');
                        inputId.type = 'hidden';
                        inputId.name = 'id_titulo';
                        inputId.value = id;

                        form.appendChild(inputAccion);
                        form.appendChild(inputId);

                        document.body.appendChild(form);
                        form.submit();
                    });
                }
            });
        }

        //sweetalert de exito
        document.addEventListener('DOMContentLoaded', function() {
            <?php
            if (isset($_SESSION['message']) && isset($_SESSION['message_type'])) {
                $title = $_SESSION['message_type'] == 'success' ? 'Éxito' : 'Error';
                $icon = $_SESSION['message_type'] == 'success' ? 'success' : 'error';
                ?>
                Swal.fire({
                    title: '<?php echo $title; ?>',
                    text: '<?php echo $_SESSION['message']; ?>',
                    icon: '<?php echo $icon; ?>',
                    timer: 1300,
                    showConfirmButton: false
                });
                <?php
            
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
            }
            ?>
        });

        // mostrar un sweetalert si hay errores en php
        <?php if (!empty($msg)) : ?>
            Swal.fire({
                title: "<?php echo $msg_tipo == 'success' ? 'Éxito' : 'Error'; ?>",
                text: "<?php echo $msg; ?>",
                icon: "<?php echo $msg_tipo; ?>",
            });
        <?php endif; ?>
    </script>
</body>
</html>
