<?php

    include_once "connectionDB/ConnectionDB.php";

    class AnexosNotas{

        public static function insert ($nombreNotaAnexo, $idNota, $urlNotaAnexo){

            $con = new Connection();
            $query = "INSERT INTO notas_anexos(nombreNotaAnexo, idNota, urlNotaAnexo) VALUES(
                '$nombreNotaAnexo',
                $idNota,
                '$urlNotaAnexo'
            )";

            if ($con->query($query)) {
                return TRUE;
            }
            echo $con->error;
            return FALSE;
        }

    }

?>