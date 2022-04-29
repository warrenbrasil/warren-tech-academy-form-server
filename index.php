<?php

/* 
O objetivo desse servidor é apenas exibir o retorno de um formulário HTML 
simples para demostração nas aulas de Formulários HTML 

Vamos adotar: 
- Nome
- Email
- Mensagem

*/ 

$filename = 'data.txt';

if(!isset($_REQUEST['nome']) && !empty($_REQUEST['nome'])):
    echo 'ERROR. Atenção: Você precisa enviar o nome. Utilize a tag <input type="text" name="nome"> para fazer isso e tenha certeza que não enviou vazio.';
    exit();
endif;

if(!isset($_REQUEST['email']) && !empty($_REQUEST['email'])):
    echo 'ERROR. Atenção: Você precisa enviar o email. Utilize a tag <input type="text" name="email"> para fazer isso e tenha certeza que não enviou vazio.';
    exit();
endif;

if(!isset($_REQUEST['mensagem']) && !empty($_REQUEST['mensagem'])):
    echo 'ERROR. Atenção: Você precisa enviar a mensagem. Utilize a tag <textarea name="mensagem"> ... </textarea> para fazer isso e tenha certeza que não enviou vazio.';
    exit();
endif;


$conteudo .= "-------------------------:\n";
$conteudo .= "Nome: ".$_REQUEST['nome']."\n";
$conteudo .= "Email: ".$_REQUEST['email']."\n";
$conteudo .= "Mensagem: ".$_REQUEST['mensagem']."\n";
$conteudo .= "Datetime: ".date("DD/MM/YYYY H:i:s")."\n";

// Primeiro vamos ter certeza de que o arquivo existe e pode ser alterado
if (is_writable($filename)) {

 // Em nosso exemplo, nós vamos abrir o arquivo $filename
 // em modo de adição. O ponteiro do arquivo estará no final
 // do arquivo, e é pra lá que $conteudo irá quando o 
 // escrevermos com fwrite().
    if (!$handle = fopen($filename, 'a')) {
         echo "Não foi possível abrir o arquivo ($filename)";
         exit;
    }

    // Escreve $conteudo no nosso arquivo aberto.
    if (fwrite($handle, $conteudo) === FALSE) {
        echo "Não foi possível escrever no arquivo ($filename)";
        exit;
    }

    echo "Sucesso: ".$_REQUEST['nome']." enviou informações para ($filename)";

    fclose($handle);

} else {
    echo "O arquivo $filename não pode ser alterado";
}

?>