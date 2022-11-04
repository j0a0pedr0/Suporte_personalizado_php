<?php

    namespace Models;

    class AdminModel
    {
        public function listaChamadosNovos(){
            $lista = \Mysql::conectar()->prepare("SELECT * FROM `tb_suporte.chamados` WHERE status=0 ORDER BY id DESC");
            $lista->execute();

            return $lista->fetchAll();
        }

        public function respostaChamado($dados){
            $resposta = $dados['resposta_chamado'];
            $token = $dados['token'];
            $email = $dados['email'];
            $mensagem = $dados['mensagem'];
            
            if($resposta == '')
            return false;

            $sql = \Mysql::conectar()->prepare("INSERT INTO `tb_suporte.interacao_chamado` VALUES (null,?,?,?)");
            if($sql->execute(array($token,$resposta,1))){
                $sql = \Mysql::conectar()->prepare("UPDATE `tb_suporte.chamados` SET status=1 WHERE token=?");
                $sql->execute(array($token));
                SELF::enviarEmailAdmin($email,$token,$mensagem);
                echo '<script>alert("Resposta Enviada Com Sucesso!!!");</script>';
                \Router::redirect(INCLUDE_PATH.'admin');
                return true;
            }
        }

        public static function enviarEmailAdmin($email,$token,$mensagem){
            $tokenA = $token;
            $link = INCLUDE_PATH.'chamado?token='.$tokenA;
            $assunto = 'Resposta Do Chamado';
            $informacoes = 'Olá, Ocorreu uma nova interação no seu chamado </br>Pergunta:'.$mensagem.'</br>Utilizeo o link abaixo para interagir: </br> <a href="'.$link.'">Acessar Chamado!</a>';

            $mail = new \Email('smtp.hostinger.com','joaopedroexemplo@cursospoderfeminino.com','Jaca1000$','Joao');
            $mail->addAddress($email,'Perguntador');
            $mail->formatarEmail($assunto,$informacoes);
            $mail->enviarEmail();
        }

        public function deletarChamado($token){
            $sql = \Mysql::conectar()->prepare("DELETE FROM `tb_suporte.chamados` WHERE token=?");
            if($sql->execute(array($token))){
                $sql2 = \Mysql::conectar()->prepare("DELETE FROM `tb_suporte.interacao_chamado` WHERE id_chamado=?");
                if($sql2->execute(array($token)))
                    return true;
            }
            return false;
        }

        public static function puxarListaInteracao($token){
            $listaInteracao = \Mysql::conectar()->prepare("SELECT * FROM `tb_suporte.interacao_chamado` WHERE id_chamado=? ORDER BY id");
            $listaInteracao->execute(array($token));
            return $listaInteracao->fetchAll();
        }
    }
?>