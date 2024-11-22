<?php
include_once 'templates/db.php';
session_start(); 

// inserciones y actualizaciones
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'];

    if ($accion == 'agregar') {
        $titulo = htmlspecialchars($_POST['titulo']);
        $tipo = htmlspecialchars($_POST['tipo']);
        $precio = htmlspecialchars($_POST['precio']);
        $notas = htmlspecialchars($_POST['notas']);
        $fecha_pub = htmlspecialchars($_POST['fecha_pub']);
        $imagen_url = htmlspecialchars($_POST['imagen']);

        try {
            // insertar titulos`
            $sql = "INSERT INTO titulos (titulo, tipo, precio, notas, fecha_pub) VALUES (:titulo, :tipo, :precio, :notas, :fecha_pub)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':titulo', $titulo);
            $consulta->bindParam(':tipo', $tipo);
            $consulta->bindParam(':precio', $precio);
            $consulta->bindParam(':notas', $notas);
            $consulta->bindParam(':fecha_pub', $fecha_pub);
            $consulta->execute();

            // obtener el id_titulo generado
            $id_titulo = $pdo->lastInsertId();

            // insertar imagenes si hay una URL de imagen
            if ($imagen_url) {
                $sql_img = "INSERT INTO imagenes (id_titulo, imagen) VALUES (:id_titulo, :imagen)";
                $consulta_img = $pdo->prepare($sql_img);
                $consulta_img->bindParam(':id_titulo', $id_titulo);
                $consulta_img->bindParam(':imagen', $imagen_url);
                $consulta_img->execute();
            }

            $_SESSION['message'] = "Título agregado exitosamente.";
            $_SESSION['message_type'] = "success";
            header("Location: index.php");
            exit;

        } catch (PDOException $e) {
            $_SESSION['message'] = "Error al agregar el título: " . $e->getMessage();
            $_SESSION['message_type'] = "danger";
            header("Location: index.php");
            exit;
        }

    } elseif ($accion == 'editar') {
        $id_titulo = htmlspecialchars($_POST['id_titulo']);
        $titulo = htmlspecialchars($_POST['titulo']);
        $tipo = htmlspecialchars($_POST['tipo']);
        $precio = htmlspecialchars($_POST['precio']);
        $notas = htmlspecialchars($_POST['notas']);
        $fecha_pub = htmlspecialchars($_POST['fecha_pub']);
        $imagen_url = htmlspecialchars($_POST['imagen']);

        try {
            // actualizar titulos
            $sql = "UPDATE titulos SET titulo = :titulo, tipo = :tipo, precio = :precio, notas = :notas, fecha_pub = :fecha_pub WHERE id_titulo = :id_titulo";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':titulo', $titulo);
            $consulta->bindParam(':tipo', $tipo);
            $consulta->bindParam(':precio', $precio);
            $consulta->bindParam(':notas', $notas);
            $consulta->bindParam(':fecha_pub', $fecha_pub);
            $consulta->bindParam(':id_titulo', $id_titulo);
            $consulta->execute();

            // verificar si ya existe la imagenes
            $sql_verificar_img = "SELECT COUNT(*) FROM imagenes WHERE id_titulo = :id_titulo";
            $consulta_verificar_img = $pdo->prepare($sql_verificar_img);
            $consulta_verificar_img->bindParam(':id_titulo', $id_titulo);
            $consulta_verificar_img->execute();
            $existe = $consulta_verificar_img->fetchColumn();

            if ($existe) {
                // actualizar la imagen existente
                $sql_img = "UPDATE imagenes SET imagen = :imagen WHERE id_titulo = :id_titulo";
            } else {
                // insertar una nueva imagen
                $sql_img = "INSERT INTO imagenes (id_titulo, imagen) VALUES (:id_titulo, :imagen)";
            }

            $consulta_img = $pdo->prepare($sql_img);
            $consulta_img->bindParam(':id_titulo', $id_titulo);
            $consulta_img->bindParam(':imagen', $imagen_url);
            $consulta_img->execute();

            $_SESSION['message'] = "Título editado exitosamente.";
            $_SESSION['message_type'] = "success";
            header("Location: index.php");
            exit;

        } catch (PDOException $e) {
            $_SESSION['message'] = "Error al editar el título: " . $e->getMessage();
            $_SESSION['message_type'] = "danger";
            header("Location: index.php");
            exit;
        }
    } elseif ($accion == 'eliminar') {
        $id_titulo = htmlspecialchars($_POST['id_titulo']);
        try {
            // eliminar imagenes
            $sql_img = "DELETE FROM imagenes WHERE id_titulo = :id_titulo";
            $consulta_img = $pdo->prepare($sql_img);
            $consulta_img->bindParam(':id_titulo', $id_titulo);
            $consulta_img->execute();

            // eliminar titulos
            $sql = "DELETE FROM titulos WHERE id_titulo = :id_titulo";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':id_titulo', $id_titulo);
            $consulta->execute();

            $_SESSION['message'] = "Título eliminado exitosamente.";
            $_SESSION['message_type'] = "success";
            header("Location: index.php");
            exit;

        } catch (PDOException $e) {
            $_SESSION['message'] = "Error al eliminar el título: " . $e->getMessage();
            $_SESSION['message_type'] = "danger";
            header("Location: index.php");
            exit;
        }
    }
}
