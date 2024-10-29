<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./../css/cadastrar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Smart Look - Cadastro</title>
</head>
<body class="main">

    <!-- Navbar -->
    <div class="navbar">
        <div class="box1">
            <a href="./../../../public/index.php"><h1>SMART LOOK</h1></a>
            <div class="navigacion">
                <a href="./../../../public/index.php">Home</a>
                <a href="./../../../public/denuncias.php">Últimas Denúncias</a>
                <a href="./../../../public/cj.php">Conheça o Projeto</a>
            </div> 
        </div>
        <div class="box1">
            <div class="a_do_login">
                <a href="#">Login/Cadastrar</a>
            </div> 
        </div>
    </div>
    <!-- Fim do navbar -->

    <!-- Formulário de Cadastro -->
    <div class="box">
        <div class="img">
            <img src="./../../../img/img_profile_cadastro.png" alt="Imagem do perfil">
            <h2>- Bora fazer um pequeno cadastro para poder usar o site ???</h2>
        </div>

        <!-- Mensagens de Erro -->
        <?php 
            if (isset($_SESSION['arry_error'])) {
                foreach ($_SESSION['arry_error'] as $erro) {
                    echo "<p class='erro'>$erro</p>";
                }
                unset($_SESSION['arry_error']);
            }
        ?>

        <!-- Formulário -->
        <form action="./../../evento/action/cadastro.php" method="post" class="form">
            <div class="row">
                <div class="campos_input">
                    <label for="nome">Nome:</label>
                    <input class="input" type="text" name="nome" placeholder="Primeiro nome:" minlength="5" maxlength="31">
                </div>
                <div class="campos_input">
                    <label for="nome_completo">Nome completo:</label>
                    <input class="input" type="text" name="nome_completo" placeholder="Nome completo" minlength="5" maxlength="31">
                </div>
            </div>

            <div class="row">    
                <div class="campos_input">
                    <label for="email">E-mail:</label>
                    <input class="input" type="email" name="email" placeholder="E-mail completo:" minlength="5" maxlength="31">
                </div>
                <div class="campos_input">
                    <label for="tel">Telefone:</label>
                    <input type="tel" class="input" name="tel" placeholder="Telefone pessoal:" minlength="5" maxlength="30">
                </div> 
            </div>

            <div class="row">
                <div class="campos_input">
                    <label for="senha1">Crie a senha:</label>
                    <input type="password" class="input" name="senha1" placeholder="Senha:" minlength="5" maxlength="30">
                </div> 
                <div class="campos_input">
                    <label for="senha2">Confirme a senha:</label>
                    <input type="password" class="input" name="senha2" placeholder="Repita a senha:" minlength="5" maxlength="30">
                </div>  
            </div>

            <div class="campos_input">
                <label for="cpf">CPF:</label>
                <input type="text" class="input" placeholder="Coloque os 11 dígitos:" name="cpf" pattern="\d{11}" title="Digite 11 dígitos numéricos">
            </div> 

            <div class="submit-container">
                <button type="submit" class="btn">Cadastrar</button> 
            </div>
        </form>  
        
        <a class="login-link" href="login.php">Fazer Login</a>
    </div>
</body>
</html>
