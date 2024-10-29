<?php
    class Database{
        private $hostname = '127.0.0.1';
        private $username = 'root';
        private $password = 'root';
        private $database = 'smartlook';  // Certifique-se de que o banco de dados esteja correto
        private $conexao;

        public function conectar(){
            $this->conexao = null;
            try
            {
                $this->conexao = new PDO('mysql:host=' . $this->hostname . ';dbname=' . $this->database . ';charset=utf8', 
                $this->username, $this->password);
            }
            catch(Exception $e)
            {
                die('Erro : '.$e->getMessage());
            }

            return $this->conexao;
        }
    }
?>
