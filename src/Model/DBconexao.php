<?php

Class DBconexao {
//    protected $host = "localhost";
//    protected $port = "5432";
//    protected $dbname = "tcc";
//    protected $user = "postgres";
//    protected $password = "admin";
//    protected $db;

    protected $host = "51.15.164.106";
    protected $port = "5432";
    protected $dbname = "aqbarhch_wedoDB";
    protected $user = "aqbarhch_wedoADM";
    protected $password = "aKQm~F;j)i_G";
    protected $db;

    function __construct(){

    }

    function open (){
        $conexao = "host={$this->host} port={$this->port} dbname={$this->dbname} user={$this->user} password={$this->password}";
         return $this->db = pg_connect($conexao);
    }

}
?>