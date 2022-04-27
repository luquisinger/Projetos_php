<?php require_once("../conexao/conexao.php"); ?>

<?php
//insercao no banco
if(isset( $_POST["cidade"])) {
    $nome = $_POST["nometransportadora"];
    $endereco =$_POST["endereco"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estados"];
    $cep = $_POST["cep"];
    $cnpj = $_POST["cnpj"];
    $telefone = $_POST["telefone"];

    $inserir = "INSERT INTO transportadoras ";
    $inserir .= " (nometransportadora, endereco, telefone, cidade, estadoID, cep, cnpj) ";
    $inserir .= " VALUES ('$nome','$endereco','$telefone','$cidade','$estado','$cep','$cnpj')";

    $operacao_inserir = mysqli_query($conecta,$inserir);
    if (!$operacao_inserir) {
        die("Falha na insersao");
    } else {
        header("location:lista.php");
    }
} 

//seleçao de estados
        $estados = "SELECT nome, estadoID FROM estados";
        $linha_estados = mysqli_query($conecta,$estados);
        if ( !$linha_estados ) {
            die("erro no banco");
        }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pagina de inserção</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/crud.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id="janela_formulario">
                <form action="inserir.php" method="post">
                    <input type="text" name="nometransportadora" placeholder="nome">
                    <input type="text" name="endereco" placeholder="Endereco">
                    <input type="text" name="cidade" placeholder="cidade">
                    <select name="estados">
                        <?php while($linha = mysqli_fetch_assoc($linha_estados)) { ?>
                            <option value="<?php echo $linha["estadoID"]; ?>">
                            <?php echo $linha["nome"]; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <input type="text" name="telefone" placeholder="telefone">
                    <input type="text" name="cep" placeholder="CEP">
                    <input type="text" name="cnpj" placeholder="CNPJ">
                    <input type="submit" value="inserir"> 
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