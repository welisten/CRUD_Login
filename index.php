<?php 
    require_once './CLASSES/usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Projeto Login</title>
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>

    <div class="form-container">

        <h1 class="title">Entrar</h1>
        
        <form method="POST" action="#">
            
            <div class="form-control">
                <input 
                    name="email" 
                    type="text" 
                    autocomplete="off" 
                    required
                >
                <label for="user">Usuário</label>

            </div>
            <div class="form-control">
                <input 
                    name="password"
                    type="password"  
                    autocomplete="off" 
                    required
                >
                <label for="password">Senha</label>
            </div>

            <input type="submit" value="ACESSAR" class="form-btn">
<!--COLOCAR MENSAGEM -->
            <div class="loginMsg-container">

            </div>
            <a href="cadastrar.php">Ainda não é inscrito? <strong>Cadastre-se!</strong></a>
        
        </form>
    </div>
    <?php        
        if(isset($_POST['email']))
        {
            $email = addslashes($_POST['email']);
            $passw = addslashes($_POST['password']);
            
            //Verificar se esta tudo preenchido
            if(!empty($email) && !empty($passw))
            {
                //Fazer conexão. 
                $u->conect("localhost", "projeto_login", "postgres", "welisten369");
    
                if($u->msgErro == "")//verificar erro de conexão
                {
                    // -- LOGAR --
                    if($u->login($email, $passw))
                    {
                        header("location: areaPrivada.php");
                    }
                    else
                    {
                    ?>
                        <div class="msg erro">
                            "Email" e/ou "Senha" estão incorretos!
                        </div>
                    <?php
                    }
                }
                else // Erro na Conexão
                {
                ?>
                    <div class="msg erro">
                        <?php echo "Erro: ".$msgErro ;?>               
                    </div>
                <?php                   
                }

            }
            else
            {
            ?>
                <div class="msg erro">
                    Preencha todos os Campos!
                </div>
            <?php
            }
        }

?>    
    <script>
        const $labels = document.querySelectorAll("label")
        const delayScale = 50
        $labels.forEach(label => {
        label.innerHTML = label.innerText
        .split('')
        .map((letter, idx) => `<span style="transition-delay: ${idx * delayScale}ms">${letter}</span>`)
        .join('')
})
    </script>
</body>
</html>