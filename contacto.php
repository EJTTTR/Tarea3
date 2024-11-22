<?php
include_once 'templates/db.php';

$msg = "";
$msg_tipo = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $correo = htmlspecialchars($_POST['correo']);
    $asunto = htmlspecialchars($_POST['asunto']);
    $comentario = htmlspecialchars($_POST['comentario']);

    try {
        $sql = "INSERT INTO contacto (nombre, apellido, correo, asunto, comentario) VALUES (:nombre, :apellido, :correo, :asunto, :comentario)";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':apellido', $apellido);
        $consulta->bindParam(':correo', $correo);
        $consulta->bindParam(':asunto', $asunto);
        $consulta->bindParam(':comentario', $comentario);
        $consulta->execute();

        $msg = "Comentario enviado correctamente.";
        $msg_tipo = "success";
    } catch (PDOException $e) {
        $msg = "Error: " . $e->getMessage();
        $msg_tipo = "error";
    }
}
?>
<script>
    history.replaceState(null,null,location.pathname)
</script>

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/logo.css" rel="stylesheet" />        
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!">Bonfire Books <img src="assets/img/logo.png" class="img-thumbnail"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto me-0 me-md-3 my-2 my-md-0">
                    <li class="nav-item"><a class="nav-link" href="index.php">Libros</a></li>
                    <li class="nav-item"><a class="nav-link" href="autores.php">Autores</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#!"><b>Contacto</b></a></li>
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
    <section class="py-1 px-4 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="gx-4 gx-lg-5 justify-content-center">
                <!-- Contacto -->
                <?php 
                    include 'templates/contact.php'; 
                    //no se si hay que incluir una zona de comentarios... asi que la dejare comentada...
                    include 'templates/mostrarComentario.php';
                ?>
                
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php 
        include 'templates/footer.php';
    ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <!-- <script src="js/scripts.js"></script> -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        //apoyarse del recurso de sweetalert para ver avisar al usuario el envio del comentario
        <?php if (!empty($msg)) : ?>
            swal({
                title: "<?php echo $msg_tipo == 'success' ? 'Éxito' : 'Error'; ?>",
                text: "<?php echo $msg; ?>",
                icon: "<?php echo $msg_tipo; ?>",
            });
        <?php endif; ?>
    </script>
</body>
</html>
