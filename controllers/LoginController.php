<?php

namespace Controllers;
use MVC\Router;
use Model\Usuarios;
use Classes\Email;

class LoginController{
    public static function login(Router $router){
        $alertas=[];
        
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $auth=new Usuarios($_POST);
            $alertas=$auth->validarLogin();
            if(empty($alertas)){
                //comprvar que el usuario existe
                $usuario=Usuarios::where("email",$auth->email);

                if($usuario){
                    //verificar el password
                    if($usuario->comprovarPasswordAndVerificado($auth->password)){
                        session_start();
                        $_SESSION["id"]=$usuario->id;
                        $_SESSION["nombre"]=$usuario->nombre ." ".$usuario->apellido;
                        $_SESSION["email"]=$usuario->email;
                        $_SESSION["login"]=true;

                        //Redireciconamiento
                        if($usuario->admin==="1"){
                            $_SESSION["admin"]=$usuario->admin ?? "0";
                            header("Location: /admin");
                        }else{
                            header("Location: /cita");
                        }
                    }
                }else{
                    Usuarios::setAlerta("error","El Usuario no se encontro");
                }
            }
        }
        $alertas=Usuarios::getAlertas();
        $router->render("auth/login",[  
            "alertas"=>$alertas
        ]);
    }
    public static function logout(){
        session_start();
        $_SESSION=[];
        header("Location: /");
    }
    public static function olvide(Router $router){
        $alertas=[];
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $auth=new Usuarios($_POST);
            $alertas=$auth->validarEmail();

            if(empty($alertas)){
                $usuario=Usuarios::where("email",$auth->email);
                if($usuario && $usuario->confirmado==="1"){
                    //Generar un token
                    $usuario->token();
                    $usuario->guardar();
                    //Enviar Email
                    $email=new Email($usuario->nombre,$usuario->email,$usuario->token);
                    $email->enviarInstrucciones();
                    //Alerta de exito
                    Usuarios::setAlerta("exito","Revisa tu E-mail");


                }else{
                    Usuarios::setAlerta("error","El usuario no existe o no esta confirmado");
                    
                }
            }
        }
        $alertas=Usuarios::getAlertas();
        $router->render("auth/olvide-password",[
            "alertas"=>$alertas
        ]);
    }

    public static function recuperar(Router $router){
        $alertas=[];
        $error=false;
        $token=s($_GET["token"]);
        $usuario=Usuarios::where("token",$token);

        if(empty($usuario)){
            Usuarios::setAlerta("error","Token no valido");
            $error=true;
        }
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            //Leer el nuevo pasword y guardarlo
            $password=new Usuarios($_POST);
            $alertas=$password->validarPassword();

            if(empty($alertas)){
                $usuario->password=null;
                $usuario->password=$password->password;
                $usuario->hashPassword();
                $usuario->token=null;
                $resultado=$usuario->guardar();
                if($resultado){
                    header("Location: /");
                }
            }

        }
        $alertas=Usuarios::getAlertas();
        $router->render("auth/recuperar-password",[
            "alertas"=>$alertas,
            "error"=>$error
        ]);
    }
    public static function crear(Router $router){
        $usuario=new Usuarios;
        $alertas=[];
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $usuario->sincronizar($_POST);
            $alertas =$usuario->validarNuevoUsuario();
            //Revisar que no eixten errores 
            if(empty($alertas)){
                $resultado=$usuario->usuarioExiste();
                if($resultado->num_rows){
                    $alertas=Usuarios::getAlertas();
                }else{
                    $usuario->hashPassword();
                    //Enviar token
                    $usuario->token();
                    //
                    $email=new Email($usuario->nombre,$usuario->email,$usuario->token);
                    $email->crearConfirmacion();
                    //crear el usuario
                    $resultado=$usuario->guardar();
                    if($resultado){
                        header("Location: /mensaje");
                    }
                }
            }
        }
        $router->render("auth/crear-cuenta",[
            "usuario"=>$usuario,
            "alertas"=>$alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render("auth/mensaje");
    }

    public static function confirmar(Router $router){
        $alertas=[];
        $token=s($_GET["token"]);
        $usuario=Usuarios::where("token",$token);
        if(empty($usuario)){
            //Mostrar mensaje error
            Usuarios::setAlerta("error","Token no valido");
        }else{
            //Modificar a usuario confirmado
            $usuario->confirmado="1";
            $usuario->token="";
            $usuario->guardar();
            Usuarios::setAlerta("exito","Cuenta confirmada correctamente");
        }
        $alertas=Usuarios::getAlertas();
        $router->render("auth/confirmar-cuenta",[
            "alertas"=>$alertas
        ]);
    }
}