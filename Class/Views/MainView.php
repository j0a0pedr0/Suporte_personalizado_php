<?php

    namespace Views;

    class MainView
    {

        public function render($file,$arr=[],$header='header.php'){
            include('Class/Views/includes/'.$header);
            include('Class/views/pages/'.$file);
        }
    }
?>