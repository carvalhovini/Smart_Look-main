<?php
session_start();
if (!$_SESSION['cpf']) {
    header("location: ./login/sair.php");
    exit();
}

// Validação e tratamento do CEP no backend
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['endereco'])) {
        $cep = $_POST['endereco'];

        // Remove qualquer caractere que não seja um número (incluindo o traço)
        $cep = preg_replace('/\D/', '', $cep);

        // Valida se o CEP tem exatamente 8 dígitos
        if (strlen($cep) !== 8) {
            $_SESSION['erro_vazio'] = "O formato do CEP está inválido. Insira o CEP corretamente (somente números).";
            header("Location: formulario.php");  // Redireciona de volta ao formulário
            exit();
        }

        // Se o CEP estiver correto, prossiga com as outras validações e inserção no banco de dados
        // Exemplo de processamento adicional: $cidade = $_POST['cidade']; ...
        
        // A partir daqui, continue o processamento como a inserção no banco de dados etc.
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/make_denounce.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="./../componentes/componentes.css" rel="stylesheet">
    <title>Smart Look - Denúncia</title>
</head>
<body>
    <!-- Inclui o navbar -->
    <?php include_once("./../componentes/navbar.php") ?>
    
    <div class="main">
        <!-- Inclui o sub-navbar -->
        <?php include_once("./../componentes/sub_navbar.php") ?>
        
        <div class="page">
            <div class="box_denuncia">
                <div class="mid_box_left">
                    <form action="" method="post" class="form" enctype="multipart/form-data">
                        <div class="div_input">
                            <label for="local">Região administrativa:</label>
                            <select class="op" name="cidade" required>
                                <option disabled selected>Escolha a cidade:</option>
                                <option value="Plano Piloto">Plano Piloto</option>
                                <option value="Gama">Gama</option>
                                <option value="Taguatinga">Taguatinga</option>
                                <!-- Outras opções de cidades omitidas para brevidade -->
                            </select>
                        </div>

                        <div class="div_input">
                            <label for="tipo_lixo">Tipo do lixo:</label>
                            <select class="op" name="tipo" required>
                                <option disabled selected>Escolha o tipo de lixo:</option>
                                <option value="Lixo orgânico">Lixo orgânico</option>
                                <option value="Lixo reciclável">Lixo reciclável</option>
                                <!-- Outras opções omitidas para brevidade -->
                            </select>
                        </div>

                        <div class="div_input">
                            <label for="endereco">CEP da Rua:</label>
                            <input type="text" class="input" name="endereco" id="endereco" placeholder="00000-000" minlength="9" maxlength="9" pattern="\d{5}-\d{3}" required>
                        </div>

                        <div class="div_input">
                            <label for="complemento">Complemento:</label>
                            <input type="text" class="input" name="complemento" id="complemento" minlength="5" maxlength="60" placeholder="Detalhes adicionais do endereço" required>
                        </div>

                        <div class="div_input">
                            <label for="file">Foto:</label>
                            <input class="input" type="file" name="file" id="file" accept="image/*" required>
                        </div>

                        <!-- Exibe mensagem de erro, se houver -->
                        <?php
                        if (isset($_SESSION['erro_vazio'])) {
                            echo '<p class="erro">' . $_SESSION['erro_vazio'] . '</p>';
                            unset($_SESSION['erro_vazio']);
                        }
                        ?>

                        <div class="div_input">
                            <button type="submit" class="btn">Denunciar</button>
                        </div>
                    </form>
                </div>

                <div class="mid_box_right">
                    <h1>A mudança começa por você</h1>
                    <p>Preste atenção nas informações preenchidas nos campos.</p>
                    <img src="./../../img/make_denu.jpg" alt="Imagem de Denúncia" style="height: 270px; width: 300px; border-radius: 50%;">
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para a máscara de CEP -->
    <script>
        const cepInput = document.getElementById('endereco');

        cepInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não for dígito
            if (value.length > 5) {
                value = value.replace(/^(\d{5})(\d)/, '$1-$2'); // Adiciona o traço após o quinto dígito
            }
            e.target.value = value;
        });
    </script>

</body>
</html>
