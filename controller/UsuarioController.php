<?php
    require 'libs/PHPMailer/src/Exception.php';
    require 'libs/PHPMailer/src/PHPMailer.php';
    require 'libs/PHPMailer/src/SMTP.php';
    require 'config/config.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class UsuarioController{
        private $model;
        private $presenter;

        public function __construct($model, $presenter)
        {
            $this->model = $model;
            $this->presenter = $presenter;
        }

        public function login(){
                $nombreUsuario = $_POST['nombreUsuario'];
                $password = $_POST['password'];

                $resultado = $this->model->logearse($nombreUsuario, $password);

                if ($resultado['success']) {
                    $usuario = $_SESSION['usuario'];
                    $textoNav = "PREGUNTADOS";
                    $this -> presenter -> render("view/lobby.mustache", ["usuario" => $usuario, "textoNav" => $textoNav]);
                    exit();
                } else {
                    $this -> presenter -> render("view/home.mustache", ['error' => true, 'message' => 'Usuario o password incorrecta.']);
                }
        }

        public function logout(){
            $this -> model -> logout();
            header("location:/preguntados/index.php");
            exit();
        }

        public function vistaRegistro(){
            $this -> presenter -> render("view/registro.mustache");
        }

        public function vistaLogin(){
            $this -> presenter -> render("view/home.mustache");
        }
        public function registro(){
            if($_POST["nombreCompleto"] != null && $_POST["anioNacimiento"] != null&& $_POST["sexo"]
                != null&& $_POST["pais"] != null&& $_POST["ciudad"] != null&& $_POST["mail"] != null&& $_POST["password"]
                != null&& $_POST["nombreUsuario"] !=null && $_POST["tipoUsuario"] != null
            ){
                $nombre = $_POST["nombreCompleto"];
                $nacimiento = $_POST["anioNacimiento"];
                $sexo = $_POST["sexo"];
                $pais = $_POST["pais"];
                $ciudad = $_POST["ciudad"];
                $mail = $_POST["mail"];
                $password = $_POST["password"];
                $nombreUsuario = $_POST["nombreUsuario"];
                $tipoUsuario = $_POST["tipoUsuario"];
                $fotoTmp = $_FILES['foto']['tmp_name'];

                $usuarioExistente = $this -> model -> buscarUsuario($nombreUsuario, $mail);
                if($usuarioExistente == null){
                    $this -> model -> registro($nombre, $nacimiento, $sexo, $pais, $ciudad, $mail, $password, $nombreUsuario, $tipoUsuario, $fotoTmp);
                    $this -> enviarConfirmacionDeCuenta($mail);
                    //header("location:/preguntados/index.php");
                    //exit();
                }else {
                    $this -> presenter -> render("view/registro.mustache", ['error' => true, 'message' => 'El nombre de usuario y/o email pertenece a un usuario existente.']);
                }
            }else {
                $this -> presenter -> render("view/registro.mustache", ['error' => true, 'message' => 'Debe completar todos los campos del formulario para poder continuar.']);
            }
        }
        private function enviarConfirmacionDeCuenta($email) {
            $mail = new PHPMailer(true);

            try {
                // Configuraciones del servidor SMTP
                $mail->isSMTP();
                $mail->Host       = SMTP_HOST;
                $mail->SMTPAuth   = true;
                $mail->Username   = SMTP_USER;
                $mail->Password   = SMTP_PASS;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = SMTP_PORT;

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
                $mail->Body    = "Haz click en el siguiente enlace para confirmar tu cuenta: <a href='http://localhost/preguntados/index.php'>Confirmar cuenta</a>"; // aca iria el link que confirma la cuenta del usuario
                $mail->AltBody = "Haz click en el siguiente enlace para confirmar tu cuenta: <a href='http://localhost/preguntados/index.php'>Confirmar cuenta</a>";

                $mail->send();
                echo "Correo enviado exitosamente";
            } catch (Exception $e) {
                echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
            }
        }

        public function perfil(){
            $textoNav = "PERFIL";
            $this -> model -> getUsuarioById($_POST["id"]);
            $this -> presenter -> render("view/perfil.mustache", ["textoNav" => $textoNav, "usuario" => $_SESSION['usuario']]);
        }

    }
