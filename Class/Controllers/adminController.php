<?php

    namespace Controllers;

    class AdminController
    {
        private $adminView,$adminModel;

        public function __construct(){
            $this->adminView = new \Views\MainView;
            $this->adminModel = new \Models\AdminModel;
        }

        public function index(){
            if(isset($_POST['responder_chamado'])){
                if($this->adminModel->respostaChamado($_POST) == false)
                    echo '<script>alert("Erro...Campos vazios não são permitidos");</script>';
            }

            if(isset($_GET['deletar'])){
                
                if($this->adminModel->deletarChamado($_GET['deletar'])){
                    echo '<script>alert("Deletado Com Sucesso!!!");</script>';
                    \Router::redirect(INCLUDE_PATH.'admin');
                }else{
                    echo '<script>alert("Erro...Problema no sistema, por favor reporte!!");</script>';
                    \Router::redirect(INCLUDE_PATH.'admin');
                }
            }

            $listaChamados['chamados_novos'] = $this->adminModel->listaChamadosNovos();
            $this->adminView->render('admin.php',$listaChamados);
        }

        public static function listaInteracao($token){
            return \Models\AdminModel::puxarListaInteracao($token);
        }
    }
?>