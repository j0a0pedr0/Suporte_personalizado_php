<?php

    namespace Controllers;

    class ChamadoController
    {
        private $chamadoView,$chamadoModel;

        public function __construct(){
            $this->chamadoView = new \Views\MainView;
            $this->chamadoModel = new \Models\ChamadoModel;
        }

        public function index(){

            if(isset($_GET['token'])){
                $retornoVerificacao = $this->chamadoModel->existeToken($_GET['token']);
                if($retornoVerificacao['retorno'] == 'true'){
                    $retornoVerificacao['informacoes']['respostas_interacao'] = $this->chamadoModel->puxarRespostar($_GET['token']);
                    $retornoVerificacao['informacoes']['ultima_resposta'] = $this->chamadoModel->verificarUltimaResposta($_GET['token']);
                    $this->chamadoView->render('chamado.php',$retornoVerificacao['informacoes']);
                }else{
                    die('O token está setado, porem token não existe!');
                }
            }else{
                die('Apenas com o token do chamado você pode interagir!');
            }
            
            if(isset($_POST['responder_chamado'])){
                $this->chamadoModel->responderChamadoUser($_POST);
            }
        }

    }
?>