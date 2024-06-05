<?php namespace DankiCode\Controllers;

class ComunidadeController{
    
    public function index(){
        if(isset($_SESSION['login'])){
        \DankiCode\Views\MainView::render('comunidade');
    }else{
        \DankiCode\Utilidades::redirect(INCLUDE_PATH);
    }

    }
}