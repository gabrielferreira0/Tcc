<?php

Class DBconexao {
    private $host = "localhost";
    private $port = "5432";
    private $dbname = "tcc";
    private $user = "postgres";
    private $password = "admin";
    public $db;

    function __construct(){
        $conexao = "host={$this->host} port={$this->port} dbname={$this->dbname} user={$this->user} password={$this->password}";
        $this->db = pg_connect($conexao);
    }
}
?>