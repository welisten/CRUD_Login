<?php 
/*$servidor = "localhost";
$bancoDados = "crudpdo";
$usuario = "postgres";
$senha = "welisten369";*/

    Class Usuario 
    {
        private $pdo;
        public $msgErro = "";

//  1     
        public function conect($host, $dbname, $user, $passw)
        {
            global $pdo;
            global $msgErro;

            try {

                $pdo = new PDO("pgsql:host=$host;port=5432;dbname=$dbname", $user, $passw, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

            } catch (PDOException $e) {

                $msgErro = $e->getMessage();
            
            }
        }
//  2
        public function register($name, $phone, $email, $passw)
        {
            global $pdo;

            //Verificar se Existe Email Cadastrado
            $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();
            if($sql->rowCount() > 0)
            {
                return false; // cadastro não realizado :( emailjá cadastrado
            }
            else
            {   
            //caso não - Cadastrar no BD
                $sql = $pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n, :ph, :e, :pa )");
                $sql->bindValue(":n", $name);
                $sql->bindValue(":ph", $phone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":pa", md5($passw));
                $sql->execute();
                return true; // cadastro realizado :) 
            }

        }
            
        
//  3
        public function login($email, $passw)
        {
            global $pdo;
            //Verificar se Senha e Email já está cadastrado, se sim entrar no sistema
           $sql = $pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e AND senha = :pa");
           $sql->bindValue(":e", $email);
           $sql->bindValue(":pa", md5($passw));
           $sql->execute();
           if($sql->rowCount() > 0)
           {
                //ja estão cadastrados, Entrar na SESSÂO PRIVADA
                $dado = $sql->fetch();//                               -- ARRAY ASSOCIATIVO --
                session_start();//                                      -- INICIA A SESSÃO(PRIV) DO USUARIO --
                $_SESSION['id_usuario'] = $dado['id_usuario'];//         -- GUARDA Os DADOs(ID) NA VAR GLOBAL DA SESSÂO
                return true; // logado com sucesso :)
            }
           else
           {
                return false; // não conseguiu logar :(
           }

                        
        }
    } 


?>