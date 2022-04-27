<?php require_once("../conexao/conexao.php"); ?>
<?php
    // excluir transportadora
    if(isset($_POST["nometransportadora"])) {
        $tid = $_POST["transportadoraID"];

        $exclusao = " DELETE FROM transportadoras WHERE transportadoraID = {$tid}";
        $consulta_exclusao = mysqli_query($conecta,$exclusao);
        if(!$consulta_exclusao) {
            die("Erro no banco");
        } else {
            header("location:listagem");
        }
    }
    //consulta ao banco de dados 
    if( isset( $_GET["codigo"])) {
        $id = $_GET["codigo"];
        $tr = " SELECT * FROM transportadoras WHERE transportadoraID = {$id}";
        $consulta_tr = mysqli_query($conecta,$tr);
        if(!$consulta_tr) {
            die("erro no banco");
        }
    } else {
        header("location:lista.php");
    }

    //se tudo der certo 
    $info_transportadora = mysqli_fetch_assoc($consulta_tr);
    print_r($info_transportadora);
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/alteracao.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id="janela_formulario">
            <form action="exclusao.php" method="post">
                    <h2>Exclusão de Transportadoras</h2>
                    
                    <label for="nometransportadora">Nome da Transportadora</label>
                    <input type="text" value="<?php echo $info_transportadora["nometransportadora"]  ?>" name="nometransportadora" id="nometransportadora">

                    <label for="endereco">Endereço</label>
                    <input type="text" value="<?php echo $info_transportadora["endereco"]  ?>" name="endereco" id="endereco">
                    
                    <label for="cidade">Cidade</label>
                    <input type="text" value="<?php echo $info_transportadora["cidade"]  ?>" name="cidade" id="cidade">
                    
                    <input type="hidden" name="transportadoraID" value="<?php echo $info_transportadora["transportadoraID"] ?>">
                    <input type="submit" value="Confirmar exclusão">                    
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