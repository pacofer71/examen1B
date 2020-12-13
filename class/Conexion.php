<?php
namespace Clases;
use PDO;
use PDOException;

class Conexion{
    protected static $conexion;
    
    public function __construct()
    {
        if(self::$conexion==null){
            self::Conectar();
        }
    }
    private static function Conectar(){
        $opciones=parse_ini_file("../config.ini");
        $usuario=$opciones["usuario"];
        $baseDatos=$opciones["baseDatos"];
        $pass=$opciones["pass"];
        $dsn="mysql:host=localhost;dbname=$baseDatos;charset=utf8mb4";
        try{
            self::$conexion=new PDO($dsn, $usuario, $pass);
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $ex){
            die("Error al conectar a la BBDD:". $ex->getMessage());
        }
    }
}