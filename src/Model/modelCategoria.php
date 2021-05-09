<?php

require_once 'DBconexao.php';
class modelCategoria extends DBconexao
{
    private $categoria;
    private $fotoCategoria;
    private $status;

    public function setCategoria($categoria, $fotoCategoria, $status)
    {
        $this->categoria = $categoria;
        $this->fotoCategoria = $fotoCategoria;
        $this->status = $status;
    }
}
