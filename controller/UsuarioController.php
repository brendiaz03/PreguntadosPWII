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
                $idUsuario = $_SESSION['usuario']["id"];
                $usuario = $_SESSION['usuario']["nombreUsuario"];
                $puntajeUsuario = $_SESSION['usuario']["puntaje"];
                $textoNav = "PREGUNTADOS";
                $this -> presenter -> render("view/lobby.mustache", ["usuario" => $usuario, "textoNav" => $textoNav, "puntaje" => $puntajeUsuario, "id" => $idUsuario]);
                exit();
            } else {
                $this -> presenter -> render("view/home.mustache", ['error' => true, 'message' => $resultado['message']]);
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
                != null&& $_POST["nombreUsuario"] !=null && $_POST["tipoUsuario"] != null && $_FILES['foto'] != null
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
                    $hashUsuario = md5($nombreUsuario . time());
                    $this -> model -> registro($nombre, $nacimiento, $sexo, $pais, $ciudad, $mail, $password, $nombreUsuario, $tipoUsuario, $fotoTmp, $hashUsuario);
                    $this -> enviarConfirmacionDeCuenta($mail, $hashUsuario);
                }else {
                    $this -> presenter -> render("view/registro.mustache", ['error' => true, 'message' => 'El nombre de usuario y/o email pertenece a un usuario existente.']);
                }
            }else {
                $this -> presenter -> render("view/registro.mustache", ['error' => true, 'message' => 'Debe completar todos los campos del formulario para poder continuar.']);
            }
        }
        private function enviarConfirmacionDeCuenta($email, $hash) {
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

                $mail -> Body = "
                                Haz click en el siguiente enlace para confirmar tu cuenta: 
                                <form method='post' action='http://localhost/usuario/confirmarcuenta'>
                                    <input name='hash' value='$hash' type='hidden'>
                                    <button type='submit'>Confirmar cuenta</button>
                                </form>
                            ";
                $mail -> AltBody = "Haz click en el siguiente enlace para confirmar tu cuenta: <a href='http://localhost/$hash'>Confirmar cuenta</a>";

                $mail->send();
                echo "<p style='padding: 1rem; font-size: 1.3rem'>Hemos enviado un correo a su direccion de email para confirmar su cuenta.</p>";
            } catch (Exception $e) {
                echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
            }
        }

        public function confirmarCuenta(){
            if(isset($_POST['hash'])){
                $usuarioHash = $_POST['hash'];
                $confirmacion = $this -> model -> confirmacionCuenta($usuarioHash);

                if($confirmacion){
                    $this -> presenter -> render("view/confirmarcuenta.mustache");
                }else {
                    echo "Su cuenta no ha podido ser confirmada correctamente. Intentelo nuevamente.";
                }
            }else {
                echo "Su cuenta no ha podido ser confirmada correctamente. Intentelo nuevamente.";
            }
        }

        public function perfil(){
            $textoNav = "PERFIL";
            $usuario = $this -> model -> getUsuarioById($_SESSION['usuario']['id']);
            $this -> presenter -> render("view/perfil.mustache", ["textoNav" => $textoNav, "usuario" => $usuario]);
        }

        public function lobby(){
            $textoNav = "PERFIL";
            $usuario = $this -> model -> getUsuarioById($_SESSION['usuario']['id']);
            $this -> presenter -> render("view/lobby.mustache", ["usuario" => $usuario, "textoNav" => $textoNav]);
        }

    }
