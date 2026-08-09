

<?php

class Conexao
{
    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $banco = "videogame";

    public function Conectar()
    {
        $conn = new mysqli(
            $this->host,
            $this->usuario,
            $this->senha,
            $this->banco
        );

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        return $conn;
    }
}
