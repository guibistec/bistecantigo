<?php 

if(isset($_POST['email']) && !empty($_POST['email'])){


$nome = addslashes($_POST['nome']);
$email = addslashes($_POST['email']);
$mensagem = addslashes($_POST['message']);

$to = "guilhermebistec@gmail.com";
$subject = "Contato - teste site";
$body = "Nome: ".$nome. "\r\n".
        "E-mail: ".$email."\r\n".
    "Mensagem> ".$mensagem;
$header = "From:guicrispim1000@gmail.com"."\r\n".
            "Reply-To:".$email."\e\n".
            "X=Mailer:PHP/".phpversion();

if(mail($to,$subject,$body,$header)){
    echo("Email enviado com sucesso!!!!");
} else {
    echo("Email com falha de envio...");
}

}

?>