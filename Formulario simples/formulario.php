<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario Simples</title>
        <link href="estilo.css" rel="stylesheet">
    </head>

    <body>
        <form action="destino.php" method="post">
            <label for="nome">Nome Completo</label>
            <input type="text" name="nome" id="nome">
            
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
            
            <input type="submit" value="Enviar Cadastro">
        </form>
    </body>
</html>