<html>

<head>
    <title>Servidor de Testes - Warren Tech Academy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto Mono', monospace;
            font-size: 1.5em;
            padding: 3%;
        }
    </style>
</head>

<body>
    <?php

    /* 
        O objetivo desse servidor é apenas exibir o retorno de um formulário 
        simples para demostração nas aulas de HTML.

        Para dar a ideia do servidor recebendo e armazenando as informações, mantive os dados enviados no arquivo data.txt.

        Para inserir informações envie via GET ou POST: 
        - nome
        - email
        - mensagem

        Para exibir as informações armazenadas envie 'informacoes' via GET

        Para remover todas as informações envie 'delete' via GET

    */

    $filename = 'data.txt'; //database

    if (isset($_REQUEST['informacoes'])) :
        echo "Informações Recebidas:";
        $data = file_get_contents($filename);
        echo "<pre>" . $data . "<pre>";
        exit();
    endif;

    if (isset($_REQUEST['delete'])) :

        unlink($filename);
        fopen($filename,'w+');

        echo "Informações Removidas";
        
        $data = file_get_contents($filename);
        echo "<pre>" . $data . "<pre>";
        exit();
    endif;

    if (!isset($_REQUEST['nome']) || empty($_REQUEST['nome'])) :
        echo 'Error 400 Bad Request<br> Atenção: Você precisa enviar o nome. <br>Utilize a tag &lt;input type="text" name="nome"&gt; para isso e tenha certeza que não enviou vazio.';
        exit();
    endif;

    if (!isset($_REQUEST['email']) || empty($_REQUEST['email'])) :
        echo 'Error 400 Bad Request<br> Atenção: Você precisa enviar o email.<br> Utilize a tag &lt;input type="text" name="email"&gt; para isso e tenha certeza que não enviou vazio.';
        exit();
    endif;

    if (!isset($_REQUEST['mensagem']) || empty($_REQUEST['mensagem'])) :
        echo 'Error 400 Bad Request<br> Atenção: Você precisa enviar a mensagem.<br> Utilize a tag &lt;textarea name="mensagem"&gt; ... &lt;/textarea&gt; para isso e tenha certeza que não enviou vazio.';
        exit();
    endif;


    // Montando o conteúdo
    $content .= "Data: " . date("d/m/Y H:i:s") . "\n";
    $content .= "Nome: " . $_REQUEST['nome'] . "\n";
    $content .= "Email: " . $_REQUEST['email'] . "\n";
    $content .= "Mensagem: " . $_REQUEST['mensagem'] . "\n";
    $content .= "----------------------------\n";

    // Primeiro vamos ter certeza de que o arquivo existe e pode ser alterado
    if (is_writable($filename)) {

        // Em nosso exemplo, nós vamos abrir o arquivo $filename
        // em modo de adição. O ponteiro do arquivo estará no final
        // do arquivo, e é pra lá que $content irá quando o 
        // escrevermos com fwrite().
        if (!$handle = fopen($filename, 'a')) {
            echo "Não foi possível abrir o arquivo ($filename)";
            exit;
        }

        // Escreve $content no nosso arquivo aberto.
        if (fwrite($handle, $content) === FALSE) {
            echo "Não foi possível escrever no arquivo ($filename)";
            exit;
        }

        echo "Sucesso: '" . $_REQUEST['nome'] . "' enviou informações em " . date("d/m/Y H:i:s") . "<br>Aguarde, Processando...  ";
        echo '<meta http-equiv="refresh" content="5;url=?informacoes=1">'; //redirect
        
        fclose($handle);
        
        exit();
    } else {
        echo "Erro: O arquivo $filename não pode ser alterado";
    }
    ?>
</body>

</html>