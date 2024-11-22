<?php
include_once 'templates/db.php';

//consulta los autores
$consulta = $pdo->query("
SELECT  a.id_autor, a.nombre, a.apellido, a.telefono, a.direccion, a.ciudad, a.pais, COALESCE(f.fotografia, 'assets/img/anonimo.jpg') as fotografia
        FROM autores a
        LEFT JOIN fotografias f ON a.id_autor = f.id_autor
");
$autores = $consulta->fetchAll(PDO::FETCH_ASSOC);

include_once 'procesar_autor.php';

$msg = '';
$msg_tipo = '';

// mensajes de exito/error
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
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="index.php">Libros</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#!"><b>Autores</b></a></li>
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
                <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#agregarAutorModal">Agregar Autor</button>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                <?php include 'templates/autor.php'; ?>

            </div>
        </div>
        <!-- Modal -->

        <?php include 'templates/modal2.php'; ?>
    </>
    </section>
    <!-- Footer-->
    <?php 
        include 'templates/footer.php';
    ?>
    <!-- Modal para agregar autor -->
        <?php include 'templates/modalAgregarA.php'; ?>

    <!-- Modal para editar autor -->

    <?php include 'templates/modalEditarA.php'; ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- <script src="js/scripts.js"></script> -->
    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
    // obtencion de datos del autor
    document.addEventListener('DOMContentLoaded', function () {
        var autorModal = document.getElementById('autorModal');

        autorModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            var title = button.getAttribute('data-title');
            var image = button.getAttribute('data-img');
            var telefono = button.getAttribute('data-telefono');
            var direccion = button.getAttribute('data-direccion');
            var ciudad = button.getAttribute('data-ciudad');
            var pais = button.getAttribute('data-pais');

            var modalTitle = autorModal.querySelector('#nombreAutor');
            var modalImg = autorModal.querySelector('#imgAutor');
            var modalTelefono = autorModal.querySelector('#telefonoAutor');
            var modalDireccion = autorModal.querySelector('#direccionAutor');
            var modalCiudad = autorModal.querySelector('#ciudadAutor');
            var modalPais = autorModal.querySelector('#paisAutor');

            modalTitle.textContent = title;
            modalImg.src = image;
            modalImg.alt = 'Imagen de ' + title;
            modalTelefono.textContent = telefono;
            modalDireccion.textContent = direccion;
            modalCiudad.textContent = ciudad;
            modalPais.textContent = pais;
        });
    });
</script>
<script>
    // edicion de autores
    document.addEventListener('DOMContentLoaded', function () {
        var editarAutorModal = document.getElementById('editarAutorModal');
        editarAutorModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var nombre = button.getAttribute('data-nombre');
            var apellido = button.getAttribute('data-apellido');
            var telefono = button.getAttribute('data-telefono');
            var direccion = button.getAttribute('data-direccion');
            var ciudad = button.getAttribute('data-ciudad');
            var pais = button.getAttribute('data-pais');
            var fotografia = button.getAttribute('data-fotografia');

            var modalTitle = editarAutorModal.querySelector('.modal-title');
            var modalBodyId = editarAutorModal.querySelector('#editarId');
            var modalBodyNombre = editarAutorModal.querySelector('#editarNombre');
            var modalBodyApellido = editarAutorModal.querySelector('#editarApellido');
            var modalBodyTelefono = editarAutorModal.querySelector('#editarTelefono');
            var modalBodyDireccion = editarAutorModal.querySelector('#editarDireccion');
            var modalBodyCiudad = editarAutorModal.querySelector('#editarCiudad');
            var modalBodyPais = editarAutorModal.querySelector('#editarPais');
            var modalBodyFotografia = editarAutorModal.querySelector('#editarFotografia');

            modalTitle.textContent = 'Editar Autor: ' + nombre + ' ' + apellido;
            modalBodyId.value = id;
            modalBodyNombre.value = nombre;
            modalBodyApellido.value = apellido;
            modalBodyTelefono.value = telefono;
            modalBodyDireccion.value = direccion;
            modalBodyCiudad.value = ciudad;
            modalBodyPais.value = pais;
            modalBodyFotografia.value = fotografia;
        });
    });

    // eliminar autores con confirmacion de sweetalert
    function eliminarAutor(id, nombre) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás deshacer los cambios después de haber eliminado al autor: \"" + nombre + "\"",
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
                    text: 'El autor "' + nombre + '" ha sido eliminado correctamente',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = 'procesar_autor.php';

                    var inputAccion = document.createElement('input');
                    inputAccion.type = 'hidden';
                    inputAccion.name = 'accion';
                    inputAccion.value = 'eliminar';

                    var inputId = document.createElement('input');
                    inputId.type = 'hidden';
                    inputId.name = 'id_autor';
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
