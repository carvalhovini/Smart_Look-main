<?php
session_start();
require_once('conexao.php');
require_once('funcoa_validacao.php');

$database = new Database();
$db = $database->conectar();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Exibe exceções do PDO

if (isset($_POST['cidade']) && isset($_POST['tipo']) && isset($_POST['endereco']) && isset($_POST['complemento']) && isset($_FILES['file'])) {
   
    $local = $_POST['cidade'];
    $tipo = $_POST['tipo'];
    $endereco = $_POST['endereco'];
    $complemento = $_POST['complemento'];
    $file = $_FILES['file'];
    $date = date('Y-m-d');  // Formato adequado para inserção no MySQL
    $cpf = $_SESSION['cpf'];
    $extensao = pathinfo($file['name'], PATHINFO_EXTENSION);
    $extensao = strtolower($extensao);
    
    if (!empty($local) && !empty($tipo) && !empty($endereco) && !empty($date) && !empty($file)) {

        if (valida_cep($endereco)) {

            if (in_array($extensao, ['jpeg', 'png', 'jpg', 'jfif'])) {
                
                $nome_file = $file['name'];
                $diretorio = "./../../views/img_denu/";
                
                if (move_uploaded_file($_FILES['file']['tmp_name'], $diretorio . $nome_file)) {
                    try {
                        $sql_cadastro = "INSERT INTO tbl_denuncias (id, Regiao_adm, tipo_lixo, cep_rua, complemento, img, data ,validacao, cpf) 
                                         VALUES (null, :local, :tipo, :endereco, :complemento, :nome_file, :data, 'v', :cpf);";

                        $query_cadastro = $db->prepare($sql_cadastro);
                        $query_cadastro->bindParam(':local', $local);
                        $query_cadastro->bindParam(':tipo', $tipo);
                        $query_cadastro->bindParam(':endereco', $endereco);
                        $query_cadastro->bindParam(':complemento', $complemento);
                        $query_cadastro->bindParam(':nome_file', $nome_file);
                        $query_cadastro->bindParam(':data', $date);
                        $query_cadastro->bindParam(':cpf', $cpf);

                        $query_cadastro->execute();

                        header('Location: ./../../views/all_denounce.php');
                    } catch (PDOException $e) {
                        echo "Erro ao cadastrar a denúncia: " . $e->getMessage();
                    }
                } else {
                    echo "Erro ao mover o arquivo de imagem.";
                }
            } else {
                $_SESSION['erro_vazio'] = 'Formato de arquivo inválido. Apenas JPEG, PNG, JPG e JFIF são permitidos.';
                header('Location: ./../../views/make_denounce.php');
            }
        } else {
            $_SESSION['erro_vazio'] = 'O formato do CEP está inválido. Tente retirar o traço.';
            header('Location: ./../../views/make_denounce.php');
        }

    } else {
        $_SESSION['erro_vazio'] = 'Algum dos campos foi enviado vazio.';
        header('Location: ./../../views/make_denounce.php');
    }
   
} else {
    $_SESSION['erro_vazio'] = 'Algum dos campos foi enviado vazio.';
    header('Location: ./../../views/make_denounce.php');
}
