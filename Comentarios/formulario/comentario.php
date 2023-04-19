<?php

    include_once('../config/config.php');
    include('../config/database.php');

    class comentario{

        public $conexion; /* LLAMO LA CONEXION DE MI BASE DE DATOS */

        function __construct(){
            $db= new Database(); /* LA CONEXION A LA BD SIEMPRE SE RENUEVE O ESTE EN LINEA */
            $this->conexion = $db->connectToDatabase();
        }

        function save($params){
             $nombre = $params["nombre"];
             $email = $params["email"];
             $comentario = $params["comentario"];
             $tuvaloracion = $params["tuvaloracion"];
          
            $Insert ="INSERT INTO comentarios VALUES(NULL, '$nombre', '$email', '$comentario', '$tuvaloracion' )";
      
           return mysqli_query($this->conexion, $Insert);

        }

        function getAll(){
            $sql="select * from comentarios";
            return mysqli_query($this->conexion, $sql);
        }

        function get0ne($id){
        
          $sql = "SELECT * FROM comentarios WHERE id=" . $id;
          return mysqli_query($this->conexion,$sql);

        }

        function update($params){

            $id = $params["id"];
            $nombre = $params["nombre"];
            $email = $params["email"];
            $comentario = $params["comentario"];
            $tuvaloracion = $params["tuvaloracion"];
            $update ="UPDATE comentarios 
            SET nombre='$nombre', email='$email', comentario='$comentario', tuvaloracion='$tuvaloracion'  
            WHERE id=$id";
        
            return mysqli_query($this->conexion,$update);
            
        }
        
        function delete($id){
    
            $delete="DELETE FROM comentarios WHERE id=$id";
            return mysqli_query($this->conexion,$delete);
        }
    }

?>