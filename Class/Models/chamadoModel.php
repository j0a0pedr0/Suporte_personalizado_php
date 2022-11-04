<?php

    namespace Models;

    class ChamadoModel
    {
        private $info;

        public function existeToken($token){
            $verifica = \Mysql::conectar()->prepare("SELECT * FROM `tb_suporte.chamados` WHERE token=?");
            $verifica->execute(array($token));
            if($verifica->rowCount() == 1){
                $this->info['retorno'] = 'true';
                $this->info['informacoes'] = $verifica->fetch();
                return $this->info;
            }else{
                $this->info['retorno'] = 'false';
                return $this->info;
            }
            
        }

        public function puxarRespostar($token){
            $verificar = \Mysql::conectar()->prepare("SELECT * FROM `tb_suporte.interacao_chamado` WHERE id_chamado=?");
            $verificar->execute(array($token));
            return $verificar->fetchAll();
            
        }
        public function verificarUltimaResposta($token){
            $verificar = \Mysql::conectar()->prepare("SELECT * FROM `tb_suporte.interacao_chamado` WHERE id_chamado=? ORDER BY id DESC");
            $verificar->execute(array($token));
            $lista = $verificar->fetchAll();
            if(@$lista[0]['admin'] == 1){
                return 'true';
            }else if (@$lista[0]['admin'] == -1){
                return 'false';
            }
        }

        public function responderChamadoUser($dados){
            $mensagem = $dados['resposta'];
            $token = $dados['token'];
            $inserir = \Mysql::conectar()->prepare("INSERT INTO `tb_suporte.interacao_chamado` VALUES (null,?,?,?)");
            if($inserir->execute(array($token,$mensagem,-1))){
                $sql = \Mysql::conectar()->prepare("UPDATE `tb_suporte.chamados` SET status=0 WHERE token=?");
                $sql->execute(array($token));
                echo '<script>alert("Resposta enviada com sucesso!!!");</script>';
                \Router::redirect(INCLUDE_PATH.'chamado?token='.$token);
                die();
            }else{
                echo '<script>alert("Ocorreu Algum Erro Grave!!!");</script>';
            }
        }
    }
?>