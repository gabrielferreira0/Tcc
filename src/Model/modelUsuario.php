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
    private $tipo;
    private $banco;

    public function __construct()
    {
        $this->banco = new DBconexao();
    }

    public function deletar($id){
        $sql = "UPDATE usuarios SET usustatus  = 'false' WHERE id = {$id}; ";
        $result = pg_query($this->banco->open(), $sql);
        return $result;

    }

    public function verificarUser($CPF)
    {
        $sql = "select usucpf from usuarios where usucpf ='{$CPF}'  and usustatus ='true' ;";
        $rs = pg_query($this->banco->open(), $sql);
        if (pg_num_rows($rs) > 0) {
            echo "cpfC";
        } else {
            $sql = "select usuemail from usuarios where usuemail ='{$CPF}' and usustatus ='true';";
            $rs = pg_query($this->banco->open(), $sql);
            if (pg_num_rows($rs) > 0) {
                echo 'emailC';
            } else {
                return true;
            }
        }
    }

    public function updatecomSenha($id,$nome,$senha,$telefone,$foto){

        $sql = "UPDATE usuarios SET usunome = '{$nome}',ususenha = '{$senha}',usutelefone = '{$telefone}',usufoto = '{$foto}' WHERE id = {$id}; ";
        $result = pg_query($this->banco->open(), $sql);
        return $result;
    }


    public function updateSemSenha($id,$nome,$telefone,$foto){
        $sql = "UPDATE usuarios SET usunome = '{$nome}',usutelefone = '{$telefone}',usufoto = '{$foto}' WHERE id = {$id}; ";
        $result = pg_query($this->banco->open(), $sql);
        return $result;
    }


    public function inserirUser($nome,$senha,$email,$telefone,$foto,$CPF,$status,$tipo){

        $this->username = $nome;
        $this->senha = $senha;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->foto = $foto;
        $this->CPF = $CPF;
        $this->status = $status;
        $this->tipo = $tipo;
        $sql = "insert into usuarios(usunome,ususenha,usuemail,usucpf,usutelefone,usufoto,usustatus,usutipo) values ('$this->username','$this->senha','$this->email','$this->CPF','$this->telefone','$this->foto',$this->status,$this->tipo);";
        $result = pg_query($this->banco->open(), $sql);
        return $result;

    }

    public function login($CPFlogin,$senhaLogin){

        $sql = "select * from usuarios where usucpf = '{$CPFlogin}'and ususenha ='{$senhaLogin}' and usustatus = 'true';";
        $rs = pg_query($this->banco->open(), $sql);
        $dados = pg_fetch_array($rs, 0, PGSQL_NUM);
        $resultado[] = $rs;
        $resultado[] = $dados;
        return $resultado;
    }

}