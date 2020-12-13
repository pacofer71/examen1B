<?php


namespace Clases;

use PDO;
use PDOException;

class Usuarios extends Conexion
{
    private $id;
    private $nombre;
    private $pass;
    private $perfil;
    private $foto;

    public function __construct()
    {
        parent::__construct();
    }
    //--------------------- CRUD -----------------
    public function create()
    {
        $i = "insert into usuarios(nombre, pass, perfil,foto) values(:n, :p, :pf, :ft)";
        $stmt = parent::$conexion->prepare($i);
        try {
            $stmt->execute([
                ':n' => $this->nombre,
                ':p' => $this->pass,
                ':pf' => $this->perfil,
                ':ft' => $this->foto
            ]);
        } catch (PDOException $ex) {
            die("Error al registrar usuarios: $ex->getMessage()");
        }
    }
    public function read()
    {
        $c = "select * from usuarios order by perfil, nombre";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute();
        } catch (PDOException $ex) {
            die("Error al recuperar usuarios: $ex->getMessage()");
        }
        return $stmt;
    }
    //-------------------------------------------------------------------------------------------------------------
    public function update()
    {
        $u="update usuarios set nombre=:u, pass=:p, perfil=:pf, foto=:f where id=:i";
        $stmt=parent::$conexion->prepare($u);
        try{
            $stmt->execute([
                ':u'=>$this->nombre,
                ':p' => $this->pass,
                ':pf' => $this->perfil,
                ':f' => $this->foto,
                ':i'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al actualizar: ".$ex->getMessage());
        }

    }
    public function  delete()
    {
        $d = "delete from usuarios where id=:i";
        $stmt = parent::$conexion->prepare($d);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al borrar: $ex->getMessage()");
        }
    }
    //------------------------------------------------------------------------------------------------------------------
    public function isValido($u, $p)
    {
        $pb = hash("sha256", $p);
        $c = "select id from usuarios where nombre=:n AND pass=:p";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([':n' => $u, ':p' => $pb]);
        } catch (PDOException $ex) {
            die("Error al comprobar usuario:" . $ex->getMessage());
        }
        //die("total=".$stmt->fetch(PDO::FETCH_OBJ)->total);
        return $stmt->fetch(PDO::FETCH_OBJ)->id;
    }
    //------------------------------------------------------------------------------------------------------------------
    public function recuperarUsuario()
    {
        $c = "select * from usuarios where id=:i";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':i' => $this->id
            ]);
        } catch (PDOException $ex) {
            die("Error al recuperar usuario: $ex->getMessage()");
        }
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    //-----------------------------------------------------------------------------------------------------------------
    public function existeNombre()
    {
        $c = "select count(*) as total from usuarios where nombre=:n";
        $c1 = "select count(*) as total from usuarios where nombre=:n AND id <> :i";
        $datos=[':n'=>$this->nombre];
        if (!isset($this->id)) {
            $stmt = parent::$conexion->prepare($c);
        }
        else{
            $stmt=parent::$conexion->prepare($c1);
            $datos[":i"]=$this->id;
        }
        try {
                $stmt->execute($datos);
        } catch (PDOException $ex) {
                die("Error al buscar nombre: ".$ex->getMessage());
        }
        
        return $stmt->fetch(PDO::FETCH_OBJ)->total;
    }
    //--------------------------------------------------------------------------------------------------------------------
    public function recuperarId()
    {
        $c = "select id from usuarios where nombre=:n";
        $stmt = parent::$conexion->prepare($c);
        try {
            $stmt->execute([
                ':n' => $this->nombre
            ]);
        } catch (PDOException $ex) {
            die("Error al recuperarid: $ex->getMessage()");
        }
        return $stmt->fetch(PDO::FETCH_OBJ)->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    /**
     * @param mixed $perfil
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }
}
