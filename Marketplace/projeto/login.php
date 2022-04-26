<?php require_once("../conexao/conexao.php"); ?>

<!-- permite consultar o database se o usuario passou pelo formulario de login -->
<?php
//iniciar variavel de sessao
    session_start();

    if(isset( $_POST["usuario"])) {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];

//login com usuario e senha, ele vai pesquisar no database se existe um usuario com as info

      $login = "SELECT * ";
      $login .= " FROM clientes ";
      $login .= " WHERE usuario = '{$usuario}' and senha = '{$senha}' ";

      $acesso = mysqli_query($conecta,$login);

      if (!$acesso) {
          die("Falha na consulta ao banco");
      }
//se der tudo certo, a info é passada de forma de array
      $informacao = mysqli_fetch_assoc($acesso);
//se o array vier nao vazio, o usuario ira ser redirecionado para a pagina de listagem
      if ( empty($informacao) ) {
          $mensagem = "Login sem sucesso";
      } else {
          $_SESSION["user_portal"] = $informacao["clienteID"];
          header("location:listagem.php");
      }


    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ANDES</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/login.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?>
        
        <main>  
            <div id="janela_login">
                    <!--usei o metodo post pq ele nao vai moestrar o usuario
                     e senha na url do site (o get mostraria) --> 

                <form action="login.php" method="post">
                    <h2>Tela de Login</h2>
                    <input type = "text" name="usuario" placeholder="Usuário">
                    <input type = "password" name="senha" placeholder="Senha">
                    <input type = "submit" value = "Login">
                    
                    <?php 
                        if( isset( $mensagem)) {

                        
                    ?>
                        <p><?php echo $mensagem ?></p>
                    <?php 
                     }
                    ?>
                </form>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>  
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>