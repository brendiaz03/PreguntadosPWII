<?php
require 'libs/PHPMailer/src/Exception.php';
require 'libs/PHPMailer/src/PHPMailer.php';
require 'libs/PHPMailer/src/SMTP.php';
require 'config/config.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class UsuarioController
{
    private $model;
    private $presenter;

    public function __construct($model, $presenter)
    {
        $this->model = $model;
        $this->presenter = $presenter;
    }

    public function login()
    {
        $nombreUsuario = $_POST['nombreUsuario'];
        $password = $_POST['password'];

        $resultado = $this->model->logearse($nombreUsuario, $password);


        if ($resultado['success']) {
            $this->lobby();
        } else {
            $this->presenter->render("view/home.mustache", ['error' => true, 'message' => $resultado['message']]);
        }
    }

    public function logout()
    {
        $this->model->logout();
        header("location:/");
        exit();
    }

    public function vistaRegistro()
    {
        $this->presenter->render("view/registro.mustache");
    }

    public function vistaLogin()
    {
        $this->presenter->render("view/home.mustache");
    }

    public function registro()
    {
        if ($_POST["nombreCompleto"] != null && $_POST["anioNacimiento"] != null && $_POST["sexo"]
            != null && $_POST["pais"] != null && $_POST["ciudad"] != null && $_POST["mail"] != null && $_POST["password"]
            != null && $_POST["nombreUsuario"] != null && $_POST["lat"] != null && $_POST["lng"] != null) {

            $nombre = $_POST["nombreCompleto"];
            $nacimiento = $_POST["anioNacimiento"];
            $sexo = $_POST["sexo"];
            $latitud = $_POST["lat"];
            $longitud = $_POST["lng"];
            $pais = $_POST["pais"];
            $ciudad = $_POST["ciudad"];
            $mail = $_POST["mail"];
            $password = $_POST["password"];
            $nombreUsuario = $_POST["nombreUsuario"];
            $fotoTmp = $_FILES['foto']['tmp_name'];


            $usuarioExistente = $this->model->buscarUsuario($nombreUsuario, $mail);
            if ($usuarioExistente == null) {
                $hashUsuario = md5($nombreUsuario . time());
                $this->model->registro($nombre, $nacimiento, $sexo, $pais, $ciudad, $mail, $password, $nombreUsuario, $fotoTmp, $hashUsuario, $latitud, $longitud);
                $this->enviarConfirmacionDeCuenta($mail, $hashUsuario);
            } else {
                $this->presenter->render("view/registro.mustache", ['error' => true, 'message' => 'El nombre de usuario y/o email pertenece a un usuario existente.']);
            }
        } else {
            $this->presenter->render("view/registro.mustache", ['error' => true, 'message' => 'Debe completar todos los campos del formulario para poder continuar.']);
        }
    }

    private function enviarConfirmacionDeCuenta($email, $hash)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuraciones del servidor SMTP
            $mail->isSMTP();
            $mail->Host = SMTP_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = SMTP_USER;
            $mail->Password = SMTP_PASS;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = SMTP_PORT;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Remitente y destinatario
            $mail->setFrom(FROM_EMAIL, FROM_NAME);
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Confirma tu cuenta';

            $mail->Body = "
                                Haz click en el siguiente enlace para confirmar tu cuenta: 
                                <form method='post' action='http://localhost/usuario/confirmarcuenta'>
                                    <input name='hash' value='$hash' type='hidden'>
                                    <button type='submit'>Confirmar cuenta</button>
                                </form>
                            ";
            $mail->AltBody = "
                                Haz click en el siguiente enlace para confirmar tu cuenta: 
                                <form method='post' action='http://localhost/usuario/confirmarcuenta'>
                                    <input name='hash' value='$hash' type='hidden'>
                                    <button type='submit'>Confirmar cuenta</button>
                                </form>
                            ";

            $mail->send();
            echo "<p style='padding: 1rem; font-size: 1.3rem'>Hemos enviado un correo a su direccion de email para confirmar su cuenta.</p>";
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
        }
    }

    public function confirmarCuenta()
    {
        if (isset($_POST['hash'])) {
            $usuarioHash = $_POST['hash'];
            $confirmacion = $this->model->confirmacionCuenta($usuarioHash);

            if ($confirmacion) {
                $this->presenter->render("view/confirmarcuenta.mustache");
            } else {
                echo "Su cuenta no ha podido ser confirmada correctamente. Intentelo nuevamente.";
            }
        } else {
            echo "Su cuenta no ha podido ser confirmada correctamente. Intentelo nuevamente.";
        }
    }

    public function perfil()
    {
        $textoNav = "PERFIL";
        $idUsuario = isset($_GET["id"]) ? $_GET["id"] : $_SESSION["id"];
        $usuario = $this->model->getUsuarioById($idUsuario);
        $nombreUsuario = $usuario['nombreUsuario'];
        $nombreCompleto = $usuario['nombreCompleto'];
        $anioNacimiento = $usuario['anioNacimiento'];
        $longitud = $usuario['longitud'];
        $latitud = $usuario['latitud'];
        $mail = $usuario['mail'];
        $foto = $usuario['foto'];
        $foto1 = $usuario['foto'];
        $puntaje = $usuario['puntaje'];
        $pais = $usuario['pais'];
        $ciudad = $usuario['ciudad'];
        if (isset($_GET["id"])) {
            $usuarioLogeado = $this->model->getUsuarioById($_SESSION["id"]);
            $foto = null;
            $foto = $usuarioLogeado['foto'];
        }

        include_once('libs/qr/phpqrcode/qrlib.php');


        function generateQRBase64($data) //genera el qr en vivo en vez de guardarlo localmente
        {
            ob_start();
            QRcode::png($data, null, QR_ECLEVEL_L, 8);
            $imageString = base64_encode(ob_get_contents());
            ob_end_clean();
            return 'data:image/png;base64,' . $imageString;
        }

        // Datos para el código QR
        $qrData = "http://localhost/usuario/perfil/" . $usuario['id'];

        // Generar el código QR y obtener la imagen en base64
        $qrImagen = generateQRBase64($qrData);

        $this->presenter->render(
            "view/perfil.mustache",
            [
                "textoNav" => $textoNav,
                "nombreCompleto" => $nombreCompleto,
                "nombreUsuario" => $nombreUsuario,
                "anioNacimiento" => $anioNacimiento,
                "mail" => $mail,
                "puntaje" => $puntaje,
                "logeado" => true,
                "foto" => $foto,
                "qrImagen" => $qrImagen,
                "latitud" => $latitud,
                "longitud" => $longitud,
                "pais" => $pais,
                "ciudad" => $ciudad,
                "foto1" => $foto1
            ]
        );
    }


    public function lobby()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "PANEL JUGADOR";
        if ($usuario['tipoUsuario'] == 'Jugador') {
            $this->presenter->render("view/lobby.mustache", ["textoNav" => $textoNav,
                "nombreCompleto" => $usuario['nombreCompleto'],
                "puntaje" => $usuario['puntaje'],
                "foto" => $usuario['foto'],
                "tipoUsuario" => $usuario['tipoUsuario'],
                "logeado" => true]);
        }
        if ($usuario['tipoUsuario'] == 'Editor') {
            $textoNav = "PANEL EDITOR";
            $this->presenter->render("view/lobbyEditor.mustache", ["textoNav" => $textoNav,
                "nombreCompleto" => $usuario['nombreCompleto'],
                "puntaje" => $usuario['puntaje'],
                "nivel" => $usuario['nivel'],
                "id" => $usuario['id'],
                "foto" => $usuario['foto'],
                "tipoUsuario" => $usuario['tipoUsuario'],
                "logeado" => true]);
        }
        if ($usuario['tipoUsuario'] == 'Admin') {
            $textoNav = "PANEL ADMIN";
            $this->presenter->render("view/lobbyAdmin.mustache", ["textoNav" => $textoNav,
                "nombreCompleto" => $usuario['nombreCompleto'],
                "id" => $usuario['id'],
                "foto" => $usuario['foto'],
                "tipoUsuario" => $usuario['tipoUsuario'],
                "logeado" => true]);
        }

    }

    public function ranking()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $jugadores = $this->model->getJugadoresConPuntajeYPartidasJugadas();
        if ($usuario['tipoUsuario'] == 'Jugador') {
            $this->presenter->render("view/ranking.mustache", ["textoNav" => "RANKING", "logeado" => true, "jugadores" => $jugadores, "foto" => $usuario['foto']]);
        }
        header("location:/");
    }

    public function vistaSugerirPregunta()
    {
        $usuario = $this->model->getUsuarioById($_SESSION["id"]);
        $textoNav = "SUGERIR PREGUNTA";
        if ($usuario['tipoUsuario'] == 'Jugador') {
            $this->presenter->render("view/agregarPreguntaView.mustache", ['logeado' => true, "textoNav" => $textoNav, "foto" => $usuario['foto']]);
        }
        header("location:/");
    }


}
