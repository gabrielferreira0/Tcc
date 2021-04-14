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
    private $status;
    private $banco;

    public function __construct()
    {
        $this->banco = new DBconexao();
    }

    public function verificarUser()
    {
        $sql = "select usucpf from usuarios where usucpf ='{$this->CPF}';";
        $rs = pg_query($this->banco->open(), $sql);
        if (pg_num_rows($rs) > 0) {
            echo "cpfC";
        } else {
            $sql = "select usuemail from usuarios where usuemail ='{$this->email}';";
            $rs = pg_query($this->banco->open(), $sql);
            if (pg_num_rows($rs) > 0) {
                echo 'emailC';
            } else {
                return true;
            }
        }
    }


    public function inserirUser($nome,$senha,$email,$telefone,$foto,$CPF,$status){

        $this->username = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->foto = $foto;
        $this->CPF = $CPF;
        $this->status = $status;
        $sql = "insert into usuarios(usunome,ususenha,usuemail,usucpf,usutelefone,usufoto,usustatus) values ('$this->username','$this->senha','$this->email','$this->CPF','$this->telefone','$this->foto',$this->status);";
        $result = pg_query($this->banco->open(), $sql);
        return $result;

    }

    public function login($CPFlogin,$senhaLogin){

        $sql = "select * from usuarios where usucpf = '{$CPFlogin}'and ususenha ='{$senhaLogin}';";
        $rs = pg_query($this->banco->open(), $sql);
        $dados = pg_fetch_array($rs, 0, PGSQL_NUM);
        $resultado[] = $rs;
        $resultado[] = $dados;
        return $resultado;
    }

}