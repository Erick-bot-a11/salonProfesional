<?php

namespace Model;

class Usuarios extends ActiveRecord{
    protected static $tabla ="usuarios";//Nombre de la tabla
    protected static $columnasDB = ["id","nombre","apellido","email",
    "password","telefono","admin","confirmado","token"];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args=[]){
        $this->id=$args["id"] ?? null;
        $this->nombre=$args["nombre"] ?? "";
        $this->apellido=$args["apellido"] ?? "";
        $this->email=$args["email"] ?? "";
        $this->password=$args["password"] ?? "";
        $this->telefono=$args["telefono"] ?? "";
        $this->admin=$args["admin"] ?? "0";
        $this->confirmado=$args["confirmado"] ?? "0";
        $this->token=$args["token"] ?? "";

    }

    //Valida la creacion de nuevos usuarios
    public function validarNuevoUsuario(){
        if(!$this->nombre){
            self::$alertas["error"][]="El Nombre es Obligatorio";
        }
        if(!$this->apellido){
            self::$alertas["error"][]="El Apellido es Obligatorio";
        }
        if(!$this->telefono){
            self::$alertas["error"][]="El Telefono es Obligatorio";
        }
        if(!$this->email){
            self::$alertas["error"][]="El Email es Obligatorio";
        }
        if(!$this->password){
            self::$alertas["error"][]="El Password es Obligatorio";
        }
        if(strlen($this->password)<6 ){
            self::$alertas["error"][]="El Password debe contener al menos 6 caracteres";
        }
        return self::$alertas;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas["error"][]="El e-mail es obligatorio";
        }
        if(!$this->password){
            self::$alertas["error"][]="El Password es obligatorio";
        }
        return self::$alertas;
    }

    public function validaremail(){
        if(!$this->email){
            self::$alertas["error"][]="El e-mail es obligatorio";
        }
        return self::$alertas;
    }
    public function validarPassword(){
        if(!$this->password){
            self::$alertas["error"][]="El Password es obligatorio";
        }
        if(strlen($this->password)<6){
            self::$alertas["error"][]="El Password tiene que tener al menos 6 caracteres";
        }
        return self::$alertas;
    }


    public function usuarioExiste(){
        $query="SELECT * FROM ".self::$tabla." WHERE email='".$this->email."' LIMIT 1";
        $resultado=self::$db->query($query);//Asi realizar la busqueda
        if($resultado->num_rows){
            self::$alertas["error"][]="El usuario ya existe";
            
        }
        return $resultado;
    }

    public function hashPassword(){
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
    }
    public function token(){
        $this->token=uniqid();
    }

    public function comprovarPasswordAndVerificado($password){
        $resultado=password_verify($password,$this->password);
        if(!$resultado){
            self::$alertas["error"][]="La contraseña es incorrecta";
        }if($this->confirmado=="0"){
            self::$alertas["error"][]="La cuenta no ah sido confirmado";
        }
        if($resultado && $this->confirmado==="1"){
            return true; 
        }
    }
}