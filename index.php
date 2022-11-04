<?php 
    include('config.php');
    
    $homeController = new \Controllers\HomeController;
    $chamadoController = new \Controllers\ChamadoController;
    $adminController = new \Controllers\AdminController;

    \Router::get('/home',function() use ($homeController){
        $homeController->index();
    });
    \Router::get('/chamado',function() use ($chamadoController) {
        $chamadoController->index();
    });
    \Router::get('/admin',function() use ($adminController){
        $adminController->index();
    });

?>