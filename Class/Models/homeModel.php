<?php

    namespace Models;

    class HomeModel
    {
        public function inserirChamado($dados_chamado){
            $email = $dados_chamado['email'];
            $mensagem = $dados_chamado['mensagem'];
            $token = md5(uniqid());
            $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_suporte.chamados` VALUES (null,?,?,?,?)");
            if($sql->execute(array($email,$mensagem,$token,0))){
                SELF::enviarEmailChamado($email,$token,$mensagem);
                echo '<script>alert("Mensagem Enviada Com Sucesso!!!");</script>';
                \Router::redirect(INCLUDE_PATH.'home');
            }else{
                echo '<script>alert("Ocorreu algum erro");</script>';
            }
            
        }
        public static function enviarEmailChamado($email,$token,$mensagem){
            $tokenA = $token;
            $link = INCLUDE_PATH.'chamado?token='.$tokenA;
            $assunto = 'Abertura de chamado';
            $informacoes = 'Olá, seu chamado foi criado com sucesso! </br>Pergunta:'.$mensagem.'</br>Utilizeo o link abaixo para interagir:</br> <a href="'.$link.'">Acessar Chamado!</a>';

            $mail = new \Email('smtp.hostinger.com','joaopedroexemplo@cursospoderfeminino.com','Jaca1000$','Joao');
            $mail->addAddress($email,'Perguntador');
            $mail->formatarEmail($assunto,$informacoes);
            $mail->enviarEmail();
        }
    }
?>