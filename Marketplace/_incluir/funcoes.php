<?php
    function real_format($valor) {
        $valor  = number_format($valor,2,",",".");
        return "R$ " . $valor;
    }

    function mostrarAviso($numero) {
        $array_erro = array(
            UPLOAD_ERR_OK => "Arquivo enviado com sucesso",
            UPLOAD_ERR_INI_SIZE => "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
            UPLOAD_ERR_FORM_SIZE => "O arquivo excede o limite de 45kb no formulário HTML",
            UPLOAD_ERR_PARTIAL => "O upload do arquivo foi feito parcialmente.",
            UPLOAD_ERR_NO_FILE => "Nenhum arquivo foi enviado.",
            UPLOAD_ERR_NO_TMP_DIR => "Pasta temporária ausente.",
            UPLOAD_ERR_CANT_WRITE => "Falha em escrever o arquivo em disco.",
            UPLOAD_ERR_EXTENSION => "Uma extensão do PHP interrompeu o upload do arquivo."
        ); 
        return $array_erro[$numero];
    } 

    function uploadArquivo($arquivo_publicado,$minha_pasta){
        if($arquivo_publicado["error"] == 0) {
            $pasta_temporaria = $arquivo_publicado["tmp_name"];
            $arquivo = alterarNome($arquivo_publicado["name"]);
            $pasta = $minha_pasta;
            $tipo = $arquivo_publicado["type"];
            $extensao = strrchr ($arquivo, ".");

           

            if( $tipo == "image/jpeg" || $tipo="image/pmg" || $tipo="image/gif") {
                if (move_uploaded_file($pasta_temporaria, $pasta ."/" . $arquivo)) {
                    $mensagem = mostrarAviso($arquivo_publicado["error"]);
                } else {
                    $mensagem = "Erro na publicação";
                }
            } else {
                $mensagem ="ERRO: Arquivo não pode ter extensão " . $extensao;
            }
        } else {
            $mensagem = mostrarAviso($arquivo_publicado["error"]);
        }

        return array($mensagem,$arquivo);
    }

    function alterarNome($arquivo) {
        $extensao = strrchr($arquivo, ".");
        $alfabeto = "ABCDEFGHIJKLMNOPQRSWXYZ1234";
        $tamanho = 15;
        $letra = "";
        $resultado = "";
    
        for ($i = 1; $i <= $tamanho ; $i ++) {
            $letra = substr( $alfabeto, rand(0, strlen($alfabeto)-1) , 1);
            $resultado .= $letra;
        }
    
        $agora = getdate();
        $codigo_ano = $agora["year"] . "_" . $agora["yday"];
        $codigo_data = $agora["hours"] . $agora["minutes"] . $agora["seconds"];
    
        return "foto_" . $resultado . "_" . $codigo_ano . "_" . $codigo_data . $extensao;
    
    }
        function enviarMensagem($dados){
            //dados do formulario 
            $nome             = $dados['nome'];
            $email            = $dados['email'];
            $mensagem_usuario = $dados['mensagem'];

            //criar variaveis de envio, para onde vai essa mensagem?
            $destino             = "suporte@imediabrai.com";
            $remetente           = "matheus.779@hormail,com";
            $assunto             = "Mensagem do site";

            //MOntar o corpo da mensagem
            $mensagem = "O usuario " . $nome . " enviou uma mensagem. " . "<BR>";
            $mensagem .= "email do usuário: " . $email . "<BR>";
            $mensagem .= "mensagem " . "<BR>";
            $mensagem .= $mensagem_usuario;

            return mail($destino, $assunto, $mensagem, $remetente);
            
        }


?>