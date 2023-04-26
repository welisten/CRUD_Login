<?php 
    require_once "./CLASSES/usuarios.php";
    $u = new Usuario;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Formulario de CAdastro</title>
    <!--  FaveICon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--  Css -->
    <link rel="stylesheet" href="./CSS/style.css">
</head>
<body>

    <div class="form-container">

        <h1 class="title">Cadastrar</h1>
        <form method="POST">
            

            <div class="form-control" style = "margin: 20px 0 20px;">
                <input 
                    name="name" 
                    type="text"   
                    maxlength="30" 
                    autocomplete="off"
                    required
 
                >
                <label for="name">Nome Completo</label>
            </div>
            <div class="form-control" style = "margin: 20px 0 20px;">
                <input  
                    name="phone" 
                    type="text" 
                    maxlength="30" 
                    autocomplete="off" 
                    required
                >
                <label for="phone">Telefone</label>
            </div>
            <div class="form-control" style = "margin: 20px 0 20px;">
                <input 
                    name="email" 
                    type="text"  
                    maxlength="40" 
                    autocomplete="off"
                    required

                >
                <label for="email">Email</label>
            </div>            
            <div class="form-control" style = "margin: 20px 0 20px;">
                <input 
                    name="password" 
                    type="password" 
                    maxlength="32" 
                    autocomplete="off" 
                    required

                >
                <label for="password">Senha</label>
            </div>            
            <div class="form-control" style = "margin: 20px 0 20px;">
                <input  
                    name="confPassword" 
                    type="password"
                    autocomplete="off" 
                    required

                >
                <label for="confPassword">Confirmar Senha</label>
            </div>
            
            <input type="submit" value="ACESSAR" class="form-btn">
            
        </form>
        <div class="link-container">
                <i class="fa-solid fa-angle-left"></i>
                <a href="index.php" class ="back" >Login</a>
            </div>
    </div>
    <?php 
    // Verificar se a pessoa no botão
    if(isset($_POST['name']))
    {
        $name  = addslashes($_POST['name']);
        $phone = addslashes($_POST['phone']);
        $email = addslashes($_POST['email']);
        $passw = addslashes($_POST['password']);
        $confPassw = addslashes($_POST['confPassword']);
        
        //Verificar se esta tudo preenchido
        if(!empty($name) && !empty($phone) && !empty($email) && !empty($passw) && !empty($confPassw)){
            //Fazer conexão. 
            $u->conect("localhost", "projeto_login", "postgres", "welisten369");
            //caso não ocorra erro na conexão CADASTRAR
            if($u->msgErro == "")
            {   
                //antes do cadastro devemos verificar se password e confPassword coincidem
                if($passw == $confPassw)
                {   
                    //cadastrar
                    if($u->register($name, $phone, $email, $passw))
                    {
                        ?>
                        <div class="msg success" id="msg-success">
                            Cadastrado com sucesso
                        </div>
                        <?php
                    }
                    else
                    {
                        
                        ;
                        ?>
                        <div class="msg erro">
                            email já foi cadastrado anteriormente!"
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="msg erro">
                        "Senha" e "Confirmar senha" não correspondem
                    </div>
                    <?php
                }
            }
            else
            {
            //caso ocorra
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



    <script src="./script/script.js"></script>
</body>
</html>

<?php 


 ?>