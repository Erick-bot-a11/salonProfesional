<?php
namespace Classes;
use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $nombre;
    public $email;
    public $token;
    public function __construct($nombre,$email,$token)
    {
        $this->nombre=$nombre;
        $this->email=$email;
        $this->token=$token;
        
    }
    public function crearConfirmacion(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '70fe3b92500cf2';
        $mail->Password = '417853380072cf';

        $mail->setFrom("cuentas@appsalon.com");
        $mail->addAddress("cuentas@appsalon.com","APPSALON.com");
        $mail->Subject="Confirma tu cuenta";

        //Decirle que vamos a usar html
        $mail->isHTML(TRUE);
        $mail->CharSet="UTF-8";
        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$this->nombre."</strong> Has creado tu cuenta
        en APPSALON, solo debes confirmarla precionando en el siguiente enlace</p>";
        $contenido.="<p>Preciona aqui :<a href='http://localhost:5000/confirmar-cuenta?token="
        .$this->token."'>Confirmar cuenta</a></p>";
        $contenido.="<p>Si tu no solicitaste esta cuenta, puedes ignorarlo</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;
        $mail->send();
    }

    public function enviarInstrucciones(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '70fe3b92500cf2';
        $mail->Password = '417853380072cf';

        $mail->setFrom("cuentas@appsalon.com");
        $mail->addAddress("cuentas@appsalon.com","APPSALON.com");
        $mail->Subject="Restablece tu contraseña";

        //Decirle que vamos a usar html
        $mail->isHTML(TRUE);
        $mail->CharSet="UTF-8";
        $contenido="<html>";
        $contenido.="<p><strong>Hola ".$this->nombre."</strong> Has solicitado, restablecer tu contraseña
        , segue el siguiente enlace para continuar con el proceso.</p>";
        $contenido.="<p>Preciona aqui :<a href='http://localhost:5000/recuperar?token="
        .$this->token."'>Restablecer cuenta</a></p>";
        $contenido.="<p>Si tu no solicitaste, puedes ignorarlo</p>";
        $contenido.="</html>";

        $mail->Body=$contenido;
        $mail->send();
    }
}
?>