<?php

    namespace Src\Controllers;
    use \PDO;

    class db{
        private $dbHost = 'localhost:8889';
        private $dbUser = 'root';
        private $dbPass = 'root';
        private $dbName = 'Crud_Rest';

        /*
         * Conexion a la base de datos
         */
        public function connectionDB(){
            $mysql = "mysql:host=$this->dbHost;dbname=$this->dbName";
            $dbCon = new PDO($mysql,$this->dbUser,$this->dbPass);
            $dbCon->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            return $dbCon;
        }

    }