<?php

require_once 'DBconexao.php';
class modelUsuario extends DBconexao
{

    private $username;
    private $senha;
    private $email;
    private $telefone;
    private $foto;
    private $CPF;

    public function __construct($nome,$senha,$email,$telefone,$foto,$CPF)
    {
        $this->username = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->foto = $foto;
        $this->CPF = $CPF;
        $banco = new DBconexao();
    }

    public function verificarUser()
    {
        $banco = new DBconexao();
        $sql = "select usucpf from usuarios where usucpf ='{$this->CPF}';";
        $rs = pg_query($banco->db, $sql);
        if (pg_num_rows($rs) > 0) {
            echo "cpfC";
        } else {
            $sql = "select usuemail from usuarios where usuemail ='{$this->email}';";
            $rs = pg_query($banco->db, $sql);
            if (pg_num_rows($rs) > 0) {
                echo 'emailC';
            } else {
                return true;
            }
        }
    }


    public function inserirUser(){
        $banco = new DBconexao();
        $sql = "insert into usuarios(usunome,ususenha,usuemail,usucpf,usutelefone,usufoto) values ('$this->username','$this->senha','$this->email','$this->CPF','$this->telefone','$this->foto');";
        $result = pg_query($banco->db, $sql);
        return $result;

    }



}