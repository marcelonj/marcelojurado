<?php namespace app;
    use mysqli;

    class Conexion{
        private $usuario = "root";
        private $contraseña = "";
        private $db = "marcelojurado";
        private $host = "localhost";
        private $conexion;

        public function __construct(){
            $this->conexion = new mysqli($this->host, $this->usuario, $this->contraseña, $this->db);
        }

        public function prueba(){
            if(!$this->conexion->errno){
                echo "Conexion exitosa!";
            }
            else{
                echo "Ocurrio un error: ".$this->errno;
            }
        }

        public function consulta_simple($consulta){
            if($this->query($consulta)){
                echo "La consulta se realizó con exito";
            }
            else{
                echo "Ocurrio un error";
            }
        }

        public function consulta_retorno($consulta){
            $resultado= $this->conexion->query($consulta);
            if($resultado){
                echo "La consulta se realizó con exito";
                return $resultado;
            }
            else{
                echo "Ocurrio un error";
            }
        }

        public function prueba_consulta(){
            $resultado= $this->conexion->query("SELECT * FROM mensajes");
            var_dump($resultado);
        }
    };

    $temp = new Conexion;
    $temp->prueba_consulta();
?>