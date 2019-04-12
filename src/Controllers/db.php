<?php

    namespace Src\Controllers;
    use \PDO;

    class db{
        private $dbHost = '67.227.237.216';//'localhost:8889';
        private $dbUser = 'cernetco_root';//'root';
        private $dbPass = 'fykP}4g$.0Sv';//'root';
        private $dbName = 'cernetco_Crud_Rest';

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