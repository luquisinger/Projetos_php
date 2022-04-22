<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario Simples</title>
    </head>

    <body> 

    <pre>
    <?php
        if (isset($_POST["nome"])) {
            $nome = $_POST["nome"];
        } else {
            $nome = "Sem definição";
        }

        

        if (isset($_POST["email"])) {
            $email = $_POST["email"];
        } else {
            $email = "Sem definição";
        }

        echo "Nome: " . $nome . "<br>";
        echo "Email: " . $email . "<br>";
    ?>
    </pre>
    
   
    
    </body>
</html>