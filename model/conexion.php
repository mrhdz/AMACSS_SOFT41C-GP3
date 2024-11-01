<?php
date_default_timezone_set('America/El_Salvador');

if (!defined('SERVIDOR')) define('SERVIDOR', 'localhost');
if (!defined('USUARIO')) define('USUARIO', 'root');
if (!defined('CLAVE')) define('CLAVE', '');
if (!defined('DATABASE')) define('DATABASE', 'sportspace');

class conexion
{
    private $conexion;
    public function __construct()
    {
        try 
        {
            $this -> conexion= new mysqli(SERVIDOR, USUARIO, CLAVE, DATABASE);
        }
        catch(Exception $e)
        {
            //echo $e -> errorMessage();
        }
    }

    public function cn(){
    	return $this->conexion;
    }

    public function ejecutarSQL($sql){
        return $this->cn()->query($sql);
    }

    

}
?>
