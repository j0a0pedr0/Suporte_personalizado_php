<?php
    namespace Controllers;

    class HomeController
    {
        private $homeView,$homeModel;

        public function __construct(){
            $this->homeView = new \Views\MainView;
            $this->homeModel = new \Models\HomeModel;
        }

        public function index(){

            if(isset($_POST['enviar_mensagem'])){
                $this->homeModel->inserirChamado($_POST);  
            }

            $this->homeView->render('home.php');
        }
    }
?>