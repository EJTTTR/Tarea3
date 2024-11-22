<?php
include_once 'templates/db.php';
session_start();

// inserciones y actualizaciones
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $accion = $_POST['accion'];

    if ($accion == 'agregar') {
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellido = htmlspecialchars($_POST['apellido']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $ciudad = htmlspecialchars($_POST['ciudad']);
        $pais = htmlspecialchars($_POST['pais']);
        $imagen_url = htmlspecialchars($_POST['fotografia']);

        try {
            // insertar autores
            $sql = "INSERT INTO autores (nombre, apellido, telefono, direccion, ciudad, pais) VALUES (:nombre, :apellido, :telefono, :direccion, :ciudad, :pais)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':apellido', $apellido);
            $consulta->bindParam(':telefono', $telefono);
            $consulta->bindParam(':direccion', $direccion);
            $consulta->bindParam(':ciudad', $ciudad);
            $consulta->bindParam(':pais', $pais);
            $consulta->execute();

            // obtener el id_autor generado
            $id_autor = $pdo->lastInsertId();

            // Insertar fotografia si hay URL de imagen
            if ($imagen_url) {
                $sql_img = "INSERT INTO fotografias (id_autor, fotografia) VALUES (:id_autor, :fotografia)";
                $consulta_img = $pdo->prepare($sql_img);
                $consulta_img->bindParam(':id_autor', $id_autor);
                $consulta_img->bindParam(':fotografia', $imagen_url);
                $consulta_img->execute();
            }

            $_SESSION['message'] = "Autor agregado exitosamente.";
            $_SESSION['message_type'] = "success";
            header("Location: autores.php");
            exit;

        } catch (PDOException $e) {
            $_SESSION['message'] = "Error al agregar el autor: " . $e->getMessage();
            $_SESSION['message_type'] = "danger";
            header("Location: autores.php");
            exit;
        }

    } elseif ($accion == 'editar') {
        $id_autor = htmlspecialchars($_POST['id_autor']);
        $nombre = htmlspecialchars($_POST['nombre']);
        $apellido = htmlspecialchars($_POST['apellido']);
        $telefono = htmlspecialchars($_POST['telefono']);
        $direccion = htmlspecialchars($_POST['direccion']);
        $ciudad = htmlspecialchars($_POST['ciudad']);
        $pais = htmlspecialchars($_POST['pais']);
        $imagen_url = htmlspecialchars($_POST['fotografia']);

        try {
            // actualizar autores
            $sql = "UPDATE autores SET nombre = :nombre, apellido = :apellido, telefono = :telefono, direccion = :direccion, ciudad = :ciudad, pais = :pais WHERE id_autor = :id_autor";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':apellido', $apellido);
            $consulta->bindParam(':telefono', $telefono);
            $consulta->bindParam(':direccion', $direccion);
            $consulta->bindParam(':ciudad', $ciudad);
            $consulta->bindParam(':pais', $pais);
            $consulta->bindParam(':id_autor', $id_autor);
            $consulta->execute();

            // verificar si ya existe en la tabla fotografias
            $sql_verificar_img = "SELECT COUNT(*) FROM fotografias WHERE id_autor = :id_autor";
            $consulta_verificar_img = $pdo->prepare($sql_verificar_img);
            $consulta_verificar_img->bindParam(':id_autor', $id_autor);
            $consulta_verificar_img->execute();
            $existe = $consulta_verificar_img->fetchColumn();

            if ($existe) {
                // actualizar la imagen existente
                $sql_img = "UPDATE fotografias SET fotografia = :fotografia WHERE id_autor = :id_autor";
            } else {
                // insertar una nueva imagen
                $sql_img = "INSERT INTO fotografias (id_autor, fotografia) VALUES (:id_autor, :fotografia)";
            }

            $consulta_img = $pdo->prepare($sql_img);
            $consulta_img->bindParam(':id_autor', $id_autor);
            $consulta_img->bindParam(':fotografia', $imagen_url);
            $consulta_img->execute();

            $_SESSION['message'] = "Autor editado exitosamente.";
            $_SESSION['message_type'] = "success";
            header("Location: autores.php");
            exit;

        } catch (PDOException $e) {
            $_SESSION['message'] = "Error al editar el autor: " . $e->getMessage();
            $_SESSION['message_type'] = "danger";
            header("Location: autores.php");
            exit;
        }
    } elseif ($accion == 'eliminar') {
        $id_autor = htmlspecialchars($_POST['id_autor']);
        try {
            // eliminar fotografia
            $sql_img = "DELETE FROM fotografias WHERE id_autor = :id_autor";
            $consulta_img = $pdo->prepare($sql_img);
            $consulta_img->bindParam(':id_autor', $id_autor);
            $consulta_img->execute();

            // eliminar en autores
            $sql = "DELETE FROM autores WHERE id_autor = :id_autor";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(':id_autor', $id_autor);
            $consulta->execute();

            $_SESSION['message'] = "Autor eliminado exitosamente.";
            $_SESSION['message_type'] = "success";
            header("Location: autores.php");
            exit;

        } catch (PDOException $e) {
            $_SESSION['message'] = "Error al eliminar el autor: " . $e->getMessage();
            $_SESSION['message_type'] = "danger";
            header("Location: autores.php");
            exit;
        }
    }
}
