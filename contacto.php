<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $email = htmlspecialchars(trim($_POST['email']));
    $mensaje = htmlspecialchars(trim($_POST['mensaje']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Correo inválido'); window.history.back();</script>";
        exit;
    }

    $destinatario = "soportegaswise@gmail.com";
    $asunto = "Nuevo mensaje desde el sitio GasWise";

    $contenido = "Has recibido un nuevo mensaje desde el formulario de contacto:\n\n";
    $contenido .= "Nombre: $nombre\n";
    $contenido .= "Correo electrónico: $email\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $headers = "From: noreply@gaswise.com\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($destinatario, $asunto, $contenido, $headers)) {
        echo "<script>alert('Mensaje enviado con éxito.'); window.history.back();</script>";
    } else {
        echo "<script>alert('No se pudo enviar el mensaje.'); window.history.back();</script>";
    }
} else {
    echo "Acceso no permitido.";
}
?>
